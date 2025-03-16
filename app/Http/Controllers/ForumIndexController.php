<?php

namespace App\Http\Controllers;

use App\Http\QueryFilters\NoReplyQueryFilter;
use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ForumIndexController extends Controller {
	public function __invoke() {
		return inertia( 'Forum/Index', [ 
			'discussions' => DiscussionResource::collection(
				QueryBuilder::for( Discussion::class)
					->allowedFilters( $this->allowedFilters() )
					->with( [ 'topic', 'post', 'latestPost.user', 'particpants' ] )
					->withCount( 'replies' )
					// ->orderByPinned()
					->orderByLastPost()
					// ->latest()
					// ->orderBy( 'id', 'desc' )
					->paginate( 10 ),
			),
		] );
	}
	protected function allowedFilters(): array {
		return [ 
			AllowedFilter::custom( 'noreplies', new NoReplyQueryFilter() )
		];
	}
}
