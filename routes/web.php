<?php

use App\Http\Controllers\DiscussionDeleteController;
use App\Http\Controllers\DiscussionShowController;
use App\Http\Controllers\DiscussionSolutionPatchController;
use App\Http\Controllers\DiscussionStoreController;
use App\Http\Controllers\ForumIndexController;
use App\Http\Controllers\MarkDownPreviewController;
use App\Http\Controllers\PostDeleteController;
use App\Http\Controllers\PostPatchController;
use App\Http\Controllers\PostStoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsernamesIndex;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', ForumIndexController::class)->name('home');
Route::get('/discussion/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');
Route::post('/markdown', MarkDownPreviewController::class)->name('markdown');
Route::get('/usernames', UsernamesIndex::class)->name('usernames.index');

Route::middleware('auth')->group(function () {
    Route::post('/discussion', DiscussionStoreController::class)->name('discussions.store');
    Route::delete('/discussion/{discussion}', DiscussionDeleteController::class)->name('discussions.delete');
    Route::patch('/discussion/{discussion}/solution', DiscussionSolutionPatchController::class)->name('discussions.solution.patch');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/discussion/{discussion:slug}/posts', PostStoreController::class)->name('posts.store');
    Route::patch('/posts/{post}', PostPatchController::class)->name('posts.edit');
    Route::delete('/posts/{post}', PostDeleteController::class)->name('posts.delete');
});
// Route::get('/test', function (Request $request) {
//     $text = '@eslam @ahmed @kamel hello world eslam@gmail.com';
//     preg_match_all('/@(?!\S+@\S+\.\S+)[a-zA-Z0-9._]+/', $text, $matches);
//     $matches =  collect($matches[0])->map(fn(string $match) => str($match)->remove('@'));
//     $users = User::whereIn('username', $matches,)->get();
//     dd($matches, $users);
// });

require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get( '/dashboard', function () {
// 	return Inertia::render( 'Dashboard' );
// } )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard' );
