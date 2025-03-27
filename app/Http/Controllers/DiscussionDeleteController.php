<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DiscussionDeleteController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Discussion $discussion) {
        Gate::authorize('delete', $discussion);
        $discussion->delete();
        return redirect()->back();
    }
}
