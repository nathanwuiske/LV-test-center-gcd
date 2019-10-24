<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Businessemail extends Model
{
    public $table = 'business_email';
    protected $fillable = [
        'client_name', 'email', 'business_name', 'client_phone'
    ];
}
