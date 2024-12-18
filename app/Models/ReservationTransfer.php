<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTransfer extends Model
{
    use HasFactory;

    protected $table = "reservation_transfers";

    protected $fillable = [
        'client_id',
        'transfer_id',
        'adults_count',
        'children_count',
        'total_price',
        'date',
        'status',
        'hotel_name',
        'hotel_address',
        'flight_number',
        'flight_time',
        'hotel_phone',
        'comment'
    ];

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
