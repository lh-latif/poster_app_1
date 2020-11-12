<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\PostCounter as PostCount;

class PostCounter
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (isset($event->eventName)) {
            switch ($event->eventName) {
              case "post_added":
                return PostCount::a_post_added();
              case "post_deleted":
                return PostCount::a_post_deleted();
            }
        }
    }
}
