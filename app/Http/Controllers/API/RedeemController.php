<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;
use App\Redeem;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class RedeemController extends Controller
{

    public function index()
    {
        return Redeem::latest()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'voucher_id'  => [
                'required', 
                Rule::unique('redeems')->where(function ($query) use ($request) {
                    return $query
                        ->whereUser_id($request->user_id)
                        ->whereVoucher_id($request->voucher_id);
                }),
            ]
        ]);
        $redeem = new Redeem;
        $redeem->voucher_id = $request['voucher_id'];
        $redeem->user_id = $request['user_id'];
        $redeem->save();        
        $dateRedeemed = $redeem->created_at->toDayDateTimeString(); 
        $dateAvailable = $redeem->created_at->addHours($redeem->voucher()->first()->timeout)->toDayDateTimeString(); 
        return response()->json(['dateRedeemed' => $dateRedeemed, 'dateAvailable' => $dateAvailable]);
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
