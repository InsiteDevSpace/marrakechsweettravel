<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImportantInfo extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'text'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
