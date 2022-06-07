<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserUrlController;
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
    return view('welcome');
});


Route::get('url' , [UserUrlController::class , 'index'])->name("url.index");
Route::post('url' , [UserUrlController::class , 'store'])->name("url.create");
Route::get('{string}' , [UserUrlController::class , 'redirect'])->name('url.redirect');