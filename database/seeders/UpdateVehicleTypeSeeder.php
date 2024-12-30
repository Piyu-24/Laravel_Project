<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class UpdateVehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::whereIn('id', [1, 2])->update(['type' => 'car']); // Replace IDs as needed
        Vehicle::whereIn('id', [3])->update(['type' => 'van']); // Example
    }
}
