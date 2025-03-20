<?php

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DiscussionPolicy {
	public function viewAny( ?User $user ): bool {
		return true;
	}

	public function view( ?User $user, Discussion $discussion ): bool {
		return true;
	}

	public function create( User $user ): bool {
		return auth()->check();
	}

	public function update( User $user, Discussion $discussion ): bool {
		return $discussion->user_id == $user->id;
	}

	public function delete( User $user, Discussion $discussion ): bool {
		return $discussion->user_id == $user->id;
	}

	public function restore( User $user, Discussion $discussion ): bool {
		return $discussion->user_id == $user->id;
	}

	public function forceDelete( User $user, Discussion $discussion ): bool {
		return $discussion->user_id == $user->id;
	}
}
