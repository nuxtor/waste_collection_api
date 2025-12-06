<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollectionPhoto;
use Illuminate\Http\Request;

class PhotoUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo'   => 'required|image|max:8192', // 8MB
            'lat'     => 'nullable|numeric',
            'lng'     => 'nullable|numeric',
            'taken_at'=> 'nullable|date',
        ]);

        $file = $request->file('photo');

        $path = $file->store('collection-photos', 'public');

        $photo = CollectionPhoto::create([
            'collection_visit_id' => null, // attach later
            'file_path'           => $path,
            'lat'                 => $request->lat,
            'lng'                 => $request->lng,
            'taken_at'            => $request->taken_at ?? now(),
        ]);

        return response()->json([
            'id'  => $photo->id,
            'url' => $photo->url,
        ], 201);
    }
}
