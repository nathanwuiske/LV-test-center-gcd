<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userfavourite extends Model
{
    public $table = 'user_favourites';
    protected $fillable = [
        'user_id', 'voucher_id'
    ];
}
