<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'type',
        'price',
        'duration',
        'max_participants',
        'min_age',
        'overview',
        'description',
        'location',
        'map_lat',
        'map_lng',
        'discount',
    ];

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    

    public function highlights()
    {
        return $this->hasMany(ServiceHighlight::class);
    }

    public function inclusions()
    {
        return $this->hasMany(ServiceInclusion::class);
    }

    public function importantInfos()
    {
        return $this->hasMany(ServiceImportantInfo::class);
    }

    public function availabilities()
    {
        return $this->hasMany(ServiceAvailability::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }



    
}
