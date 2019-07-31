<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;

class LocationController extends Controller
{
    public function index()
    {
        return Location::latest()->paginate(5);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:150', 
            'lat' => 'required|numeric',
            'long' => 'required|numeric'
        ]);

        return Location::create([
            'name' => $request['name'],
            'longitude' => $request['long'],
            'latitude' => $request['lat'],
        ]);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|max:150'
        ]);
        $location->update($request->all());
    }

    public function destroy($id, Request $request)
    {
        $location = Location::findOrFail($id);
        $location->forceDelete(); 
    }
}
