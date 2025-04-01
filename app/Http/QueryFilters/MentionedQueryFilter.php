<?php

namespace App\Http\QueryFilters;

use App\Models\Discussion;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class MentionedQueryFilter implements Filter {
    public function __invoke(Builder $query, $value, string $property) {
        /** @var Discussion $discussion */
        // $discussion = Discussion::find(1);
        // $discussion->posts()->whereHas('usersMentioned',);
        $query->whereHas('posts', function (Builder $query) {
            $query->whereHas('usersMentioned', function (Builder $query) {
                $query->where('user_id', auth()->id());
            });
        });
    }
}
