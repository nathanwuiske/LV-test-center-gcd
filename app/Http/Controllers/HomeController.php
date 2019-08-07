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
       //$this->middleware('auth'); // Only users logged in can access the page
    }

    public function index()
    {
      $vouchers = Voucher::latest()->paginate(5);
      $categories = Category::orderBy('id')->get();
      $popular = Voucher::where('popular_flag', '1')->limit(20)->get();
      $latest = Voucher::latest()->limit(20)->get();
      $businesses = Business::latest()->limit(20)->get();
      if(\Auth::check()){
        $user = \Auth::user();
       } else {
        $user = false;
      }
      foreach($vouchers as $voucher){
        if($user){
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
    if($user){
    foreach($popular as $voucher){
      $favourite = $user->getfavourites()->where([
        ['user_id', '=', Auth::user()->id],
        ['voucher_id', '=', $voucher->id]
        ])->first();

        if ($favourite){
          $voucher->isFavourited = true;
        } 
    }
  
  
    foreach($latest as $voucher){
      $favourite = $user->getfavourites()->where([
        ['user_id', '=', Auth::user()->id],
        ['voucher_id', '=', $voucher->id]
        ])->first();

        if ($favourite){
          $voucher->isFavourited = true;
        } 
    }
  }
      return view('home')->with('vouchers', $vouchers)->with('categories', $categories)
      ->with('popular', $popular)->with('latest', $latest)->with('businesses', $businesses);
    }

    public function addfavourite(Request $request)
    {

      if (!$user = Auth::user()){
        return view('auth.login');
      }
      if (DB::table('user_favourites')->where('user_id', $user->id)->where('voucher_id', $request->get('addfavourite'))->first()){
        $existing = 1;
        return view('favourites')->with('existing', $existing);
      }
      DB::table('user_favourites')->insert(array ('user_id' => $user->id,'voucher_id' => $request->get('addfavourite')));
      $added = 1;
      return view('favourites')->with('added', $added);
    }

    public function removefavourite(Request $request)
    {
      $user = Auth::user(); 
      if(DB::table('user_favourites')->where('user_id',$user->id)->where('voucher_id',$request->get('removefavourite'))->delete()){
        $deleted = 1;
        return view('favourites')->with('deleted', $deleted);
      }
      return view('favourites');
    }

    public function search(Request $request)
    {

    $vouchersPerPage = 8;
    $categories = Category::orderBy('id')->get();
    
    // Seperate search terms by splitting on whitespace and ignoring it
    $terms = preg_split('/\s+/', $request->get('search'), -1, PREG_SPLIT_NO_EMPTY); 
    // If the search is empty, return the default vouchers
    if(empty($terms)){
      $vouchers = Voucher::orderBy('id')->paginate($vouchersPerPage);
    }
    else {
        $vouchers = Voucher::where(function ($query) use ($terms) {
            foreach ($terms as $term) {
                // Loop over the terms and do a search for each.
                $query->orWhere('name', 'like', '%' . $term . '%');
            }
        })->orWhere(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $query->orWhere('description', 'like', '%' . $term . '%');
            }
        })->latest()->paginate($vouchersPerPage);
  }


      return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories)->with('searchname', $request->get('search'));

    }


    public function filter(Request $request){
    
      $categories = Category::orderBy('id')->get();
      $vouchers = Voucher::whereHas('getCategories', function($q) use ($request) {
        $selectValue = $request->get('slct');
        $q->where('category_id', '=', $selectValue);
     })->paginate(8);

     foreach ($categories as $category) {
       if($request->get('slct') == $category->id){
         $categoryname = $category->name;
       }  
      }
      
      
      return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories)->with('categoryname', $categoryname);
  }
}
