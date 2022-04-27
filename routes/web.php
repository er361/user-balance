<?php

use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('main')->with('title', 'Главная');
})->name('main');

Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('sign-in', function () {
    return view('sign-in')->with('title', 'Login');
})->name('sign-in');

Route::get('balance-history', function () {
    return view('main')->with('title', 'История операции');
})->name('balance-history');

// Route::get('test',fn()=>Artisan::call('ub:decrement-balance',[
//     'email' => 'sf7kmmr@gmail.com',
//     'sum' => 111,
//     'reason' => 'som'
// ]));

