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
        $this->validate($request,[
            'tag_id' => 'required|numeric', 
            'voucher_id' => 'required|numeric'
        ]);
        return Vouchertag::create([
            'tag_id' => $request['tag_id'],
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
        $requestData = $request->all();
        Vouchertag::where('tag_id',  $requestData['tag_id'])->where('voucher_id',  $requestData['id'])->delete();
    }
}
