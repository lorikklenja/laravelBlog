<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/all', [PostController::class, 'index'])->name('allPosts');
Route::get('/', [PostController::class, 'latestPosts'])->name('threePosts');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/createPost', [PostController::class, 'create'])->name('createPost');
    Route::post('/storePost', [PostController::class, 'store'])->name('storePost');
});

require __DIR__.'/auth.php';
