<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // Add any fillable attributes that match your database columns
    protected $fillable = [
        //'name',
        'vehicle_type',
        'make',
        'model',
        'year',
        'color',
        'price_per_day',
        'image',
        'availability',
        'is_booked' // Ensure this is included here
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
