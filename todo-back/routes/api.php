<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'todos',
    'controller' => TodoController::class
], function() {
    Route::put('/{id}/completed', 'completed');
    Route::put('/{id}/description', 'saveDescription');
    Route::put('/{id}/due_date', 'saveDate');
});

Route::apiResource('todos', TodoController::class);
