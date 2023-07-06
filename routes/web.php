<?php

use App\Http\Controllers\Admin\DestinasiController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\TugasController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Auth::check() ? : view('auth.login');
});

Auth::routes();

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'HomeAdmin'])->name('admin.dashboard');;
    Route::resource('/divisi', DivisiController::class);
    Route::resource('/destinasi', DestinasiController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('/tugas', TugasController::class);
});

Route::middleware(['karyawan'])->prefix('karyawan')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'HomeKaryawan'])->name('karyawan.dashboard');
});


