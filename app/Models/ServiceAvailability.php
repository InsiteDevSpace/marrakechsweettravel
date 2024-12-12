<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAvailability extends Model
{
     use HasFactory;

    protected $table = 'service_availability';
    protected $fillable = ['service_id', 'start_date', 'end_date', 'start_time', 'end_time', 'remaining_slots'];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }


    
}
