<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionSolutionPatchRequest;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DiscussionSolutionPatchController extends Controller {

    public function __invoke(DiscussionSolutionPatchRequest $request, Discussion $discussion) {
        //TODO: make sure to validate the post belongs to a discussion
        $discussion->solution()->associate(Post::find($request->post_id));
        $discussion->save();
        return redirect()->back();
    }
}
