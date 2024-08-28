<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SessionCodeController;
use App\Http\Controllers\QuestionController;
use \App\Http\Middleware\QAndASessionAccessMiddleware;

Route::get('/', function () {
    return Inertia::render('Landing', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/sessions', [SessionCodeController::class, 'index'])->name('sessions');
    Route::patch('/sessions/{session_code}', [SessionCodeController::class, 'update'])->name('sessions.update');
    Route::post('/sessions', [SessionCodeController::class, 'store'])->name('sessions.new');
    Route::delete('/sessions/{session_code}', [SessionCodeController::class, 'destroy'])->name('sessions.destroy');
    Route::get('/sessions/{session_code}', [SessionCodeController::class, 'view'])->name('sessions.dashboard');

    Route::patch('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::patch('/guest/{guest}', [GuestController::class, 'ban'])->name('guest.ban');
});

Route::get('/start', [GuestController::class, 'create'])->name('q-and-a.login.form');
Route::post('/start', [GuestController::class, 'store'])->name('q-and-a.login');

Route::middleware(QAndASessionAccessMiddleware::class)->group(function () {
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::delete('/questions/{question}', [QuestionController::class, 'delete'])->name('questions.destroy');
    Route::post('/questions/{question}/upvote', [QuestionController::class, 'upvote'])->name('questions.upvote');
    Route::put('/questions/{question}/upvote', [QuestionController::class, 'downvote'])->name('questions.downvote');
});
