<?php

namespace App\Listeners;

use App\Mail\SendMail as Send;
use App\Events\MailCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MailCreated  $event
     * @return void
     */
    public function handle(MailCreated $event)
    {
        Mail::to($event->mail->to)
            ->queue(new Send($event->mail));
    }
}
