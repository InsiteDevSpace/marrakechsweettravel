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
        'currency',
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



     // Add a method to get the converted price
    public function getConvertedPrice($currency, $conversionRates)
    {
        $baseCurrency = 'USD'; // Base currency
        if (isset($conversionRates[$currency]) && $currency !== $baseCurrency) {
            return round($this->price * $conversionRates[$currency], 2);
        }
        return $this->price; // Default to base price if no conversion needed
    }

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




    protected static function booted()
    {
        static::deleting(function ($service) {
            // Delete related availabilities
            $service->availabilities()->delete();
            // Delete related reservations
            $service->reservations()->delete();
        });
    }




    
}
