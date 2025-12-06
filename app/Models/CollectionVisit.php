<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_job_id',
        'status',
        'completed_at',
        'lat',
        'lng',
        'accuracy',
        'notes',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function job()
    {
        return $this->belongsTo(CollectionJob::class, 'collection_job_id');
    }

    public function photos()
    {
        return $this->hasMany(CollectionPhoto::class);
    }
}
