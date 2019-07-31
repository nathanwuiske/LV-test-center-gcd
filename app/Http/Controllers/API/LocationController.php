<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;
use App\Voucher;

class LocationController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $voucherLocation = Voucher::findOrFail($id);
        $voucherLocation->update($request->all());
    }

    public function destroy($id, Request $request)
    {
        
    }
}
