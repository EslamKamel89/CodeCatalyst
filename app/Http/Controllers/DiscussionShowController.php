<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussionShowController extends Controller {
	public function __invoke() {
		return inertia( 'Forum/show' );
	}
}
