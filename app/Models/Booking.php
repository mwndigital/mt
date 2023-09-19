<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Enums\BookingStatus;

class Booking extends Model implements \Serializable
{
    use HasFactory;

    protected $table = 'bookings';

    public $incrementing = false;

    protected $keyType = 'string';

    public $deposit = 50; // will be dynamic later

    protected $fillable = [
        'room_id',
        'booking_ref',
        'checkin_date',
        'checkout_date',
        'arrival_time',
        'duration_of_stay',
        'no_of_adults',
        'no_of_children',
        'no_of_infants',
        'user_title',
        'first_name',
        'last_name',
        'address_line_one',
        'address_line_two',
        'postcode',
        'city',
        'country',
        'phone_number',
        'email_address',
        'status',
        'total',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (!$booking->booking_ref) {
                $booking->booking_ref = 'mt-' . strtoupper(Str::random(8));
            }

            $checkin = Carbon::createFromFormat('d-m-Y', $booking->checkin_date);
            $checkout = Carbon::createFromFormat('d-m-Y', $booking->checkout_date);
            $duration = $checkout->diffInDays($checkin);

            $booking->duration_of_stay = $duration;
        });
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function serialize()
    {
        return serialize($this->getAttributes());
    }

    public function unserialize($data)
    {
        $attributes = unserialize($data);
        $this->setRawAttributes($attributes);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getCapturedAmount()
    {
        return $this->transactions->sum('amount');
    }

    public function getTotalAmount()
    {
        if ($this->no_of_children >= 2 && $this->no_of_children >= 1 || $this->no_of_adults >= 2 && $this->no_of_children == 0) {
            $roomPrice = $this->room->price_per_night_double * $this->duration_of_stay;
        } else {
            $roomPrice = $this->room->price_per_night_single * $this->duration_of_stay;
        }
        return $roomPrice;
    }

    public function getPayableAmount()
    {
        return $this->getTotalAmount() - $this->deposit;
    }

    public function getStatus()
    {
        return match ($this->status) {
            'pending' => '<span class="badge text-bg-warning">Pending</span>',
            'confirmed' => '<span class="badge text-bg-success">Confirmed</span>',
            'cancelled' => '<span class="badge text-bg-danger">Cancelled</span>',
            'refunded' => '<span class="badge text-bg-danger">Refunded</span>',
            'draft' => '<span class="badge text-bg-warning">Draft</span>',
            'paid' => '<span class="badge text-bg-success">Paid</span>',
            default => '<span class="badge text-bg-warning">Pending</span>',
        };
    }

    public function createDraftBooking()
    {
        // Find an existing booking with the same booking_ref
        $existingBooking = self::where('booking_ref', $this->booking_ref)->first();

        if ($existingBooking) {
            // update all fields except booking_ref
            $existingBooking->update($this->toArray());
            return;
        }

        // If no existing booking, create a new one
        $this->status = BookingStatus::DRAFT;
        $this->total = $this->getTotalAmount();
        $this->save();
    }

    public function createTransaction($amount, $type, $data = null, $data2 = null)
    {
        $this->transactions()->create([
            'transaction_ref' => $this->booking_ref,
            'booking_id' => $this->id,
            'amount' => $amount,
            'type' => $type,
            'data' => $data,
            'data2' => $data2,
        ]);
    }

    public function confirm()
    {
        // If already confirmed before and cancelled and if balance is zero, then update status to paid
        if ($this->isPaid()) {
            $this->updateStatus(BookingStatus::PAID);
        } else {
            $this->updateStatus(BookingStatus::CONFIRMED);
        }
    }

    public function cancel()
    {
        $this->updateStatus(BookingStatus::CANCELLED);
        $transaction = $this->transactions->first();
        $status =  $transaction->refund();
    }


    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function isPaid()
    {
        return $this->status != BookingStatus::CONFIRMED && $this->total == $this->getCapturedAmount();
    }
}
