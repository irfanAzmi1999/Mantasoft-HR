<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveRejectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rejected;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rejected)
    {
        $this->rejected = $rejected;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('About Your Leave Application')->view('mails.leavereject');
    }
}
