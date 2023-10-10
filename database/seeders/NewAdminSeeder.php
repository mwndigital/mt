<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NewAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Laura',
            'last_name' => 'Bitters',
            'email' => 'laura.bitters@cgars.com',
            'password' => Hash::make('LbCgar2023!'),
            'email_verified_at' => Carbon::now(),
        ])->assignRole(['admin']);
        User::create([
            'first_name' => 'Karen',
            'last_name' => 'Mcwilliam',
            'email' => 'karen.mcwilliam@mashtun-aberlour.com',
            'password' => Hash::make('KmcWMt2023!'),
            'email_verified_at' => Carbon::now(),
        ])->assignRole(['admin']);
    }
}
