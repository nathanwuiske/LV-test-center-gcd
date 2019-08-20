<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
       //$this->middleware('auth:api'); 
    }

    public function index()
    {
        return User::with('getfavourites')->latest()->paginate(10);
    }

    public function returnall()
    {
        return User::with('getfavourites')->latest()->get();
    }

    public function store(Request $request)
    {
       
    }

    public function show($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,[
            'first_name' => 'required|string|max:150',
            'email' => 'required|email',
            'phone_number' => 'nullable|numeric',
            'type' => 'required'
        ]);
        $user->update($request->all());
    }


    public function destroy($id, Request $request)
    {
  
    }

    public function search() {
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search) {
                $query->where('first_name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%");
            })->latest()->paginate(10);
        } 
        else {
            $users = User::latest()->paginate(10);
        }
        return $users;
    }

}
