<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with(['karyawan', 'izin'])->paginate(10);
        return view('admin.presensi.index', [
            'absensi' => $absensi
        ]);
    }

    public function show($id)
    {
        $absensi = Absensi::with(['karyawan', 'izin'])->findOrFail($id);

        $latMasuk = explode(',', $absensi->lokasi_masuk);
        $latPulang = explode(',', $absensi->lokasi_pulang);

       $masuk_pulang = [
            'latMasuk' => $latMasuk[0],
            'longMasuk' => $latMasuk[1],
            'latPulang' => $latPulang[0],
            'longPulang' => $latPulang[1],
       ];
        

        return view('admin.presensi.show', [
            'absensi' => $absensi,
            'masuk_pulang' => $masuk_pulang
        ]);
    }
}
