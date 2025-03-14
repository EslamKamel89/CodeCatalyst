<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;

class ForumIndexController extends Controller {
	public function __invoke() {
		return inertia( 'Forum/Index', [ 
			'discussions' => DiscussionResource::collection(
				Discussion::with( [ 'topic', 'post', 'latestPost.user', 'particpants' ] )
					->orderByPinned()
					// todo: will be removed by ordering by latest posts later
					->latest()
					->paginate( 10 ),
			),
		] );
	}
}
