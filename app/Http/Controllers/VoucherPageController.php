<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Category;

class VoucherPageController extends Controller
{
    public function index()
    {
        $vouchersPerPage = 8;
        $vouchers = Voucher::latest()->paginate($vouchersPerPage);
        $categories = Category::orderBy('id')->get();
        return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories); 
    }
    public function newest_all()
    {
        $vouchersPerPage = 8;
        $vouchers = Voucher::latest()->paginate($vouchersPerPage);
        $categories = Category::orderBy('id')->get();
        $newestall = 1;
        return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories)->with('newestall', $newestall); 
    }

    public function popular_all()
    {
        $vouchersPerPage = 8;
        $vouchers = Voucher::latest()->where('popular_flag', '=', '1')->paginate($vouchersPerPage);
        $categories = Category::orderBy('id')->get();
        $popularall = 1;
        return view('vouchers')->with('vouchers', $vouchers)->with('categories', $categories)->with('popularall', $popularall); 
    }
}
