<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Businessemail;


class BusinessEmailController extends Controller
{
    public function index()
    {
        return view('business_email'); 
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'business_email' => 'required|max:150', 
            'business_name' => 'max:200',
            'client_name' => 'max:200',
            'client_phone' => 'max:200'
        ]);



         Businessemail::create([
            'business_name' => $request['business_name'],
            'email' => $request['business_email'],
            'client_name' => $request['client_name'],
            'client_phone' => $request['client_phone'],
        ]);

        return redirect()->back()->with('success_message', '');
    }
}
