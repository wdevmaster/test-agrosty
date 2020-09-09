<?php

namespace App\Listeners;

use App\Events\MailCreated;
use App\AnalyzeMail as Analyze;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AnalyzeMail implements ShouldQueue
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
        \Log::debug('Listeners.AnalyzeMail');
    }
}
