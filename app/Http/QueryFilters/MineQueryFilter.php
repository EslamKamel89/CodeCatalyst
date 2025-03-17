<?php
namespace App\Http\QueryFilters;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class MineQueryFilter implements Filter {
	public function __invoke( Builder $query, $value, string $property ) {
		if ( ! auth()->user() ) {
			return;
		}
		$query->whereBelongsTo( auth()->user() );
	}
}
