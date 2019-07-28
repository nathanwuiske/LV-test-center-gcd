<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MetricsController extends Controller
{
    public function metrics()
    {
        $metrics['countVouchersUsers'] = $voucherCount = DB::table('vouchers')->count();
        $metrics['countTotalUsers'] = $userCount = DB::table('users')->count();
        $metrics['countUsersToday'] = DB::table('users')->where('created_at', '>=', Carbon::today())->count();
        $metrics['countVouchersToday'] = DB::table('vouchers')->where('created_at', '>=', Carbon::today())->count();
        return $metrics;
    }
}
