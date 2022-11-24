<?php

namespace App\Console\Commands;

use App\Models\UserAddress;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderPlacedInADay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $orders=UserAddress::whereDate('created_at', Carbon::today())->count();;

        $admin="sakpalpurva1@gmail.com";
        $data = ['count' => $orders];
            $user['to'] = $admin;

            Mail::send('Mail.DailyOrderUpdate',$data,function($message) use ($user){
            $message->to($user['to']);
            $message->subject('Daily Order Updates !');
            });
        return 0;
    }
}
