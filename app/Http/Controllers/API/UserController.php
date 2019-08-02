<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:api'); 
    }

    public function index()
    {
        return User::with('getfavourites')->latest()->paginate(20);
    }

    public function store(Request $request)
    {
       
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
