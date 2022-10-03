<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    
    public function __construct(User $user, int $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->from(getenv('MAIL_FROM_ADDRESS'), "MarketStreet")
        ->subject("Password reset request")
        ->view('email.password_recovery');
    }
}
