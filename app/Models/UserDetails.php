<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'address_line_one',
        'address_line_two',
        'town_city',
        'postcode',
        'country',
        'dietary_information',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
