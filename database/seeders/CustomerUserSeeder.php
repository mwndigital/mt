<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'first_name' => 'Matt',
           'last_name' => 'Noye',
           'email' => 'matty_noye@live.com',
           'password' => Hash::make('password'),
           'email_verified_at' => Carbon::now(),
        ])->assignRole('customer');
    }
}
