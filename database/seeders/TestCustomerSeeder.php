<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'first_name' => 'Matt',
           'last_name' => 'Noye',
           'password' => Hash::make('password'),
           'email' => 'matty_noye@live.com'
        ])->assignRole('customer');
    }
}
