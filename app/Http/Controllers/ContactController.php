<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    //
    public function create()
    {
        return view('contact');
    }
    public function store(Request $request)
    {
     $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
        'phone_number' => 'required',
        'enquiry_type' => 'required',
        'g-recaptcha-response' => 'required|captcha'
     ]);  

        Mail::send('email-contact',[ 
            'msg' => $request->message,
            'phone' => $request->phone_number,
            'type' => $request->enquiry_type,
            'name' => $request->name,
            'email' => $request->email
        ], function ($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('goldcoastdiscounts1@gmail.com')->subject($request->subject);
        });
        return redirect()->back()->with('success_message', '');
    }
}
