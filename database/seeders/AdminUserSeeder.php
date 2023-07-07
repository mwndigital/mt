<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'password' => Hash::make('password'),
            'email' => 'admin@cgarsltd.com',
            'email_verified_at' => Carbon::now(),
        ])->assignRole(['super admin', 'admin']);
        User::create([
            'first_name' => 'Matt',
            'last_name' => 'Noye',
            'email' => 'matt@cgarsltd.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
        ])->assignRole(['super admin', 'admin']);
    }
}
