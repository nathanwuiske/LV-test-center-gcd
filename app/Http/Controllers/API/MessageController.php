<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class MessageController extends Controller
{

    public function index()
    {
        return Message::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:150',
            'body' => 'required'
        ]);

        return Message::create([
            'title' => $request['title'],
            'body' => $request['body'],
        ]);
    }

    public function show($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|string',
            'body' => 'required|string'
        ]);
        $message->update($request->all());
    }


    public function destroy($id, Request $request)
    {
        $message = Message::findOrFail($id);
        $message->forceDelete(); 
    }

}
