<?php

namespace Database\Seeders;

use App\Models\RestaurantTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RestaurantTable::create([
            'name' => 'Table 1',
            'no_of_seats' => 2,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 2',
            'no_of_seats' => 2,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 3',
            'no_of_seats' => 2,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 4',
            'no_of_seats' => 3,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 5',
            'no_of_seats' => 4,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 6',
            'no_of_seats' => 4,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 7',
            'no_of_seats' => 4,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 8',
            'no_of_seats' => 4,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 9',
            'no_of_seats' => 6,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
        RestaurantTable::create([
            'name' => 'Table 10',
            'no_of_seats' => 6,
            'status' => 'available',
            'bookable_by_guests' => true,
        ]);
    }
}
