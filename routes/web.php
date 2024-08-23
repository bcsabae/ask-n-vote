<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QuestionController;
use \App\Http\Middleware\QAndASessionAccessMiddleware;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/start', [SessionController::class, 'showLoginForm'])->name('q-and-a.login.form');
Route::post('/start', [SessionController::class, 'login'])->name('q-and-a.login');

Route::middleware(QAndASessionAccessMiddleware::class)->group(function () {
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/questions/{question}/upvote', [QuestionController::class, 'upvote'])->name('questions.upvote');
});
