<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\TopicResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class DiscussionShowController extends Controller {

    protected static $perPage = 5;
    public function __invoke(Request $request, Discussion $discussion) {
        if ($postId = $request->post ?? null) {
            return redirect()
                ->route('discussions.show', [
                    'discussion' => $discussion,
                    'page' => $this->getPageForPost($discussion, $postId),
                    'postId' => $request->post
                ]);
        }
        $discussion->load(['topic', 'solution'])->loadCount('replies');
        return inertia('Forum/Show', [
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                    ->with(['user', 'discussion'])
                    // ->where( 'id', 88888888888888 )
                    ->oldest()
                    ->paginate(self::$perPage)
            ),
            'postId' => (int) $request->postId ?? null,
        ]);
    }
    protected function getPageForPost(Discussion $discussion,  $postId) {
        $posts = $discussion->posts;
        $postIndex = $posts->search(fn(Post $post) => $postId == $post->id);
        $postIndex++;
        $page = (int)ceil($postIndex / self::$perPage);
        // dd($posts, $postIndex, $page);
        return $page;
    }
}
