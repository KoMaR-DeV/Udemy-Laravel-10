<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return '<h1>List of all posts</h1><h2>Named route that we will use in the view: ' . route('posts.index') . '</h2>';
})->name('posts.index');


Route::get('/posts/user/{id}', function ($id) {
    return '<h1>List of posts from specific user.</h1><h2>User id: ' . $id . '</h2><h3>Named route that we will ise in the view: ' . route('post.user', ['id' => $id]) . '</h3>';
})->name('post.user');

Route::get('/toggleFollow/{user}', function ($id) {
    return '<h1>Toggle like/dislike</h1> <h2>User id: ' . $id . '</h2> <h3>Named route we eill use in the view: ' . route('toggleFollow', ['user' => $id]) . '</h3>';
})->name('toggleFollow');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
