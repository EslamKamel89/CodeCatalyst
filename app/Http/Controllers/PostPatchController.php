<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class PostPatchController extends Controller {

    public function __invoke(Request $request, Post $post) {
        dd($request->all(), $post);
    }
}
