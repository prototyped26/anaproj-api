<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $site = 'http://localhost:4200/new-password';
    private $user;
    private $token;
    public function __construct($u, $t)
    {
        //
        $this->user = $u;
        $this->token = $t;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('' . $this->user->email)
            ->view('email/resetpassword')
            ->with([
                'username' => $this->user->name,
                'token' => $this->token,
                'url' => $this->site
            ]);
    }
}
