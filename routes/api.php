<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourismController;

Route::get('/destinations', [TourismController::class, 'destinations']);
Route::post('/destinations', [TourismController::class, 'storeDestination']);
Route::put('/destinations/{destination}', [TourismController::class, 'updateDestination']);
Route::delete('/destinations/{destination}', [TourismController::class, 'deleteDestination']);

Route::get('/questions', [TourismController::class, 'questions']);
Route::post('/questions', [TourismController::class, 'storeQuestion']);
Route::put('/questions/{question}', [TourismController::class, 'updateQuestion']);
Route::delete('/questions/{question}', [TourismController::class, 'deleteQuestion']);

Route::get('/responses', [TourismController::class, 'responses']);
Route::post('/responses', [TourismController::class, 'storeResponse']);

Route::get('/logs', [TourismController::class, 'logs']);

Route::get('/users', [TourismController::class, 'users']);
Route::post('/users', [TourismController::class, 'storeUser']);
Route::delete('/users/{user}', [TourismController::class, 'deleteUser']);

Route::get('/ai-report', [TourismController::class, 'aiReport']);
Route::post('/generate-ai-report', [TourismController::class, 'generateAiReport']);

Route::post('/reset-db', [TourismController::class, 'resetDatabase']);

Route::get('/mysql-status', function () {
    return response()->json([
        'configured' => true,
        'status' => 'Connected',
        'hostInfo' => config('database.connections.mysql.host'),
        'ssl' => false,
        'error' => null,
    ]);
});