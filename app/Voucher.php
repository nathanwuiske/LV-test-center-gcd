<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use Notifiable;
    use SoftDeletes;

    public function gettags()
    {
        return $this->belongsToMany('App\Tag', 'voucher_tags');
    }
   
    public function getCategories()
    {
        return $this->belongsToMany('App\Category', 'voucher_categories');
    }

    protected $fillable = [
        'name', 'description', 'website_link', 'popular_flag', 'expiry_date', 'image', 'latitude', 'longitude'
    ];
}
