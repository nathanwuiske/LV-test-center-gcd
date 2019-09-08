<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Voucher;
use App\Category;
use App\User;
use App\Business;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Userfavourite;
class HomeController extends Controller
{
    
    public function __construct()
    {
      
    }

    public function index()
    {
      $categories = Category::orderBy('id')->get();
      $popular = Voucher::where('popular_flag', '1')->limit(20)->get();
      $sorted_expiry = Voucher::orderBy('expiry_date')->limit(20)->get();
      $latest = Voucher::latest()->limit(20)->get();
      $businesses = Business::latest()->limit(20)->get();

      $popular_latest_merge =  $popular->merge($latest);
      $all_home_vouchers = $popular_latest_merge->merge($sorted_expiry);

      if(\Auth::check()){
        $user = \Auth::user();
       } else {
        $user = false;
      }
      $now = Carbon::now();
      foreach($all_home_vouchers as $voucher) {
        $end = Carbon::parse($voucher->expiry_date);
        $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
        $voucher->expiry_days = $DeferenceInDays;
      }
    if($user){
      foreach($all_home_vouchers as $voucher){
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
      return view('home', compact('popular', 'categories', 'latest','businesses', 'sorted_expiry', 'all_home_vouchers'));
    }

    public function removefavourite(Request $request)
    {
      $user = Auth::user(); 
      if(DB::table('user_favourites')->where('user_id',$user->id)->where('voucher_id',$request->get('removefavourite'))->delete()){
        return redirect('favourites')->with('deleted', 'Voucher removed from favourites');
      }
      return view('favourites');
    }

    public function search(Request $request)
    {
      if(\Auth::check()){
        $user = \Auth::user();
       } else {
        $user = false;
      }
    $vouchersPerPage = 8;
    $categories = Category::orderBy('id')->get();
    
    // Seperate search terms by splitting on whitespace and ignoring it
    $terms = preg_split('/\s+/', $request->get('search'), -1, PREG_SPLIT_NO_EMPTY); 
    // If the search is empty, return the default vouchers
    if(empty($terms)){
      $now = Carbon::now();
  
      $vouchers = Voucher::orderBy('id')->paginate($vouchersPerPage);
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
    }
    else {
      
        $vouchers = Voucher::with('gettags')->where(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $query->orWhere('name', 'like', '%' . $term . '%');
            }
        })->orWhere(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $query->orWhere('description', 'like', '%' . $term . '%');
            }
        })->orWhereHas('gettags', function($q) use ($terms){
          foreach ($terms as $term) {
            $q->where('tag_title', 'like', '%' . $term . '%');
        }
       })->paginate($vouchersPerPage);
    
        $now = Carbon::now();
        foreach($vouchers as $voucher){
              $end = Carbon::parse($voucher->expiry_date);
              $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
              $voucher->expiry_days = $DeferenceInDays;
         }
        $vouchers->appends(['search' => $request->get('search'), 'per_page' => "8"]);
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
  }
      return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories)->with('searchname', $request->get('search'));

    }


    public function filter(Request $request){
      if(\Auth::check()){
        $user = \Auth::user();
       } else {
        $user = false;
      }
      $categories = Category::orderBy('id')->get();
      $vouchers = Voucher::whereHas('getCategories', function($q) use ($request) {
        $selectValue = $request->get('slct');
        $q->where('category_id', '=', $selectValue);
     })->paginate(8);
     $vouchers->appends(['slct' => $request->get('slct'), 'per_page' => "8"]);
     $now = Carbon::now();
     foreach($vouchers as $voucher){
           $end = Carbon::parse($voucher->expiry_date);
           $DeferenceInDays = $end->startOfDay()->diffInDays($now->startOfDay());
           $voucher->expiry_days = $DeferenceInDays;
      }


     foreach ($categories as $category) {
       if($request->get('slct') == $category->id){
         $categoryname = $category->name;
       }  
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
      return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories)->with('categoryname', $categoryname);
  }
}
