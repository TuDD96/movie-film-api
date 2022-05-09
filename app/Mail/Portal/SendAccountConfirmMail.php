<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccountConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('passwords.mail_create_host'))
            ->view('portal.mail-templates.send-account-confirm')
            ->with([
                'url' => $this->url,
            ]);
    }
}
