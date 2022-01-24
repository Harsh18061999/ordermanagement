<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//brand list
Route::get('/',[BrandController::class,'all'])->name('brand.list');
Route::POST('/add-to-cart',[OrderController::class,'addToCart'])->name('addToCart');
Route::POST('/place-order',[OrderController::class,'placeOrder'])->name('placeOrder');