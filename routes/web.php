<?php

use App\Http\Controllers\DiscussionShowController;
use App\Http\Controllers\DiscussionStoreController;
use App\Http\Controllers\ForumIndexController;
use App\Http\Controllers\MarkDownPreviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get( '/', ForumIndexController::class)->name( 'home' );
Route::get( '/discussion/{discussion:slug}', DiscussionShowController::class)->name( 'discussions.show' );
Route::post( '/markdown', MarkDownPreviewController::class)->name( 'markdown' );

Route::middleware( 'auth' )->group( function () {
	Route::post( '/discussion', DiscussionStoreController::class)->name( 'discussions.store' );
	Route::get( '/profile', [ ProfileController::class, 'edit' ] )->name( 'profile.edit' );
	Route::patch( '/profile', [ ProfileController::class, 'update' ] )->name( 'profile.update' );
	Route::delete( '/profile', [ ProfileController::class, 'destroy' ] )->name( 'profile.destroy' );
} );

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

