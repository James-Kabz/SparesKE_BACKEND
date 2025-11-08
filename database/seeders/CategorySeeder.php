<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Engine & Transmission', 'description' => 'Engines, gearboxes, clutch kits, mounts, etc.'],
            ['name' => 'Suspension & Steering', 'description' => 'Shock absorbers, control arms, steering racks.'],
            ['name' => 'Braking System', 'description' => 'Brake pads, discs, calipers, ABS sensors.'],
            ['name' => 'Electrical & Lighting', 'description' => 'Batteries, alternators, headlights, wiring.'],
            ['name' => 'Body & Interior', 'description' => 'Bumpers, doors, dashboards, seats.'],
            ['name' => 'Cooling & Heating', 'description' => 'Radiators, thermostats, AC compressors.'],
            ['name' => 'Fuel & Exhaust', 'description' => 'Fuel pumps, filters, exhaust pipes.'],
            ['name' => 'Tyres & Wheels', 'description' => 'Rims, tyres, wheel nuts, hubs.'],
            ['name' => 'Lubricants & Fluids', 'description' => 'Engine oil, gear oil, brake fluid, coolants.'],
            ['name' => 'Accessories', 'description' => 'Wipers, car mats, covers, cleaning kits.'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
