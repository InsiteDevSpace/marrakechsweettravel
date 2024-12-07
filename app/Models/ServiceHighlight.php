<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHighlight extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'text','highlight_detail'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
