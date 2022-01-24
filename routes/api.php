<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::get('/product-list',[ProductController::class,'list']);
Route::POST('/register',[UserController::class,'register']);
Route::POST('/login',[UserController::class,'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
