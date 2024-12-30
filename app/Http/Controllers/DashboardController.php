<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\BookingRequest;  // If you are using BookingRequest model to store booking requests
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all(); // Fetch all vehicles from the database
        return view('dashboard', compact('vehicles')); // Pass vehicles to the view
    }
}
