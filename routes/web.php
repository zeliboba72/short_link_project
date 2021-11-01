<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;

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

Route::get('/', [ShortLinkController::class, 'index'])->name('home');

Route::post('create_link', [ShortLinkController::class, 'create'])->name('createLink');

Route::get('/{token}', [ShortLinkController::class, 'redirectTrueLink'])->where('token', '([a-zA-Z0-9]){6}');
