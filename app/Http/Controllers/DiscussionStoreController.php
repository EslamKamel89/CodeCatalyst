<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class DiscussionStoreController extends Controller {
	public function __invoke( Request $request ) {
		$request->validate( [ 
			'topic_id' => [ 'required', 'exists:topics,id' ],
			'title' => [ 'required', 'min:3', 'max:150' ],
			'body' => [ 'required', 'min:3', 'max:250' ],
		] );
		$discussion = Discussion::create( [ 
			'user_id' => auth()->id(),
			'topic_id' => $request->topic_id,
			'title' => $request->title,
		] );
		$post = Post::create( [ 
			'user_id' => auth()->id(),
			'discussion_id' => $discussion->id,
			'body' => $request->body,
		] );
		return redirect()->route( 'discussions.show', [ 'discussion' => $discussion->slug ] );
	}
}
