<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function createing(Post $post)
    {
        if (! \App::runningInConsole()) {
            $post->user_id=auth()->user()->id;
        }
    }
    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleting(Post $postss)
    {
        if ($postss->image) {
            Storage::delete('public/' . $postss->image->url);
        }
    }
}
