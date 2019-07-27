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
        'message' => 'required'
     ]);  

        Mail::send('email-contact',[ 
            'msg' => $request->message
        ], function ($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('goldcoastdiscounts1@gmail.com')->subject($request->subject);
        });
        return redirect()->back()->with('success_message', '');
    }
}
