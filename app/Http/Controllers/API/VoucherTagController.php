<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vouchertag;

class VoucherTagController extends Controller
{

    public function index()
    {
        return Vouchertag::get();
    }

    public function store(Request $request)
    {
        return Vouchertag::create([
            'tag_id' => $request['tag_title'],
            'voucher_id' => $request['voucher_id'],
        ]);
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
