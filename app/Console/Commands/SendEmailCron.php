<?php

namespace App\Console\Commands;

use App\Models\Personal;
use Illuminate\Console\Command;
use Mail;

class SendEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendemail:cron';

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
     * @return int
     */
    public function handle()
    {

       

        

        $candidates = Personal::whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->get();  

        foreach ($candidates as $candidate) {

             $quotes = [
             'Dear '.$candidate->name.',

We value your special day just as much as we value you. On your birthday, we send you our warmest and most heartfelt wishes.
We are thrilled to be able to share this great day with you, and glad to have you as a valuable member of the team. We appreciate everything you’ve done to help us flourish and grow.
Our entire corporate family at Goresource wishes you a very happy birthday and wishes you the best on your special day!
Regards,
Goresource',



              ];

              $key = array_rand($quotes);
              $data = $quotes[$key];

            Mail::raw("{$data}", function ($mail) use ($candidate) {
                $mail->from('delivery@gmail.com');
                $mail->to($candidate->email)
                    ->subject(' HAPPY BIRTHDAY '.strtoupper($candidate->name).' !!!');
            });
         }
         
        $this->info('Successfully sent daily quote to everyone.');
    }
}
