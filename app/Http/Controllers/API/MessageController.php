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
            'body' => 'required',
            'image' => 'required'
        ]);

        if($request->image) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('imgs/app_home/'.$name); 
            $request->merge(['image' => $name]);
        }

        return Message::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'image' => $request['image'],
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
        $currentImage = $message->image;   
        if($request->image != $currentImage) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('imgs/app_home/'.$name); 
            $request->merge(['image' => $name]);
            $getCurrentImage = 'imgs/app_home/'.$currentImage;
            if(file_exists($getCurrentImage)){
                @unlink($getCurrentImage); /* Delete the previous image that is being updated */
            }
        }
        $message->update($request->all());
    }


    public function destroy($id, Request $request)
    {
        $message = Message::findOrFail($id);
        $currentImage = $message->image;
        $getCurrentImage = 'imgs/app_home/'.$currentImage;
        if(file_exists($getCurrentImage)){
            @unlink($getCurrentImage);
        }
        $message->forceDelete(); 
    }

}
