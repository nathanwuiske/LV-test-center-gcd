<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FavouriteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth'); 
  }

  public function index()
  {
    $userFav = Auth::user()->getfavourites()->paginate(12);
    $favCount = $userFav->count();
    $now = Carbon::now();
    foreach($userFav as $voucher){
      $redemption = Auth::user()->redeems()->where([
      ['created_at', '>=', Carbon::now()->subHours($voucher->timeout)],
      ['voucher_id', '=', $voucher->id]
      ])->first();

      if ($redemption){
          $voucher->isRedeemed = true;
          $voucher->redeemedAt = $redemption->created_at->toDayDateTimeString();
          $voucher->redeemAvailable = $redemption->created_at->addHours($voucher->timeout)->toDayDateTimeString();  
      }
  
      $end = Carbon::parse($voucher->expiry_date);
      $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
      $voucher->expiry_days = $DeferenceInDays;
    }
    return view('favourites')->with('userFav', $userFav)->with('favCount', $favCount);
  }
}
