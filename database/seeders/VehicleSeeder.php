<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add vehicles using Eloquent
        Vehicle::create([
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2020,
            'color' => 'White',
            'price_per_day' => 50.00,
            'image' => 'images/toyota_camry.jpeg',
            'vehicle_type' => 'car',
            'availability' => true, // Ensure this matches your Vehicle model schema
        ]);

        Vehicle::create([
            'make' => 'Toyota',
            'model' => 'Highlander',
            'year' => 2023,
            'color' => 'Black',
            'price_per_day' => 45.00,
            'image' => 'images/toyota-highlander.jpeg',
            'vehicle_type' => 'car',
            'availability' => true,
        ]);

        Vehicle::create([
            'make' => 'Ford',
            'model' => 'Transit',
            'year' => 2021,
            'color' => 'Grey',
            'price_per_day' => 80.00,
            'image' => 'images/ford_transit.jpeg',
            'vehicle_type' => 'van',
            'availability' => true,
        ]);

        Vehicle::create([
            'make' => 'Honda',
            'model' => 'Civic',
            'year' => 2022,
            'color' => 'White',
            'price_per_day' => 30.00,
            'image' => 'images/honda-civic.jpeg',
            'vehicle_type' => 'Car', // Type: Car
            'availability' => true,
        ]);

        Vehicle::create([
            'make' => 'Ford',
            'model' => 'Explorer',
            'year' => 2021,
            'color' => 'Blue',
            'price_per_day' => 50.00,
            'image' => 'images/ford-explorer.jpeg',
            'vehicle_type' => 'Jeep', // Type: Jeep
            'availability' => true,
        ]);


        // Add more vehicles here as needed
    }
}
