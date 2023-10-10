<?php

namespace Database\Seeders;

use App\Models\AboutPageContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutPageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutPageContent::create([
            'page_title' => 'About Us',
            'page_slug' => 'about-us',
            'hero_banner_background_image' => 'public/pages/aboutpage/1689084214_holding_glencairn_whiksy.webp',
            'hero_banner_title' => 'About Us',
            'about_banner_title' => 'About The Mash Tun',
            'about_banner_content' => '<p>Formerly known as "The Station Bar" the building was originally constructed in 1896 by James Campbell, a sea captain, who instructed a marine architect to design the building in the shape of a small ship.</p>
<p>A pledge contained in the title deeds, made in 1963 by the owner at the time states that since Dr Beeching closed the railway in Aberlour then a name change was appropriate - but that if ever a train should pull up at the station again then the pub will revert to "The Station Bar".</p>
<p>The current name comes from the whisky and brewing industry and is the large vessel or vat in which the malted barley is mixed with water and yeast.</p>
<p>Commonly these vessels are anywhere up to eight metres in diameter and up to six metres deep. In practice there are large stirrers that are mechanically driven inside a mash tun.&nbsp;</p>',
            'about_banner_image' => 'public/pages/aboutpage/1689084214_outside-image.jpg',
            'banner_one_image' => 'public/pages/aboutpage/1689084214_dogs-image.webp',
            'banner_one_content' => '<h2>Dogs</h2>
<p>Here at The Mash Tun we are dog friendly, we welcome dogs in our grounds, Bar and Restaurant but not in our rooms.</p>
<h3>Disabled Access</h3>
<p>All of our rooms are accessed via stairs, therefore unsuitable for wheelchair access or people with mobility issues.</p>',
            'banner_two_title' => 'The local area',
            'banner_two_content' => '<p>We can advise guests on how to book fishing on the River Spey or shooting on nearby estates.</p>
<p>Storage for rods, cycles etc is available.&nbsp; The Speyside Way, a popular walking and cycling route is only a few moments away.</p>',
            'banner_two_image' => 'public/pages/aboutpage/1689084214_waterfalls-picture.webp',

        ]);
    }
}
