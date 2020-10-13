<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FastInsertController;
use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/v1')->group(function () {
    Route::get('/pet', [PetController::class, 'index']);
    Route::post('/pet', [PetController::class, 'store']);
    Route::put('/pet/{id}', [PetController::class, 'update']);
    Route::delete('/pet/{id}', [PetController::class, 'destroy']);
    Route::get('/pet/{id}', [PetController::class, 'show']);

    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::post('/attendance', [AttendanceController::class, 'store']);
    Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'show']);

    Route::post('/insert', [FastInsertController::class, 'insert']);
});
