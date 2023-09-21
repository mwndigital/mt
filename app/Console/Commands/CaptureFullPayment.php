<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Enums\BookingStatus;

class CaptureFullPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:capture-full-payment';

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

        $bookings = Booking::where('checkin_date', '<=', now()->toDateTimeString())
            ->where('status', BookingStatus::CONFIRMED, BookingStatus::PENDING)
            ->get();

        foreach ($bookings as $booking) {
            // Check if teh time before 24  and before 14:00 on the day before the booking
            $bookingDate = \Carbon\Carbon::parse($booking->checkin_date);
            $paymentDueDate = $bookingDate->subDays(1)->setTime(14, 0, 0);
            $now = now();

            if ($now->greaterThanOrEqualTo($paymentDueDate)) {
                $transaction = $booking->transactions->first();
                $status = $transaction->captureRemaining();
                // Only update if operation successful
                if ($status) {
                    $booking->status = BookingStatus::PAID;
                    $booking->save();
                }

                if ($booking->isPaid()) {
                    $booking->status = BookingStatus::PAID;
                    $booking->save();
                }

                $this->info("Final payment processed for Booking ID: {$booking->id}");
            }
        }
        $this->info('All done!');
    }
}
