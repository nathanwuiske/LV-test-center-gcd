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
        $vouchers = Voucher::latest()->paginate(12);
        $categories = Category::orderBy('id')->get();
        if(\Auth::check()){
            $user = \Auth::user();
           } else {
            $user = false;
          }
          $now = Carbon::now();
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
            $end = Carbon::parse($voucher->expiry_date);
            $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
            $voucher->expiry_days = $DeferenceInDays;
        }
        return view('vouchers', compact('vouchers','categories')); 
    }
    public function newest_all()
    {
        $vouchers = Voucher::latest()->paginate(12);
        $categories = Category::orderBy('id')->get();
        $newestall = 1;
        if(\Auth::check()){
            $user = \Auth::user();
           } else {
            $user = false;
          }
        $now = Carbon::now();
        foreach($vouchers as $voucher){
              $end = Carbon::parse($voucher->expiry_date);
              $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
              $voucher->expiry_days = $DeferenceInDays;
         }
         if($user){
            foreach($vouchers as $voucher){
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
        return view('vouchers', compact('vouchers', 'categories' ,'newestall')); 
    }

    public function popular_all()
    {
        if(\Auth::check()){
            $user = \Auth::user();
           } else {
            $user = false;
          }
        $vouchers = Voucher::latest()->where('popular_flag', '=', '1')->paginate(12);
        $categories = Category::orderBy('id')->get();
        $popularall = 1;
        $now = Carbon::now();
        foreach($vouchers as $voucher){
              $end = Carbon::parse($voucher->expiry_date);
              $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
              $voucher->expiry_days = $DeferenceInDays;
         }

         if($user){
            foreach($vouchers as $voucher){
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
        return view('vouchers', compact('vouchers', 'categories', 'popularall')); 
    }

    public function expiry_all()
    {
        if(\Auth::check()){
            $user = \Auth::user();
           } else {
            $user = false;
          }
        $vouchers = Voucher::orderBy('expiry_date')->paginate(12);
        $categories = Category::orderBy('id')->get();
        $expiryall = 1;
        $now = Carbon::now();
        foreach($vouchers as $voucher){
              $end = Carbon::parse($voucher->expiry_date);
              $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
              $voucher->expiry_days = $DeferenceInDays;
         }
         if($user){
            foreach($vouchers as $voucher){
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
        return view('vouchers', compact('vouchers', 'categories', 'expiryall')); 
    }

    public function searchBusiness(Request $request){
        if(\Auth::check()){
            $user = \Auth::user();
           } else {
            $user = false;
          }
        $categories = Category::orderBy('id')->get();
             if($request->business_name){
                 $searchTerm = $request->business_name;
             }
            $vouchers = Voucher::where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'like', '%' . $searchTerm . '%');
            })->orWhere(function ($query) use ($searchTerm) {
                    $query->orWhere('description', 'like', '%' . $searchTerm . '%');
            })->paginate(12);
            $now = Carbon::now();
            foreach($vouchers as $voucher){
                  $end = Carbon::parse($voucher->expiry_date);
                  $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
                  $voucher->expiry_days = $DeferenceInDays;
             }
        $vouchers->appends(['search' =>  $searchTerm, 'per_page' => "8"]);
           $searchname =  $searchTerm;
           if($user){
            foreach($vouchers as $voucher){
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
           return view('vouchers', compact('vouchers', 'categories', 'searchname')); 
           return $request->all();
        }
      }
    
     
  

