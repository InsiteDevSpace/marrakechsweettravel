<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 
        'payment_method', 'amount', 'currency', 
        'address', 'city', 'country'
    ];
}
