<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absensi\GuruController;
use App\Http\Controllers\absensi\AbsensiController;
use App\Http\Middleware\VerifyAPIToken;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\User;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiApiController;

Route::get('/admin', function () {
})->middleware('role:admin');

Route::get('/', function () {
    return view('beranda');
});

Route::get('/login', function () {
    return view('login.login');
})->name('login');

//Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/login', [SesiController::class, 'login'])->name('login]');

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/absensi', function () {
    return view('absensi.index');
})->name('absensi.index');

Route::get('/guru', function () {
    return view('absensi.guru.index');
})->name('absensi.guru.index');

Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

//Crud Guru
Route::get('/guru', [GuruController::class, 'index'])->name('absensi.guru.index');
Route::get('/guru/create', [GuruController::class, 'create'])->name('absensi.guru.create');
Route::post('/guru', [GuruController::class, 'store'])->name('absensi.guru.store');
Route::get('/guru/{id}', [GuruController::class, 'show'])->name('absensi.guru.show');
Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('absensi.guru.edit');
Route::put('/guru/{id}', [GuruController::class, 'update'])->name('absensi.guru.update');
Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('absensi.guru.destroy');

//Test API
Route::post('/guru/{id}/absen', [GuruController::class, 'absen'])->name('absensi.guru.absen');
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');

Route::get('/generate-qrcode/{id}', [QRCodeController::class, 'generateQRCode']);
Route::post('/mobile-check-in', [AbsensiController::class, 'mobileCheckIn']);

Route::get('/guru/generate-qrcode/{id}', [GuruController::class, 'generateQRCode'])->name('guru.generate-qrcode');

// Routes untuk Absensi
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('/absensi/check-in', [AbsensiController::class, 'checkIn'])->name('absensi.check-in');
Route::post('/absensi/check-out', [AbsensiController::class, 'checkOut'])->name('absensi.check-out');

//Role
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::get('/settings', [UserController::class, 'index'])->name('settings.index');





Route::post('/absensi', [AbsensiApiController::class, 'store']);
