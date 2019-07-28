<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;

class ArchivedController extends Controller
{
    public function index()
    {
        return Voucher::onlyTrashed()->paginate(10);
    }

    public function store(Request $request)
    {
       
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
      
    }

    public function destroy($id, Request $request)
    {
        Voucher::withTrashed()->find($id)->restore();
    }
}
