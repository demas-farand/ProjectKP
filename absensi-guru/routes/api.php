<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Absensi\TeacherController;
use App\Http\Controllers\Absensi\AttendanceController;
use App\Http\Middleware\VerifyApiToken;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([VerifyApiToken::class])->group(function () {
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('attendance', AttendanceController::class);
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);
});


