<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Business;

class BusinessController extends Controller
{

    public function index()
    {
        return Business::latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:150',
            'display' => 'required',
            'image' => 'required'
        ]);

        if($request->image) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('imgs/businesses/'.$name); 
            $request->merge(['image' => $name]);
        }
        return Business::create([
            'name' => $request['name'],
            'display' => $request['display'],
            'image' => $request['image'],
        ]);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $business = Business::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:150',
            'display' => 'required',
        ]);
        $currentImage = $business->image;   
        if($request->image != $currentImage) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('imgs/businesses/'.$name); 
            $request->merge(['image' => $name]);
            $getCurrentImage = 'imgs/businesses/'.$currentImage;
            if(file_exists($getCurrentImage)){
                @unlink($getCurrentImage); /* Delete the previous image that is being updated */
            }
        }
        $business->update($request->all());
    }

    public function destroy($id, Request $request)
    {
        $business = Business::findOrFail($id);
        $currentImage = $business->image;
        $getCurrentImage = 'imgs/businesses/'.$currentImage;
        if(file_exists($getCurrentImage)){
            @unlink($getCurrentImage);
        }
        $business->forceDelete(); 
    }
}
