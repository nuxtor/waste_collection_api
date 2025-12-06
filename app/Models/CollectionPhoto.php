<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_visit_id',
        'file_path',
        'taken_at',
        'lat',
        'lng',
    ];

    protected $casts = [
        'taken_at' => 'datetime',
    ];

    public function visit()
    {
        return $this->belongsTo(CollectionVisit::class, 'collection_visit_id');
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
    
}
