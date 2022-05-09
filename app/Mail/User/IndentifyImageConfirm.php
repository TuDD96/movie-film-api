<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IndentifyImageConfirm extends Mailable
{
    use Queueable, SerializesModels;

    protected $nickname;
    protected $userId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nickname, $userId)
    {
        $this->nickname = $nickname;
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('email.identify_image_confirm'))
            ->view('user.emails.identify_image_confirm')
            ->with([
                'nickname' => $this->nickname,
                'userId' => $this->userId
            ]);
    }
}
