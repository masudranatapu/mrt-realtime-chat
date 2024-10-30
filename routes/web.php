<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('chat/{id}', [HomeController::class, 'chat'])->name('chat');
    Route::get('chat/{id}/messages', [HomeController::class, 'fetchMessages']);
    Route::post('chat-sent', [HomeController::class, 'chatSent'])->name('chat.sent');

});
