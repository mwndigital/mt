<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormSubmissions extends Model
{
    use HasFactory;

    protected $table = 'contact_form_submission';

    protected $fillable = [
        'name',
        'email',
        'yourMessage',
        'read'
    ];
}
