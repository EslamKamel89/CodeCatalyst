<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostDeleteController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Post $post) {
        Gate::authorize('delete', $post);
        $post->delete();
        return redirect()->back();
    }
}
