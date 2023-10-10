<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuCategory::create([
            'name' => 'Starters',
        ]);
        MenuCategory::create([
           'name' => 'Mains'
        ]);
        MenuCategory::create([
            'name' => 'sides'
        ]);
        MenuCategory::create([
            'name' => 'desserts'
        ]);
    }
}
