<?php

namespace App\Observers;

use App\Helpers\pr;
use App\Models\Post;
use App\Models\User;

class PostObserver {
    public function created(Post $post): void {
        preg_match_all('/@(?!\S+@\S+\.\S+)[a-zA-Z0-9._]+/', $post->body, $matches);
        $matches =  collect($matches[0])
            ->map(
                fn(string $match) => str($match)->remove('@')
            );
        $users = User::whereIn('username', $matches,)->get();
        $post->usersMentioned()->sync($users->pluck('id'));
    }

    public function updated(Post $post): void {
        $this->created($post);
    }

    public function deleted(Post $post): void {
    }

    public function restored(Post $post): void {
    }

    public function forceDeleted(Post $post): void {
    }
}
