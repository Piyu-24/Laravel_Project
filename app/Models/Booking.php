<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str; // To generate unique booking IDs

class Booking extends Model
{
    use HasFactory;

    // Define the table name (if different from pluralized model name)
    protected $table = 'bookings';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'vehicle_type', // Make sure vehicle_type is added to fillable
        'pickup_location',
        'pickup_date',
        'return_date',
        'name',
        'email',
        'contact_number',
    ];

    /**
     * A booking belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A booking belongs to a vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Boot method to auto-generate a unique booking ID before creating a booking.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            // Generate a unique booking ID before saving
            if (empty($booking->booking_id)) {
                $booking->booking_id = 'BOOK-' . Str::random(8); // Customize the format as per requirement
            }

            // Ensure that the vehicle's availability is set to false once booked
            $vehicle = $booking->vehicle;
            if ($vehicle) {
                $vehicle->update(['availability' => false]);
            }
        });
    }
}
