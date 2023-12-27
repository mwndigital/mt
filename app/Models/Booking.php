<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Enums\BookingStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Monarobase\CountryList\CountryListFacade;

class Booking extends Model implements \Serializable
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $table = 'bookings';

    public $incrementing = true;

    protected $keyType = 'string';

    public $deposit = 50;

    protected $fillable = [
        'id',
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
        'additional_information',
        'type',
        'user_id',
        'coupon_id',
        'discount',
        'payment_method',
    ];

    protected $appends = [
        'country_name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (!$booking->booking_ref) {
                $booking->booking_ref = 'mt-' . strtoupper(Str::random(8));
            }
        });
    }


    public function rooms()
    {
        return $this->belongsToMany(Rooms::class, 'booking_room', 'booking_id', 'room_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
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

    public function isDouble()
    {
        return $this->no_of_children >= 2 && $this->no_of_children >= 1 || $this->no_of_adults >= 2 && $this->no_of_children == 0;
    }

    public function getTotalAmount()
    {
        $total = 0;
        foreach ($this->rooms as $room) {
            $total += $room->getTotal($this->isDouble()) * $this->duration_of_stay;
        }

        // Apply discount
        if ($this->coupon) {
            $this->discount = $this->discount ?? $this->coupon->getDiscount($total);
            $total -= $this->discount;
        }

        return $total;
    }

    public function getPayableAmount()
    {
        return $this->getTotalAmount() - $this->deposit;
    }


    public function getRemainingAmount()
    {
        return $this->getTotalAmount() - $this->getCapturedAmount();
    }

    public function getStatus()
    {
        return match ($this->status) {
            'pending' => '<span class="badge text-bg-warning p-2">Deposit Paid</span>',
            'confirmed' => '<span class="badge text-bg-secondary text-bg-approved p-2">Approved</span>',
            'cancelled' => '<span class="badge text-bg-danger p-2">Cancelled</span>',
            'refunded' => '<span class="badge text-bg-danger p-2">Refunded</span>',
            'draft' => '<span class="badge text-bg-secondary p-2">Draft</span>',
            'paid' => '<span class="badge text-bg-success p-2">Paid In Full</span>',
            default => '<span class="badge text-bg-warning">Pending</span>',
        };
    }

    public function createDraftBooking($isRoom)
    {
        // Find an existing booking with the same booking_ref
        $existingBooking = self::where('booking_ref', $this->booking_ref)->first();
        unset($this->room_id);

        if ($existingBooking) {
            // update all fields except booking_ref
            $existingBooking->rooms()->detach();
            $existingBooking->rooms()->sync($this->rooms);
            $existingBooking->update($this->toArray());
            return $existingBooking;
        }


        $currentData = $this->toArray();

        unset($currentData['rooms']);
        $booking = self::create(array_merge($currentData, [
            'status' => BookingStatus::DRAFT,
            'total' =>  $this->getTotalAmount(),
            'type' => $isRoom ? 'room' : 'lodge',
            'user_id' => auth()->user()->id ?? null,
        ]));

        $booking->rooms()->sync($this->rooms);

        return $booking;
    }

    public function createTransaction($amount, $type, $payment_method = null, $data = null, $data2 = null, $transaction_ref = null)
    {
        if (!$transaction_ref) $transaction_ref = $this->booking_ref;

        $this->transactions()->create([
            'transaction_ref' => $transaction_ref,
            'booking_id' => $this->id,
            'amount' => $amount,
            'type' => $type,
            'payment_method' => $payment_method,
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
        // $status =  $transaction->refund();
    }


    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function isPaid()
    {
        $transaction = $this->transactions->last();
        if (!$transaction) return false;
        return $transaction->type == TransactionType::FULL->value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCountryNameAttribute()
    {
        try {
            return CountryListFacade::getOne($this->country);
        } catch (\Exception $e) {
            return $this->country;
        }
    }

    public function toSearchableArray()
    {
        return [
            'booking_ref' => $this->booking_ref,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'email_address' => $this->email_address,
            'checkin_date' => $this->checkin_date,
        ];
    }
}
