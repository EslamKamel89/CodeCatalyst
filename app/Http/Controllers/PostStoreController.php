<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class PostStoreController extends Controller {
    public function __invoke(StorePostRequest $request,  Discussion  $discussion) {
        $post  = Post::create([
            'user_id' => auth()->id(),
            'discussion_id' => $discussion->id,
            'parent_id' => $discussion->post->id,
            'body' => $request->body,
        ]);
        return   redirect()->route('discussions.show', ['discussion' => $discussion]);
    }
}
