<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Segment\Api\Auth\ApiAuthController;

Route::prefix('/user')->group(function () {
    Route::post('/get-token', [ApiAuthController::class, 'getToken']);
    Route::post('/get-user', [ApiAuthController::class, 'getUser']);
    Route::post('/delete-user', [ApiAuthController::class, 'deleteToken']);
    Route::post('/save-attendance', [ApiAuthController::class, 'saveAttendance']);
    Route::post('/history-attendance', [ApiAuthController::class, 'historyAttendance']);
});

Route::middleware('auth:sanctum')->prefix('/attendance', function(){

});


