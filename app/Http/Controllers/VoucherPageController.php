<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Category;
use Carbon\Carbon;
use Auth;

class VoucherPageController extends Controller
{
    public function index()
    {
        $vouchersPerPage = 8;
        $vouchers = Voucher::latest()->paginate($vouchersPerPage);
        $categories = Category::orderBy('id')->get();
        if(\Auth::check()){
            $user = \Auth::user();
           } else {
            $user = false;
          }
          foreach($vouchers as $voucher){
            if($user){
                $favourite = $user->getfavourites()->where([
                    ['user_id', '=', Auth::user()->id],
                    ['voucher_id', '=', $voucher->id]
                    ])->first();
            
                if ($favourite){
                    $voucher->isFavourited = true;
                } 

                $redemption = $user->redeems()->where([
                ['created_at', '>=', Carbon::now()->subHours($voucher->timeout)],
                ['voucher_id', '=', $voucher->id]
                ])->first();
    
                if ($redemption){
                    $voucher->isRedeemed = true;
                    $voucher->redeemedAt = $redemption->created_at->toDayDateTimeString();
                    $voucher->redeemAvailable = $redemption->created_at->addHours($voucher->timeout)->toDayDateTimeString();  
                }
            }
        }
        return view('vouchers', compact('vouchers','categories')); 
    }
    public function newest_all()
    {
        $vouchersPerPage = 8;
        $vouchers = Voucher::latest()->paginate($vouchersPerPage);
        $categories = Category::orderBy('id')->get();
        $newestall = 1;
        return view('vouchers', compact('vouchers', 'categories' ,'newestall')); 
    }

    public function popular_all()
    {
        $vouchersPerPage = 8;
        $vouchers = Voucher::latest()->where('popular_flag', '=', '1')->paginate($vouchersPerPage);
        $categories = Category::orderBy('id')->get();
        $popularall = 1;
        return view('vouchers', compact('vouchers', 'categories', 'popularall')); 
    }
}
