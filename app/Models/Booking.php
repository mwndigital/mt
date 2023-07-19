<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room',
        'checkin_date',
        'checkout_date',
        'arrival_time',
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
    ];

    public function room(){
        return $this->belongsTo(Rooms::class, 'id');
    }
}
