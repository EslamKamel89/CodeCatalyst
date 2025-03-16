<?php
namespace App\Http\QueryFilters;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class NoReplyQueryFilter implements Filter {
	public function __invoke( Builder $query, $value, string $property ) {
		$query->has( 'posts', '=', 1 );
	}
}
