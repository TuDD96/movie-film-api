<?php

namespace App\Mail\App;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailReport extends Mailable
{
    use Queueable, SerializesModels;
    protected $book;
    protected $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($book, $comment)
    {
        $this->book = $book;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Comicerianの通報')
            ->view('portal.mail-templates.email_report')
            ->with([
                'book' => $this->book,
                'comment' => $this->comment
            ]);
    }
}
