<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;
use Illuminate\Database\Eloquent\SoftDeletes;


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
        $onlySoftDeleted = Voucher::onlyTrashed()->get();
        return Voucher::with('gettags')->with('getCategories')->latest()->paginate(10);
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
            'description' => 'required|string|max:500',
            'facebook_link' => 'nullable|url'
            //'expiry_date' => 'required|after:yesterday|before:2030-01-01', //can only set expiry date AFTER the date of voucher creation
            //'popular_flag' => 'required'
            //'photo' => 'required' //must be an image (jpg, png, bmp or gif)
        ]);

        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('imgs/vouchers/').$name); 
            $request->merge(['photo' => $name]);
        }

        return Voucher::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'facebook_link' => $request['facebook_link'],
            'popular_flag' => $request['popular_flag'],
            'expiry_date' => $request['expiry_date'],
            'category' => $request['category'],
            'photo' => $request['photo'],
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
        $voucher = Voucher::findOrFail($id);
        /* Do some validation before updating the voucher */
        $this->validate($request,[
            'name' => 'required|string|max:150', 
            'description' => 'required|string|max:500',
            'facebook_link' => 'nullable|url',
            'expiry_date' => 'required|after:yesterday|before:2030-01-01', 
            'popular_flag' => 'required'
        ]);
        $currentPhoto = $voucher->photo;   
        if($request->photo != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('imgs/vouchers/').$name); 
            $request->merge(['photo' => $name]);

            $getCurrentPhoto = public_path('imgs/vouchers/'.$currentPhoto);
            if(file_exists($getCurrentPhoto)){
                @unlink($getCurrentPhoto); /* Delete the previous photo that is being updated */
            }
        }
        $voucher->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->is_archive == "yes"){
            $voucher = Voucher::findOrFail($id);
            $voucher->delete(); //soft delete (archive)
         
        }
        else if ($request->is_archive == "no"){
            $voucher = Voucher::findOrFail($id);
            $voucher->forceDelete(); // permanent delete
        }
    }
}
