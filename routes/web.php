<?php

use App\Http\Web\Controllers\Mail\Broadcast\BroadcastController;
use App\Http\Web\Controllers\Subscriber\SubscriberController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Home');
})->name('home');

Route::resource('subscribers', SubscriberController::class);

Route::resource('broadcasts', BroadcastController::class);

require __DIR__.'/auth.php';
