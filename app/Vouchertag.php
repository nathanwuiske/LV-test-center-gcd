<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherTag extends Model
{
    protected $fillable = [
        'tag_id', 'voucher_id'
    ];
}
