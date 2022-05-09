<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAuthenticatedMail extends Mailable
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
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->view('portal.mail-templates.email_authenticated')
            ->with([
                'title' => $this->title,
                'body' => $this->body
            ]);
    }
}
