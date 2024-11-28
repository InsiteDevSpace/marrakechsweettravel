<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'min_people',
        'max_people',
        'estimated_time',
        'price',
        'departure',
        'destination',
        'type',
        'start_date',
        'end_date'
    ];

    public function reservations()
    {
        return $this->hasMany(ReservationTransfer::class);
    }
}
