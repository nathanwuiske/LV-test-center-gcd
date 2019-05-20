<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;
use App\Redeem;
use App\User;
use Carbon\Carbon;

class RedeemController extends Controller
{

    public function index()
    {
        
    }

    public function store(Request $request)
    {
        /*
        $redeem = new Redeem;
        $redeem->voucher_id = $request['voucher_id'];
        $redeem->user_id = $request['user_id'];
        $redeem->save();        
        $dateRedeemed = $redeem->created_at->toDayDateTimeString(); //Get Date Redeemed in readable format
        $dateAvailable = $redeem->created_at->addHours($redeem->voucher()->first()->timeout)->toDayDateTimeString(); //Get Date available for next redeem in readable format
        
        return response()->json(['dateRedeemed' => $dateRedeemed, 'dateAvailable' => $dateAvailable]);
       */
       $redeemedVouchers = array();
       $user = User::latest()->first(); //$user = $request->user();
        $vouchers = Voucher::latest()->get();
        foreach($vouchers as $voucher){
                $redemption = $user->redeems()->where([
                ['created_at', '>=', Carbon::now()->subHours($voucher->timeout)],
                ['voucher_id', '=', $voucher->id]
                ])->first();
                if ($redemption){
                    //$voucher->isRedeemed = true;
                    $voucher->redeemedAt = $redemption->created_at->toDayDateTimeString();
                    $voucher->redeemAvailable = $redemption->created_at->addHours($voucher->timeout)->toDayDateTimeString();  
                    array_push($redeemedVouchers, [$voucher->name, $voucher->redeemedAt, $voucher->redeemAvailable]);
                }
            
        } 
        return response()->json(['Redeemed' => $redeemedVouchers]);
       
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id, Request $request)
    {
       
    }

    public function redeem(Request $request){


    }
}
