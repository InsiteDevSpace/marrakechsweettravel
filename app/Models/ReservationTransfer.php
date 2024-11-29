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
        'total_people',
        'total_price',
        'date',
        'status',
        'hotel_name',
        'hotel_address',
        'Flight_number',
        'Flight_time',
        'hotel_phone',
        'Comment'
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
