<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\PostCommentCouch as PComment;

class PostComment
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
        switch ($event->eventName) {
            case "post_added":
                return PComment::add_post_comment($event->post->id, $event->post->user_id);
            case "post_deleted":
                // return PComment::delete_post_comment($event->post->id);
                return;
        }
    }
}
