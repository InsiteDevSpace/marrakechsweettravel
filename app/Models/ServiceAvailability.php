<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAvailability extends Model
{
     use HasFactory;

    protected $table = 'service_availability';
    protected $fillable = ['service_id', 'start_date','end_date', 'remaining_slots', 'start_time', 'end_time'];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }


    
}
