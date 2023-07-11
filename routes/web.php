<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\DestinasiController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\LokasiKantorController;
use App\Http\Controllers\Admin\TugasController;
use App\Http\Controllers\FormIzinController;
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

Route::get('/ip', function () {
    // $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
    // $checkLocation = geoip()->getLocation('103.169.130.170');
    // return $checkLocation->toArray();


});

Auth::routes();

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'HomeAdmin'])->name('admin.dashboard');;
    Route::resource('/divisi', DivisiController::class);
    Route::resource('/destinasi', DestinasiController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('/tugas', TugasController::class);
    Route::resource('/lokasiKantor', LokasiKantorController::class);
});

Route::middleware(['karyawan'])->prefix('karyawan')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'HomeKaryawan'])->name('karyawan.dashboard');
    Route::get('/activity', [ActivityController::class, 'index'])->name('karyawan.activity.index');
    Route::post('/absensi-masuk', [AbsensiController::class, 'absenMasuk'])->name('karyawan.absensi.masuk');
    Route::post('/absensi-pulang', [AbsensiController::class, 'absenPulang'])->name('karyawan.absensi.pulang');
    Route::get('/absensi', [AbsensiController::class, 'checkAbsen'])->name('karyawan.absensi.checkAbsen');
    Route::get('/lokasi', [HomeController::class, 'lokasiKantor'])->name('karyawan.lokasiKantor');
    Route::put('/kerjakan/{tugas}', [ActivityController::class, 'kerjakan'])->name('karyawan.activity.kerjakan');
    Route::put('/selesaikan/{tugas}', [ActivityController::class, 'selesaikan'])->name('karyawan.activity.selesaikan');
    Route::resource('/formIzin', FormIzinController::class);
});


