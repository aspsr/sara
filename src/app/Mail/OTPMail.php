<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otpEmail)
    {
        $this->otpEmail = $otpEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails/inviaOTPEmail')
                    ->subject('Codice OTP')
                    ->with(['otpEmail' => $this->otpEmail]);
    }
}