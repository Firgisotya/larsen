<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\DestinasiController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\FormIzinAdminController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Pengelola\KaryawanController as PengelolaKaryawanController;
use App\Http\Controllers\Admin\LokasiKantorController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Pengelola\PresensiController as PengelolaPresensiController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Pengelola\ProfilePengelolaController;
use App\Http\Controllers\Admin\RoleManajemenController;
use App\Http\Controllers\Admin\TugasController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\FormIzinController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileKaryawanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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
    if (Auth::check()) {
        $user = Auth::user();
        $roleId = $user->role_id;

        if ($roleId === 1) {
            Alert::success('Selamat Datang', 'Anda sudah login sebagai admin!');
            return redirect()->route('admin.dashboard');
        } elseif ($roleId === 2) {
            Alert::success('Selamat Datang', 'Anda sudah login sebagai karyawan!');
            return redirect()->route('karyawan.dashboard');
        } elseif ($roleId === 3) {
            Alert::success('Selamat Datang', 'Anda sudah login sebagai pengelola!');
            return redirect()->route('pengelola.dashboard');
        }
    }

    return view('auth.login');
});

Route::post('/logout-user', function() {
    Auth::logout();
    Alert::success('Berhasil', 'Anda berhasil logout!');
    return redirect('/');
})->name('logout.user');

Route::group(['middleware' => 'guest'], function () {

    Auth::routes();

    // lupa password
    Route::get('/lupa-password', [ForgotPasswordController::class, 'index'])->name('lupaPassword.index');
    Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('lupaPassword.submit');

    // Reset password
    Route::get('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword.index');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitReset'])->name('resetPassword.submit');
});


// export admin
Route::get('/presensi/export-pdf', [PresensiController::class, 'exportPdf'])->middleware('admin');
Route::get('/presensi/export-excel', [PresensiController::class, 'exportExcel'])->middleware('admin');
Route::get('/karyawan/export/{id}', [KaryawanController::class, 'exportKaryawan'])->middleware('admin');
Route::get('/download-file/{id}', [TugasController::class, 'downloadFile'])->middleware('admin');

//export pengelola
Route::get('/pengelola/presensi/export-pdf', [PengelolaPresensiController::class, 'exportPdf'])->middleware('pengelola');
Route::get('/pengelola/presensi/export-excel', [PengelolaPresensiController::class, 'exportExcel'])->middleware('pengelola');
Route::get('/pengelola/karyawan/export/{id}', [PengelolaKaryawanController::class, 'exportKaryawan'])->middleware('pengelola');


//get lokai kantor
Route::get('/lokasi', [HomeController::class, 'lokasiKantor'])->name('lokasiKantor');

// middleware pengelola
Route::middleware(['pengelola'])->prefix('pengelola')->group(function (){
    Route::get('/dashboard', [HomeController::class, 'HomePengelola'])->name('pengelola.dashboard');
    Route::resource('/karyawan', PengelolaKaryawanController::class);
    Route::get('/presensi', [PengelolaPresensiController::class, 'index'])->name('pengelola.presensi.index');
    Route::get('/presensi/{karyawan}', [PengelolaPresensiController::class, 'show'])->name('pengelola.presensi.show');
    Route::get('/ubahPassword', [UpdatePasswordController::class, 'getPengelola'])->name('pengelola.ubahPassword');
    Route::post('/ubahPassword', [UpdatePasswordController::class, 'update'])->name('pengelola.ubahPassword.update');
    Route::get('/profile', [ProfilePengelolaController::class, 'profile'])->name('pengelola.profile');
    Route::post('/profile', [ProfilePengelolaController::class, 'updateProfile'])->name('pengelola.profile.update');
});

// middleware admin
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'HomeAdmin'])->name('admin.dashboard');;
    Route::resource('/divisi', DivisiController::class);
    Route::resource('/destinasi', DestinasiController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('/tugas', TugasController::class);
    Route::resource('/lokasiKantor', LokasiKantorController::class);
    Route::resource('/role', RoleManajemenController::class);
    Route::get('/formIzin', [FormIzinAdminController::class, 'index'])->name('admin.form.index');
    Route::put('/formIzin/{form}', [FormIzinAdminController::class, 'terima'])->name('admin.form.terima');
    Route::get('/presensi', [PresensiController::class, 'index'])->name('admin.presensi.index');
    Route::get('/presensi/{karyawan}', [PresensiController::class, 'show'])->name('admin.presensi.show');
    Route::get('/ubahPassword', [UpdatePasswordController::class, 'getAdmin'])->name('admin.ubahPassword');
    Route::post('/ubahPassword/', [UpdatePasswordController::class, 'update'])->name('admin.ubahPassword.update');
    Route::get('/profile', [ProfileAdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [ProfileAdminController::class, 'updateProfile'])->name('admin.profile.update');

});

Route::middleware(['karyawan'])->prefix('karyawan')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'HomeKaryawan'])->name('karyawan.dashboard');
    Route::get('/activity', [ActivityController::class, 'index'])->name('karyawan.activity.index');
    Route::post('/absensi-masuk', [AbsensiController::class, 'absenMasuk'])->name('karyawan.absensi.masuk');
    Route::post('/absensi-pulang', [AbsensiController::class, 'absenPulang'])->name('karyawan.absensi.pulang');
    Route::get('/absensi', [AbsensiController::class, 'checkAbsen'])->name('karyawan.absensi.checkAbsen');
    Route::put('/kerjakan/{tugas}', [ActivityController::class, 'kerjakan'])->name('karyawan.activity.kerjakan');
    Route::put('/selesaikan/{tugas}', [ActivityController::class, 'selesaikan'])->name('karyawan.activity.selesaikan');
    Route::resource('/formIzin', FormIzinController::class);
    Route::get('/ubahPassword', [UpdatePasswordController::class, 'getUser'])->name('karyawan.ubahPassword');
    Route::post('/ubahPassword/', [UpdatePasswordController::class, 'update'])->name('karyawan.ubahPassword.update');
    Route::get('/profile', [ProfileKaryawanController::class, 'profile'])->name('karyawan.profile');
    Route::post('/profile', [ProfileKaryawanController::class, 'updateProfile'])->name('karyawan.profile.update');
});
