<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PolicyPages;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            RoomSeeder::class,
            MenuCategorySeeder::class,
            HomepageContentSeeder::class,
            AboutPageContentSeeder::class,
            BarRestaurantContentSeeder::class,
            RoomsPageContentSeeder::class,
            PolicyPagesSeeder::class,
        ]);
    }
}
