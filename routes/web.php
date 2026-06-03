<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourismController;

Route::get('/', [TourismController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/tourist-login', [AuthController::class, 'touristLogin'])->name('tourist.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [TourismController::class, 'dashboard'])->name('dashboard');

    Route::get('/api/destinations', [TourismController::class, 'destinations']);
    Route::get('/api/questions', [TourismController::class, 'questions']);
    Route::get('/api/responses', [TourismController::class, 'responses']);
    Route::get('/api/logs', [TourismController::class, 'logs']);
    Route::get('/api/users', [TourismController::class, 'users']);
    Route::get('/api/ai-report', [TourismController::class, 'aiReport']);

    Route::post('/api/responses', [TourismController::class, 'storeResponse']);

    Route::post('/api/destinations', [TourismController::class, 'storeDestination']);
    Route::put('/api/destinations/{destination}', [TourismController::class, 'updateDestination']);
    Route::delete('/api/destinations/{destination}', [TourismController::class, 'deleteDestination']);

    Route::post('/api/questions', [TourismController::class, 'storeQuestion']);
    Route::put('/api/questions/{question}', [TourismController::class, 'updateQuestion']);
    Route::delete('/api/questions/{question}', [TourismController::class, 'deleteQuestion']);

    Route::post('/api/users', [TourismController::class, 'storeUser']);
    Route::delete('/api/users/{user}', [TourismController::class, 'deleteUser']);

    Route::post('/api/generate-ai-report', [TourismController::class, 'generateAiReport']);
    Route::post('/api/reset-db', [TourismController::class, 'resetDatabase']);
});