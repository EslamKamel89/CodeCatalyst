<?php
namespace App\Http\QueryFilters;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ParticipatingQueryFilter implements Filter {
	public function __invoke( Builder $query, $value, string $property ) {
		if ( ! auth()->user() ) {
			return;
		}
		$query->whereHas( 'posts', function (Builder $query) {
			$query->whereBelongsTo( auth()->user() )->whereNotNull( 'parent_id' );
		} );
	}
}
