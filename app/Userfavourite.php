<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userfavourite extends Model
{
    protected $fillable = [
        'user_id', 'voucher_id'
    ];
}
