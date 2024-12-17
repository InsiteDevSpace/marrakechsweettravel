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
        'start_date',
        'start_time',
        'end_date',
        'adults_count',
        'children_count',
        'total_price',
        'payment_status',
        'status',
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
