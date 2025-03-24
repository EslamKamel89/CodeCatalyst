<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\TopicResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class DiscussionShowController extends Controller {
    public function __invoke(Request $request, Discussion $discussion) {
        if ($postId = $request->post && !$request->has('page')) {
            return redirect()
                ->route('discussions.show', [
                    'discussion' => $discussion,
                    ...$request->query(),
                    'page' => 1
                ]);
        }
        $discussion->load(['topic'])->loadCount('replies');
        return inertia('Forum/Show', [
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                    ->with(['user', 'discussion'])
                    // ->where( 'id', 88888888888888 )
                    ->oldest()
                    ->paginate(3)
            )
        ]);
    }
}
