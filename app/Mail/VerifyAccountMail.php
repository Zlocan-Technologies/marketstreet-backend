<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class VerifyAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $code;
    
    public function __construct(User $user, int $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    public function build()
    {
        return $this->from(getenv('MAIL_FROM_ADDRESS'), "Workpro")
        ->subject("Verify your Workpro account.")
        ->view('email.verify');
    }
}
