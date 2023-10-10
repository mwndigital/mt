<?php

namespace Database\Seeders;

use App\Models\BarRestaurantContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarRestaurantContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BarRestaurantContent::create([
            'page_title' => 'The Bar',
            'page_slug' => 'the-bar-restaurant',
            'hero_banner_title' =>  'The Bar & Restaurant',
            'hero_banner_background_image' => 'public/pages/bar_restaurant/1689165825_restaurant-main.jpeg',
            'banner_one_content' => '<p><strong>We have a limited number of tables available therefore booking in advanced is highly recommended.</strong></p>
<p>At the Mash Tun we have a real passion for great food and Scottish malt whisky. This is reflected in the locally sourced and well presented food offered by our friendly, helpful and knowledgeable staff. Head chef Nick alongside sous chef Nina are passionate about Scottish contemporary cooking, and you will find The Mash Tun Menu a treasure trove of fantastic flavours.</p>
<p>Enjoy locally sourced food and Scottish whisky, and stay in one of our give whisky themed rooms situated above the bar area. Comfortable and well appointed, each of our rooms are individual and named after local whisky distilleries.</p>',
            'banner_one_big_image' => 'public/pages/bar_restaurant/1689165825_food-image-one.webp',
            'banner_one_small_image' => 'public/pages/bar_restaurant/1689165825_brownie-with-creame.webp',
            'separator_banner_image' => 'public/pages/bar_restaurant/1689165825_bar-restaurant-image-one.jpeg',
            'banner_two_title' => 'The Whiskies',
            'banner_two_content' => '<p>&nbsp;The Mash Tun is home to a wide and varied selection of whiskies, both single malts and blends, predominately from Speyside but also incorporating distilleries from the rest of Scotland. Included in this selection is the exclusive Glenfarclas Family Cash Collection.</p>
<p>The Family Casks are a unique collection of 52 single cask whiskies, with one for each consecutive year from 1952 to 2003. The collection is unique as there is no other known collection of rare and old whiskies that covers 52 consecutive years from the same distillery.</p>
<p>The Mash Tun is home to the largest collection of the Glenfarclas Family Casks in the world that is on display and available to drink by the dram.</p>
<p>Our small team of enthusiastic staff are here to assist and guide you through the collection of whiskies we currently have at the famous Mash Tun Whisky Bar.</p>
<p>There is a wide range of whiskies available to suit all tastes and budgets with prices ranging from &pound;3.50 to &pound;1500 per 35ml dram.&nbsp;</p>',
            'banner_two_image' => 'public/pages/bar_restaurant/1689165825_holding_glencairn_whiksy.webp',
            'book_stay_banner_title' => 'Book a stay today',
            'book_stay_banner_content' => "<p>When you book a room with us, you won't be charged until you check out.&nbsp;</p>",
            'book_stay_banner_background_image' => 'public/pages/bar_restaurant/1689165825_bed-with-flowers-image.webp',
            'page_type' => 'website'
        ]);
    }
}
