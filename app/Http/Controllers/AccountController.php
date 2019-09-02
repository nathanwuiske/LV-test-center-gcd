<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
      $getUser = User::findOrFail($id);
      $this->validate($request,[
          'full_name' => 'required|string|max:50',
          'phone_number' => 'nullable|digits:10'
      ]);
      $getUser->update($request->all());
    }

    public function index()
    {
      return view('account');
    }
}
