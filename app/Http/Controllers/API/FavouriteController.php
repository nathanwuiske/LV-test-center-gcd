<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Userfavourite;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FavouriteController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'voucher_id'  => [
                'required', 
                Rule::unique('user_favourites')->where(function ($query) use ($request) {
                    return $query
                        ->whereUser_id($request->user_id)
                        ->whereVoucher_id($request->voucher_id);
                }),
            ]
        ]);

        return Userfavourite::create([
            'user_id' => $request['user_id'],
            'voucher_id' => $request['voucher_id'],
        ]);
        
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
}
