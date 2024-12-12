<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'client_id',
        'reservation_dates',
        'adults_count',
        'children_count',
        'total_price',
        'payment_status',
        'status',
    ];

    protected $casts = [
        'reservation_dates' => 'array', // For storing multiple dates
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
