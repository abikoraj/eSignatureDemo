<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('student')->group(function () {
    Route::get('list', [StudentController::class, 'index']);
    Route::get('show/{id}', [StudentController::class, 'show']);
    Route::post('store', [StudentController::class, 'store']);
    Route::post('update/{id}', [StudentController::class, 'update']);
    Route::delete('delete', [StudentController::class, 'delete']);
});
