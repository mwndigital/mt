<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Booking;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'start_date',
        'end_date',
        'status',
        'max_uses',
        'uses',
    ];

    protected $dates = ['start_date', 'end_date'];

    // Define the allowed types using an enum
    public const TYPE_PERCENTAGE = 'percentage';
    public const TYPE_FIXED = 'fixed';

    public static $allowedTypes = [
        self::TYPE_PERCENTAGE,
        self::TYPE_FIXED,
    ];

    // Define validation rules
    public static $rules = [
        'code' => 'required|unique:coupons,code',
        'type' => 'required|in:' . self::TYPE_PERCENTAGE . ',' . self::TYPE_FIXED,
        'value' => 'required|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'status' => 'required',
        // 'max_uses' => 'required|integer|min:1',
        // 'uses' => 'required|integer|min:0',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Custom validation method
    public static function validate(array $data)
    {
        return validator($data, self::$rules);
    }

    public function isValid(): bool
    {
        $now = Carbon::now();
        return ($this->start_date <= $now && $this->end_date >= $now && $this->status == 'Active');
    }

    public function isPercentage(): bool
    {
        return $this->type === self::TYPE_PERCENTAGE;
    }

    public function isFixed(): bool
    {
        return $this->type === self::TYPE_FIXED;
    }

    public function getDiscount($total): float
    {
        if ($this->isPercentage()) {
            return $this->value / 100 * $total;
        }

        return $this->value;
    }

    // get status attribute
    public function getStatusAttribute($value)
    {
        return $value ? 'Active' : 'Inactive';
    }
}
