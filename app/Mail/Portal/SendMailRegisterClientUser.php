<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailRegisterClientUser extends Mailable
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
        return $this->subject(trans('passwords.mail_create_user'))
            ->view('portal.mail-templates.register_client_user')
            ->with([
                'url' => $this->url,
            ]);
    }
}
