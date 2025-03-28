<?php

namespace App\Http\Controllers;

use App\Http\QueryFilters\MineQueryFilter;
use App\Http\QueryFilters\NoReplyQueryFilter;
use App\Http\QueryFilters\ParticipatingQueryFilter;
use App\Http\QueryFilters\SolvedQueryFilter;
use App\Http\QueryFilters\UnsolvedQueryFilter;
use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ForumIndexController extends Controller {
    public function __invoke(Request $request) {
        // dd( $request->query() );
        return inertia('Forum/Index', [
            'query' => (object) $request->query(),
            'discussions' => DiscussionResource::collection(
                QueryBuilder::for(Discussion::class)
                    ->allowedFilters($this->allowedFilters())
                    ->with(['topic', 'post', 'latestPost.user', 'particpants',])
                    ->withCount('replies')
                    // ->orderByPinned()
                    ->orderByLastPost()
                    // ->latest()
                    // ->orderBy( 'id', 'desc' )
                    ->paginate(10)->withQueryString(),
            ),
        ]);
    }
    protected function allowedFilters(): array {
        return [
            AllowedFilter::custom('noreplies', new NoReplyQueryFilter()),
            AllowedFilter::custom('mine', new MineQueryFilter()),
            AllowedFilter::custom('participating', new ParticipatingQueryFilter()),
            'topic_id',
            'title',
            AllowedFilter::custom('solved', new SolvedQueryFilter()),
            AllowedFilter::custom('notsolved', new UnsolvedQueryFilter())
        ];
    }
}
