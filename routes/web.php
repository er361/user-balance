<?php

use App\Http\Controllers\Api\UserAccountApiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [SiteController::class, 'index'])->name('main');
Route::get('sign-in', [SiteController::class, 'signIn'])->name('sign-in');
Route::get('logout', [LoginController::class, 'logout']);
Route::get('balance-history', [SiteController::class, 'balanceHistory'])->name('balance-history');

Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');


Route::group(['middleware' => ['json', 'auth']], function () {
    Route::get('lastFiveOperations', [UserAccountApiController::class, 'getUserAccountLastFiveOperations']);
    Route::get('getUserAccountOperations', [UserAccountApiController::class, 'getUserAccountOperations']);
});

