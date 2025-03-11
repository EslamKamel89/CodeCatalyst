<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionShowController extends Controller {
	public function __invoke( Discussion $discussion ) {
		return inertia( 'Forum/Show', [ 'discussion' => $discussion ] );
	}
}
