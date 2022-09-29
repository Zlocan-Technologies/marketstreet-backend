<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\verifyAccountMail;
use Illuminate\Support\Facades\{
    Mail, DB
};

class WelcomeNewCustomerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    /*public function __construct()
    {
        //
    }*/

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $code = mt_rand(1000, 9999);
        $expiry_time = Carbon::now()->addMinutes(6);
        DB::table('user_verification')->insert(['email' => $user->email, 'code' => $code, 'expiry_time' => $expiry_time]);
        Mail::to('sivatech234@gmail.com')->send(new verifyAccountMail($event->user, $code));
    }
}
