<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Alert;
use App\Post;

class AlertEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $alert;
    public $post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Alert $alert, Post $post)
    {
        $this->alert = $alert;
        $this->post = $post;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->post->title)
                ->from('alert@rfd.spencerwallace.ca', 'RFD Alert')
                ->markdown('emails.alert');
    }
}
