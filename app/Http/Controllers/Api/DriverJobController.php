<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollectionJob;
use Illuminate\Http\Request;

class DriverJobController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $date = $request->query('date', now()->toDateString());

        $jobs = CollectionJob::with('property')
            ->where('driver_id', $user->id)
            ->whereDate('scheduled_date', $date)
            ->orderBy('scheduled_date')
            ->get();

        return response()->json($jobs);
    }

    public function show(Request $request, CollectionJob $job)
    {
        $this->authorizeDriver($request, $job);

        $job->load('property', 'latestVisit.photos');

        return response()->json($job);
    }

    protected function authorizeDriver(Request $request, CollectionJob $job)
    {
        if ($request->user()->id !== $job->driver_id) {
            abort(403, 'Not your job');
        }
    }

    public function complete(Request $request, CollectionJob $job)
    {
        $this->authorizeDriver($request, $job);

        $data = $request->validate([
            'status'  => 'required|in:completed,missed',
            'lat'     => 'nullable|numeric',
            'lng'     => 'nullable|numeric',
            'accuracy'=> 'nullable|numeric',
            'notes'   => 'nullable|string',
            'photos'  => 'array',
            'photos.*'=> 'integer',
        ]);

        // Create visit
        $visit = $job->visits()->create([
            'status'       => $data['status'],
            'completed_at' => now(),
            'lat'          => $data['lat'] ?? null,
            'lng'          => $data['lng'] ?? null,
            'accuracy'     => $data['accuracy'] ?? null,
            'notes'        => $data['notes'] ?? null,
        ]);

        // Attach previously uploaded photos (we’ll handle uploading next)
        if (! empty($data['photos'])) {
            \App\Models\CollectionPhoto::whereIn('id', $data['photos'])
                ->update(['collection_visit_id' => $visit->id]);
        }

        // Update job status
        $job->update(['status' => $data['status'] === 'completed' ? 'completed' : 'missed']);

        return response()->json([
            'message' => 'Job completed',
            'visit'   => $visit->load('photos'),
        ]);
    }
}
