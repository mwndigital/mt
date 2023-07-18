<?php

namespace Database\Seeders;

use App\Models\RoomsPageContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsPageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomsPageContent::create([
            'page_title' => 'Our Rooms',
            'page_slug' => 'our_rooms',
            'hero_banner_title' => 'Our Rooms',
            'hero_banner_background_image' => "public/pages/roomspage/1689332723_bed-with-flowers-image.webp",
            'rooms_info_banner_content' => "<p>We have 5 chic en-suite bedrooms, named after local distilleries. A roll top bath enhances The Glenlivet Room, and most rooms enjoy glorious views over the River Spey. The Macallan Room, which follows the curve of the building, looks towards Easter Elchies House - the original home of The Macallan Malt Whisky.&nbsp;</p>",
            'page_type' => 'website',
        ]);
    }
}
