<?php

declare(strict_types=1);

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;

    protected $tokenExpireTime;

    /**
     * Create a new message instance.
     *
     * @param $url
     * @param $tokenExpireTime
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
        return $this->subject(trans('passwords.mail_forgot_subject'))
            ->view('user.emails.forgot_password')
            ->with([
                'url' => $this->url,
                'tokenExpireTime' => $this->tokenExpireTime,
            ]);
    }
}
