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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'facebook_link', 'popular_flag', 'expiry_date', 'category', 'photo'
    ];
}
