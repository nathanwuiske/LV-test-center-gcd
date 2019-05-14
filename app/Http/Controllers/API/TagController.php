<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{

    public function index()
    {
        return Tag::get();
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tag_title' => 'required|string|max:150'
        ]);

        return Tag::create([
            'tag_title' => $request['tag_title'],
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $this->validate($request,[
            'tag_title' => 'required|string|max:150'
        ]);
        $tag->update($request->all());
    }

    public function destroy($id, Request $request)
    {
        $tag = Tag::findOrFail($id);
        $tag->forceDelete(); 
    }
}
