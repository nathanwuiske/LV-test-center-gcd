<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MetricsController extends Controller
{
    public function countTotalVouchers()
    {
        $counter = DB::table('vouchers')->count();
        return $counter;
    }

    public function countTotalUsers()
    {
        $counter = DB::table('users')->count();
        return $counter;
    }

    public function countTodaysVouchers()
    {
        $countToday = DB::table('vouchers')->where('created_at', '>=', Carbon::today())->count();
        return $countToday;
    }

    public function countTodaysUsers()
    {
        $countToday = DB::table('users')->where('created_at', '>=', Carbon::today())->count();
        return $countToday;
    }
}
