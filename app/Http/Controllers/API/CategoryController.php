<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::latest()->paginate(5);
    }
    public function categoryall()
    {
        return Category::latest()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:150'
        ]);

        return Category::create([
            'name' => $request['name'],
        ]);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:150'
        ]);
        $category->update($request->all());
    }

    public function destroy($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->forceDelete(); 
    }
}
