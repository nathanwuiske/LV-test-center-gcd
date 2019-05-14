<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherCategory extends Model
{
    protected $fillable = [
        'category_id', 'voucher_id'
    ];
}
