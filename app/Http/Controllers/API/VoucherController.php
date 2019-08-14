<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;
use Illuminate\Database\Eloquent\SoftDeletes;


class VoucherController extends Controller
{
    public function index()
    {
        return Voucher::with('gettags')->with('getCategories')->latest()->paginate(10);
    }
    
    public function voucherall()
    {
        return Voucher::latest()->get();
    }

    public function store(Request $request)
    {
        /* validate the voucher form */
        $this->validate($request,[
            //maybe have a unique:name for name to prevent duplicate vouchers? 
            'name' => 'required|string|max:150', /* max 150 characters*/
            'description' => 'required|string|max:500',
          //  'timeout' => 'required|numeric',
            'website_link' => 'nullable|url'
          //  'expiry_date' => 'required|after:yesterday|before:2030-01-01', //can only set expiry date AFTER the date of voucher creation
           // 'popular_flag' => 'required'
            //'image' => 'required' //must be an image (jpg, png, bmp or gif)
        ]);

        if($request->image) {
            /* Get a unique name for voucher image */
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('imgs/vouchers/'.$name); 
            $request->merge(['image' => $name]);
        }

        return Voucher::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'website_link' => $request['website_link'],
            'popular_flag' => $request['popular_flag'],
            'expiry_date' => $request['expiry_date'],
            'category' => $request['category'],
            'timeout' => $request['timeout'],
            'image' => $request['image'],
        ]);
    }

    public function show($id)
    {
        
    }
  
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        /* validation before updating the voucher */
        $this->validate($request,[
            'name' => 'required|string|max:150', 
            'description' => 'required|string',
            'website_link' => 'nullable|url',
            'timeout' => 'required|numeric',
           // 'expiry_date' => 'required|after:yesterday|before:2030-01-01', 
            'popular_flag' => 'required'
        ]);
        $currentImage = $voucher->image;   
        if($request->image != $currentImage) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('imgs/vouchers/'.$name); 
            $request->merge(['image' => $name]);

            $getCurrentImage = 'imgs/vouchers/'.$currentImage;
            if(file_exists($getCurrentImage)){
                @unlink($getCurrentImage); /* Delete the previous image that is being updated */
            }
        }
        $voucher->update($request->all());
    }

    public function destroy($id, Request $request)
    {
        if($request->is_archive == "yes"){
            $voucher = Voucher::findOrFail($id);
            $voucher->delete(); //soft delete (archive)
         
        }
        else if ($request->is_archive == "no"){
            $voucher = Voucher::findOrFail($id);
            $currentImage = $voucher->image;
            $getCurrentImage = 'imgs/vouchers/'.$currentImage;
            if(file_exists($getCurrentImage)){
                @unlink($getCurrentImage); /* Delete the image */
            }
            $voucher->forceDelete(); // permanent delete
        }
    }

    public function search() {
        if ($search = \Request::get('q')) {
            $vouchers = Voucher::where(function($query) use ($search) {
                $query->where('name','LIKE',"%$search%")->orWhere('description','LIKE',"%$search%");
            })->with('gettags')->with('getCategories')->latest()->paginate(10);
        } 
        else {
            $vouchers = Voucher::with('gettags')->with('getCategories')->latest()->paginate(10);
        }
        return $vouchers;
    }
}
