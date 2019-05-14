<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VoucherCategory;

class VoucherCategoryController extends Controller
{

    public function index()
    {
        return VoucherCategory::get();
    }

    public function store(Request $request)
    {
        return VoucherCategory::create([
            'category_id' => $request['category_id'],
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
        VoucherCategory::where('category_id',  $requestData['category_id'])->where('voucher_id',  $requestData['id'])->delete();
    }
}
