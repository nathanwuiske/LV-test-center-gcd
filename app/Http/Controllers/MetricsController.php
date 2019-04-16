<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetricsController extends Controller
{
    public function countVouchers()
    {
        $counter = DB::table('vouchers')->count();
        return $counter;
    }

    public function countUsers()
    {
        $counter = DB::table('users')->count();
        return $counter;
    }
}
