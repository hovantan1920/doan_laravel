<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $token, $id)
    {
        $this->username = $username;
        $this->token    = $token;
        $this->id       = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('formmail.confirm-register', 
            ['username'=>$this->username, 'token'=>$this->token, 'id'=>$this->id]);
    }
}
