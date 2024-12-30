<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Http\Request;




class BookingController extends Controller
{
    /**
     * Display the booking form for a specific vehicle.
     *
     * @param Vehicle $vehicle
     * @return \Illuminate\View\View
     */
    public function create(Vehicle $vehicle)
    {
        // Pass the vehicle to the view for displaying in the form
        return view('booking.create', compact('vehicle'));
    }

    /**
     * Store the booking data.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:15',
            'vehicle_type' => 'required|string',
            'vehicle_id' => 'required|exists:vehicles,id',
            'pickup_location' => 'required|string|max:255',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after_or_equal:pickup_date',
        ]);


        // Retrieve the authenticated user's ID
        $user_id = auth()->id();

        // Check vehicle availability
        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
        if (!$vehicle->availability) {
            return redirect()->back()->with('error', 'This vehicle is not available for booking.');
        }

        // Check for overlapping bookings
        $existingBooking = Booking::where('vehicle_id', $vehicle->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('pickup_date', [$validated['pickup_date'], $validated['return_date']])
                    ->orWhereBetween('return_date', [$validated['pickup_date'], $validated['return_date']]);
            })
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'This vehicle is already booked for the selected dates.');
        }

        // Create the booking record
        $booking = new Booking();
        $booking->user_id = $user_id; // Set the authenticated user's ID
        $booking->vehicle_id = $validated['vehicle_id'];
        $booking->vehicle_type = $validated['vehicle_type']; // Storing vehicle type
        $booking->pickup_location = $validated['pickup_location'];
        $booking->pickup_date = $validated['pickup_date'];
        $booking->return_date = $validated['return_date'];
        $booking->name = $validated['name'];
        $booking->email = $validated['email'];
        $booking->contact_number = $validated['contact_number'];
        $booking->save();



        $vehicle->update([
            'availability' => false,
            // Set is_booked to true
        ]);



        // Redirect with a success message
        return redirect()->route('dashboard')->with('success', 'Booking successful!');
    }

    public function showBookedVehicles()
    {
        // Get all bookings for the logged-in user
        $bookings = Booking::where('user_id', auth()->id())->get();

        // Get all available vehicles
        $vehicles = Vehicle::where('availability', true)->get();

        // Pass both $bookings and $vehicles to the dashboard view
        return view('dashboard', compact('bookings', 'vehicles'));
    }


    /*public function showBookedVehicles()
    {
        // Get all bookings for the logged-in user
        $bookings = Booking::where('user_id', auth()->id())->get();

        // Return the booked vehicles to the view
        return view('dashboard', compact('bookings'));
    }
*/
    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Check if the booking belongs to the authenticated user
        if ($booking->user_id != auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to cancel this booking.');
        }

        // Update the vehicle availability to true (available again)
        $vehicle = $booking->vehicle;
        $vehicle->availability = true;
        $vehicle->save();

        // Delete the booking
        $booking->delete();

        return redirect()->route('bookings.showBookedVehicles')->with('success', 'Booking canceled successfully.');
    }
}
