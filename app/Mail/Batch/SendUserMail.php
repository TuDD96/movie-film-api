<?php

namespace App\Mail\Batch;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Exception;

class SendUserMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return SendUserMail
     */
    public function build()
    {
         return $this->subject($this->title)
             ->html($this->body);
    }
}
