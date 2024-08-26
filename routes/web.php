<?php

use App\Mail\mailgunEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\posts\homeController;
use App\Http\Controllers\posts\mailController;
use App\Http\Controllers\posts\postController;
use App\Http\Controllers\posts\commentController;

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

Route::get('/w', function () {
    return view('welcome');
});

Route::get('/',[homeController::class,'index']);

/*
Route::get('/dashboard', function () {
    return view('front.index');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {

Route::get('dashboard',[postController::class,'index']);
Route::resource('home',homeController::class);
Route::resource('posts',postController::class);
Route::resource('comments',commentController::class);
Route::resource('mail',mailController::class);

Route::get('newcomm',function(){
    Mail::to('hi@example.com')->send(new mailgunEmail('you have a new comment'));
});

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
