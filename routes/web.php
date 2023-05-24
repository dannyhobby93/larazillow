<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/hello', [IndexController::class, 'show']);




Route::resource('listing', ListingController::class)
->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');

Route::resource('listing', ListingController::class)
->except(['create', 'store', 'edit', 'update', 'destroy']);

// Route::resource('listing', ListingController::class)->only(
// 	['index', 'show', 'create', 'store']
// )->except(['destroy', 'edit']);



Route::get('login', [AuthController::class, 'create'])
->name('login');

Route::post('login', [AuthController::class, 'store'])
->name('login.store');

Route::delete('logout', [AuthController::class, 'destroy'])
->name('logout');

Route::resource('user-account', UserAccountController::class)
->only(['create', 'store']);