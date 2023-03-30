<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::resource('users',UserController::class,['except' => ['create']]);

Route::get('users',[UserController::class,'index']);
Route::get('users/{id}',[UserController::class,'show']);
Route::post('users',[UserController::class,'store']);
Route::post('users/{id}',[UserController::class,'update']);
Route::delete('users/{id}',[UserController::class,'destroy']);