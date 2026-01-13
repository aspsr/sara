<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class assistenzaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataView;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $dataView)
    {
        $this->dataView = $dataView;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails/inviaAssistenzaEmail')
                    ->subject('Assistenza codice fiscale')
                    ->with(['dataView' => $this->dataView]);
    }
}