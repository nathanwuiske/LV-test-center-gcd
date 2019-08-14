<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Analytics;
use Spatie\Analytics\Period;

class MetricsController extends Controller
{
    public function metrics()
    {
        $metrics['favourited'] = DB::table('user_favourites')
        ->join('vouchers', 'vouchers.id', '=', 'user_favourites.voucher_id')
        ->select('voucher_id', 'vouchers.name', \DB::raw("COUNT('voucher_id') AS favourite_count"))
        ->orderBy('favourite_count', 'desc')
        ->groupBy('voucher_id', 'vouchers.name')
        ->take(5)
        ->get();
        $metrics['redeemed'] = DB::table('redeems')
        ->join('vouchers', 'vouchers.id', '=', 'redeems.voucher_id')
        ->select('voucher_id', 'vouchers.name', \DB::raw("COUNT('voucher_id') AS redeem_count"))
        ->orderBy('redeem_count', 'desc')
        ->groupBy('voucher_id', 'vouchers.name')
        ->take(5)
        ->get();
        $metrics['countTotalVouchers'] = DB::table('vouchers')->count();
        $metrics['countTotalUsers'] = $userCount = DB::table('users')->count();
        $metrics['countUsersToday'] = DB::table('users')->where('created_at', '>=', Carbon::today())->count();
        $metrics['countVouchersToday'] = DB::table('vouchers')->where('created_at', '>=', Carbon::today())->count();
        $metrics['mostVisited'] =  Analytics::fetchMostVisitedPages(Period::days(7), 7);
        $metrics['browser'] =  Analytics::fetchTopBrowsers(Period::days(7));
        $metrics['pageVisits'] = Analytics::fetchVisitorsAndPageViews(Period::days(30), 5);
        $metrics['activeUsers'] = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];
        return $metrics;
    }
    
}
