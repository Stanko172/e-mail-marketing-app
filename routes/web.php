<?php

use App\Http\Web\Controllers\Mail\Broadcast\BroadcastController;
use App\Http\Web\Controllers\Mail\Broadcast\PreviewBroadcastController;
use App\Http\Web\Controllers\Mail\Broadcast\SendBroadcastController;
use App\Http\Web\Controllers\Mail\Sequence\PublishSequenceController;
use App\Http\Web\Controllers\Mail\Sequence\SequenceController;
use App\Http\Web\Controllers\Mail\Sequence\SequenceMailController;
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
Route::patch('broadcasts/{broadcast}/send', SendBroadcastController::class)->name('broadcasts.send');
Route::get('broadcasts/{broadcast}/preview', PreviewBroadcastController::class)->name('broadcasts.preview');

Route::resource('sequences', SequenceController::class);
Route::patch('sequences/{sequence}/publish', PublishSequenceController::class)->name('sequences.publish');

Route::resource('sequences/{sequence}/mails', SequenceMailController::class);

require __DIR__.'/auth.php';
