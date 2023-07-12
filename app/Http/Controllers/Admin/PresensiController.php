<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\FormIzin;
use App\Models\Karyawan;
use App\Models\LokasiKantor;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        $absensi = Absensi::with(['karyawan', 'izin']);



        if ($request->has('tanggal')) {
            $absensi->filterByTanggal($request->input('tanggal'));
        }

        if ($request->has('karyawan')) {
            $absensi->filterByKaryawan($request->input('karyawan'));
        }

        $absensi = $absensi->paginate(10);
        $karyawan = Karyawan::all();

        if ($request->ajax()) {
            return view('admin.presensi.index', compact('absensi'))->render();
        }

        return view('admin.presensi.index', [
            'absensi' => $absensi,
            'karyawan' => $karyawan,
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
            'masuk_pulang' => $masuk_pulang,
        ]);
    }
}
