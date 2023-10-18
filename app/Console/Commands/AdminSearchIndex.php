<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\RestaurantBooking;
use Illuminate\Console\Command;

class AdminSearchIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin-search-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Booking::searchable();
        RestaurantBooking::searchable();
    }
}
