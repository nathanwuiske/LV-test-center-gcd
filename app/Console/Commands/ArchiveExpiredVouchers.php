<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Voucher;
use Carbon\Carbon;
use Mail;


class ArchiveExpiredVouchers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:archivevoucher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $vouchers = Voucher::where('expiry_date', '<', Carbon::now()->addDays(7))
        ->where('expiry_date', '>', Carbon::now()->addDays(6))->get();


        foreach($vouchers as $voucher) {
            Mail::send('email-expiry',[ 
                'id' => $voucher->id,
                'name' => $voucher->name,
                'expiry' => $voucher->expiry_date
            ], function ($mail) {
                $mail->from("automated@goldcoastdiscounts.com", "GCD-Robot");
                $mail->to('goldcoastdiscounts1@gmail.com')->subject("Voucher Due to Expiry");
            });
        }

    
        $vouchers2 = Voucher::where('expiry_date', '<', Carbon::now())->get();
        foreach($vouchers2 as $voucher) {
            $voucher->delete(); //soft delete (archive)
            Mail::send('email-archived',[ 
                'id' => $voucher->id,
                'name' => $voucher->name,
                'expiry' => $voucher->expiry_date
            ], function ($mail) {
                $mail->from("automated@goldcoastdiscounts.com", "GCD-Robot");
                $mail->to('goldcoastdiscounts1@gmail.com')->subject("Archived Voucher");
            });
        }
        
    }
}
