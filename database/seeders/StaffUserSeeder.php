<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'first_name' => 'Mash Tun',
           'last_name' => 'Team',
           'email' => 'reservations@mashtun-aberlour.com',
            'password' => Hash::make('MtTeam2023!!'),
            'email_verified_at' => Carbon::now(),
        ])->assignRole('staff');
    }
}
