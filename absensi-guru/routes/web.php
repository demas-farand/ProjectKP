<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absensi\TeacherController;
use App\Http\Controllers\absensi\AttendanceController;
use App\Http\Middleware\VerifyAPIToken;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User;
//use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('beranda');
});

Route::get('/login', function () {
    return view('login.login');
});

Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');

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


Route::get('/pengaturan', [RoleController::class, 'index'])->name('pengaturan');
Route::get('/pengaturan', [RoleController::class, 'index'])->name('pengaturan');

//Crud Guru
Route::get('/guru', [TeacherController::class, 'index'])->name('absensi.guru.index');
Route::get('/guru/create', [TeacherController::class, 'create'])->name('absensi.guru.create');
Route::post('/guru', [TeacherController::class, 'store'])->name('absensi.guru.store');
Route::get('/guru/{id}', [TeacherController::class, 'show'])->name('absensi.guru.show');
Route::get('/guru/{id}/edit', [TeacherController::class, 'edit'])->name('absensi.guru.edit');
Route::put('/guru/{id}', [TeacherController::class, 'update'])->name('absensi.guru.update');
Route::delete('/guru/{id}', [TeacherController::class, 'destroy'])->name('absensi.guru.destroy');

//Test API
Route::post('/guru/{id}/absen', [TeacherController::class, 'absen'])->name('absensi.guru.absen');
Route::get('/absensi', [AttendanceController::class, 'index'])->name('absensi.index');


// Rute untuk menampilkan form pembuatan user baru
Route::get('/role/create', [RoleController::class, 'createUser'])->name('role.createUser');

// Rute untuk menyimpan user baru
Route::post('/role/store', [RoleController::class, 'storeUser'])->name('role.storeUser');

// Rute untuk menampilkan form pembuatan role baru
Route::get('/role/createRole', [RoleController::class, 'createRole'])->name('role.createRole');

// Rute untuk menyimpan role baru
Route::post('/role/storeRole', [RoleController::class, 'storeRole'])->name('role.storeRole');

// Rute untuk menampilkan form edit role
Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');

// Rute untuk memperbarui role
Route::put('/role/{role}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
