<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Absensi\GuruController;
use App\Http\Controllers\Absensi\AttendanceController;
use App\Http\Middleware\VerifyApiToken;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiApiController;
use App\Http\Controllers\SesiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([VerifyApiToken::class])->group(function () {
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('attendance', AttendanceController::class);
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);

    Route::get('/guru/generate-qrcode/{id}', [GuruController::class, 'generateQRCode']);
});

//Route::post('/login', [AuthController::class, 'login']);

Route::get('/absensi', [AbsensiApiController::class, 'store']);
//Route::post('/absensi', [AbsensiApiController::class, 'store']);

Route::post('/api/login', [SesiController::class, 'apiLogin']);
