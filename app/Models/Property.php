<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reference',
        'address_line1',
        'address_line2',
        'city',
        'postcode',
        'lat',
        'lng',
        'notes',
    ];

    public function collectionJobs()
    {
        return $this->hasMany(CollectionJob::class);
    }
}
