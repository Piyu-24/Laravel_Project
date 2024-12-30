<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::where('availability', 1)
            ->when($request->query('search'), function ($query) use ($request) {
                return $query->where('model', 'like', '%' . $request->query('search') . '%');
            })

            ->get();


        return view('dashboard', compact('vehicles'));
    }






    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Ensure you are retrieving all relevant details of the vehicle
        $vehicles = Vehicle::where('model', 'like', '%' . $searchTerm . '%')
            ->where('availability', 1) // Ensure that only available vehicles are returned
            ->get();

        // Return the view with the filtered vehicles to the dashboard
        return view('dashboard', compact('vehicles'));  // Return to 'dashboard' view
    }


}
