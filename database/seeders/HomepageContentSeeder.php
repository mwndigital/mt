<?php

namespace Database\Seeders;

use App\Models\HomePageContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomepageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomepageContent::create([
            'hero_banner_title' => 'Welcome to The Mash Tun',
            'hero_banner_content' => 'Our bar is nopw open with an interim menu.  During our renovations, we offer a changing freshly prepared menu.  Please check the bar daily.',
            'hero_banner_background_image' => 'public/pages/homepage/1689069164_outside-image-2.jpg',
            'banner_one_image' => 'public/pages/homepage/1689069164_holding_glencairn_whiksy.webp',
            'banner_one_title' => "In the heart of Scotland's Malt Whisky Country",
            'banner_one_content' => "<p>We have a passion for food and whisky which is reflected in the locally sourced ingredients for our menu and our enviable selection of malts.</p>
<p>As private guests in the separate accommodation, you are welcome to eat or enjoy a dram in The Mash Tun Whisky Bar, where breakfast, lunch, and dinner are available.</p>",
            'banner_one_button_link' => '/the-bar-restaurant',
            'rooms_banner_sub_title' => 'Staying at The Mash Tun',
            'rooms_banner_title' => 'A home from home...',
            'rooms_banner_content' => "<p>We have 5 chic en-suite bedrooms, named after local distilleries.&nbsp; A roll top bath enhances the Glenlivet Room, and most rooms enjoy spectacular views.&nbsp; The Macallan Room, which follows the curve of the building, looks towards Easter Elchies House - the original home of The Macallan Malt Whisky.</p>",
            'rooms_banner_button_link' => '/rooms',
            'spend_night_banner_title' => 'Spend a night with us',
            'spend_night_banner_content' => "<p>When you book a room you won't be charged until you check out.</p>",
            'spend_night_banner_button_link' => '/book-a-room',
            'spend_night_banner_background_image' => "public/pages/homepage/1689069164_book-room-banner-bg.jpg"
        ]);
    }
}
