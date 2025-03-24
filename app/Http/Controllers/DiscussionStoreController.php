<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscussionRequest;
use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DiscussionStoreController extends Controller {
    public function __invoke(StoreDiscussionRequest $request) {
        $discussion = Discussion::create([
            'user_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'title' => $request->title,
        ]);
        $post = Post::create([
            'user_id' => auth()->id(),
            'discussion_id' => $discussion->id,
            'body' => $request->body,
        ]);
        return redirect(
            route('discussions.show', ['discussion' => $discussion->slug]) . '?post=' . $post->id
        );
    }
}
