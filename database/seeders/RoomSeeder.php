<?php

namespace Database\Seeders;

use App\Models\Rooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rooms::create([
            'name' => 'The Glenlivet Room',
            'room_type' => 'double',
            'adult_cap' => '2',
            'child_cap' => '1',
            'bathroom_type' => 'ensuite_bath',
            'description' => '<p>Top floor double room contains one double bed with en-suite bathroom containing a roll top bath and shower and a view of the River Spey.</p>',
            'short_description' => '<p>Top floor double room contains one double bed with en-suite bathroom containing a roll top bath and shower and a view of the River Spey.</p>',
            'price_per_night_double' => '175',
            'price_per_night_single' => '155',
            'featured_image' => 'public/uploads/rooms/JX48zt0rmYQp5JC3IGI9Woz3sRPiJoMmzldKhIdi.webp',
        ]);
        Rooms::create([
            'name' => 'The Macallan Room',
            'room_type' => 'twin',
            'adult_cap' => '2',
            'child_cap' => '1',
            'bathroom_type' => 'ensuite_shower',
            'description' => '<p>Top floor twin room contains two single beds with an en-suite shower room and a view of the River Spey</p>',
            'short_description' => '<p>Top floor twin room contains two single beds with an en-suite shower room and a view of the River Spey</p>',
            'price_per_night_double' => '165',
            'price_per_night_single' => '145',
            'featured_image' => 'public/uploads/rooms/jRtzPf7tDxgXQYBNbxebWALY5qt4oTDua3O6xi7Z.webp',
        ]);
        Rooms::create([
            'name' => 'The Glenfiddich Room',
            'room_type' => 'double',
            'adult_cap' => '2',
            'child_cap' => '0',
            'bathroom_type' => 'ensuite_shower',
            'description' => '<p>Double room contains one double bed with an en-suite shower room and is situated on the first floor.</p>',
            'short_description' => '<p>Double room contains one double bed with an en-suite shower room and is situated on the first floor.</p>',
            'price_per_night_double' => '155',
            'price_per_night_single' => '135',
            'featured_image' => 'public/uploads/rooms/RH6cFpWU8MqRREW84aTw1C4N436mBjsDOON6rWS5.webp',
        ]);
        Rooms::create([
            'name' => 'The Arberlour Suite',
            'room_type' => 'family',
            'adult_cap' => '2',
            'child_cap' => '2',
            'bathroom_type' => 'ensuite_bath',
            'description' => '<p>Family room with a double bed and a double bed settee and contains an en-suite bathroom.&nbsp; It is situated on the first floor and sleep as maximum of 4 people.</p>',
            'short_description' => '<p>Family room with a double bed and a double bed settee and contains an en-suite bathroom.&nbsp; It is situated on the first floor and sleep as maximum of 4 people.</p>',
            'price_per_night_double' => '180',
            'price_per_night_single' => '160',
            'featured_image' => 'public/uploads/rooms/1ta330Z6myzWBChDddAbw7wxyVZCZ0LJIdOQSehX.webp',
        ]);
        Rooms::create([
            'name' => 'The Glenfarclas Room',
            'room_type' => 'double',
            'adult_cap' => '2',
            'child_cap' => '0',
            'bathroom_type' => 'ensuite_shower',
            'description' => '<p>Double room contains one double bed with an en-suite shower room which is situated on the first floor and has a view of the River Spey.</p>',
            'short_description' => '<p>Double room contains one double bed with an en-suite shower room which is situated on the first floor and has a view of the River Spey.</p>',
            'price_per_night_double' => '165',
            'price_per_night_single' => '145',
            'featured_image' => 'public/uploads/rooms/IdZlPXH4ionP20fLvySD08OeiJ1qLv0p2kSoFT1O.webp',
        ]);
    }
}
