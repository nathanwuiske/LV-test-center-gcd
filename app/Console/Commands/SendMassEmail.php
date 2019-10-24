<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail;

class SendMassEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:massemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mass email';

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
    


try {

      $user_emails = User::latest()->pluck('email')->slice(301)->take(100);
      //up to slice 401 (already done slice 301)
      //  $user_emails = ["wuiske.nathan@gmail.com", "soapface4@hotmail.com"];
        
        foreach($user_emails as $email) {
            Mail::send('emails.deals',[ 
            ], function ($mail) use ($email) {
                $mail->from("deals@goldcoastdiscounts.com.au", "Gold Coast Discounts");
                $mail->to($email)->subject("We're for Gold Coast Locals and Businesses");
            });
        }

} catch (\Exception $e) {
   // Log error
   // Flag email for retry
  
}


    }
}
