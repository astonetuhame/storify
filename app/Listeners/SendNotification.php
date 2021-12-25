<?php

namespace App\Listeners;

use App\Events\StoryCreated;
use App\Mail\NewStoryNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification
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
        Mail::send(new NewStoryNotification($event->title));
    }
}
