<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
class AppVersionController extends Controller
{
    public function index()
    {
        return App::get()->first();
    }

    public function update(Request $request, $id)
    {
        $app = App::findOrFail($id);
        $this->validate($request,[
            'app_version' => 'required', 
        ]);
        $app->update($request->all());
    }
}
