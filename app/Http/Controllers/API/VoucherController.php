<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* display the latest 10 vouchers */
        return Voucher::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* validate the voucher form before sending it off */
        $this->validate($request,[
            //maybe have a unique:name for name to prevent duplicate vouchers? 
            'name' => 'required|string|max:150', /* max 150 characters*/
            'description' => 'required|string|max:500'
            //'facebook_link' => 'required|url',
            //'expiry_date' => 'required|after:today' //can only set expiry date AFTER the date of voucher creation
            //'photo' => 'required|image' //must be an image (jpg, png, bmp or gif)
        ]);

        return Voucher::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'facebook_link' => $request['facebook_link'],
            'popular_flag' => $request['popular_flag'],
            'expiry_date' => $request['expiry_date'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
    }
}
