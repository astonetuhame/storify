<?php

namespace App\Listeners;

use App\Events\StoryCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WriteLog
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
     * @param  \App\Events\StoryCreated  $event
     * @return void
     */
    public function handle(StoryCreated $event)
    {
        Log::info('A story with title ' . $event->title . ' was added');
    }
}
