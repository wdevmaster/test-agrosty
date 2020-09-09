<?php

namespace App\Listeners;

use App\Events\MailCreated;
use App\AnalyzeMail as Analyze;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AnalyzeMail implements ShouldQueue
{

    private $rex = '<i class="text-muted">%w%</i>';
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
        Analyze::create([
            'mail_id' => $event->mail->id,
            'format_body' => $this->formatBody($event->mail->body)
        ]);
    }

    
    public function formatBody($body)
    {
        \Log::debug($body);
        return $body;
    }
}
