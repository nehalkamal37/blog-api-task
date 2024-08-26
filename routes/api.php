<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\postController;
use App\Http\Controllers\Api\commentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//for posts

Route::get('posts/all',[postController::class,'all']);
Route::get('post/one/{id}',[postController::class,'one']);
Route::post('post/create',[postController::class,'create']);
Route::post('post/update/{id}',[postController::class,'update']);
Route::post('delete/{id}',[postController::class,'destroy']);

//for comments
Route::get('comments',[commentController::class,'all']);
Route::get('comment/{id}',[commentController::class,'one']);
Route::post('create/comment',[commentController::class,'create']);
Route::post('comment/up/{id}',[commentController::class,'update']);
Route::post('comment/delete/{id}',[commentController::class,'destroy']);

//sanctum
Route::post('register', [authController::class, 'register']);
Route::post('login', [authController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [authController::class, 'logout']);

