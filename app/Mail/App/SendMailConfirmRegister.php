<?php

namespace App\Mail\App;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailConfirmRegister extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    protected $tokenExpireTime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $tokenExpireTime)
    {
        $this->url = $url;
        $this->tokenExpireTime = $tokenExpireTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('passwords.mail_create_general_user'))
            ->view('portal.mail-templates.send-account-confirm')
            ->with([
                'url' => $this->url,
                'tokenExpireTime' => $this->tokenExpireTime
            ]);
    }
}
