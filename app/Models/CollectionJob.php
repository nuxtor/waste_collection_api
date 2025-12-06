<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionJob extends Model
{
   use HasFactory;

    protected $fillable = [
        'property_id',
        'driver_id',
        'scheduled_date',
        'status',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function visits()
    {
        return $this->hasMany(CollectionVisit::class);
    }

    public function latestVisit()
    {
        return $this->hasOne(CollectionVisit::class)->latestOfMany();
    }
}
