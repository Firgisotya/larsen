<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Divisi;
use App\Models\FormIzin;
use App\Models\Karyawan;
use App\Models\LokasiKantor;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function divisiSearch(Request $request)
    {
        $query = $request->input('query');

        // Query database untuk mencari divisi berdasarkan $searchTerm
        $divisi = Divisi::where('nama_divisi', 'like', "%$query%")->get();

        return response()->json($divisi);
    }

    public function kantorSearch(Request $request)
    {
        $query = $request->input('query');

        $kantor = LokasiKantor::where('nama_kantor', 'like', "%$query%")
            ->orWhere('alamat_kantor', 'like', "%$query%")
            ->get();

        return response()->json($kantor);
    }

    public function destinasiSearch(Request $request)
    {
        $query = $request->input('query');

        $destinasi = Destinasi::where('nama_destinasi', 'like', "%$query%")
            ->get();

        return response()->json($destinasi);
    }

    public function tugasSearch(Request $request)
    {
        $query = $request->input('query');

        $tugas = Tugas::with(['karyawan', 'destinasi'])
            ->where(function ($q) use ($query) {
                $q->where('nama_tugas', 'like', "%$query%")
                    ->orWhere('tanggal', 'like', "%$query%")
                    ->orWhere('status_tugas', 'like', "%$query%");
            })
            ->orWhereHas('karyawan', function ($q) use ($query) {
                $q->where('nama_karyawan', 'like', "%$query%");
            })
            ->orWhereHas('destinasi', function ($q) use ($query) {
                $q->where('nama_destinasi', 'like', "%$query%");
            })
            ->get();

        return response()->json($tugas);
    }


    public function karyawanSearch(Request $request)
    {
        $query = $request->input('query');

        $karyawan = Karyawan::where('nama_karyawan', 'like', "%$query%")
            ->orWhere('jenis_kelamin', 'like', "%$query%")
            ->orWhere('alamat', 'like', "%$query%")
            ->orWhere('no_telepon', 'like', "%$query%")
            ->orWhere('tahun_masuk', 'like', "%$query%")
            ->get();

        return response()->json($karyawan);
    }

    public function izinSerach(Request $request)
    {
        $query = $request->input('query');

        $izin = FormIzin::with('karyawan')
            ->where('jenis_izin', 'like', "%$query%")
            ->orWhere('nama_karyawan', 'like', "%$query%")
            ->orWhere('tanggal_izin', 'like', "%$query%")
            ->get();

        return response()->json($izin);
    }

    public function activitySearch(Request $request)
    {
        $query = $request->input('query');
        $karyawanID = Auth::user()->karyawan_id;
    
        $tugas = Tugas::with(['karyawan', 'destinasi'])
            ->where('karyawan_id', $karyawanID)
            ->where(function ($q) use ($query) {
                $q->where('nama_tugas', 'like', "%$query%")
                  ->orWhere('tanggal', 'like', "%$query%")
                  ->orWhere('status_tugas', 'like', "%$query%");
            })
            ->orWhereHas('karyawan', function ($q) use ($query) {
                $q->where('nama_karyawan', 'like', "%$query%");
            })
            ->orWhereHas('destinasi', function ($q) use ($query) {
                $q->where('nama_destinasi', 'like', "%$query%");
            })
            ->get();
    
        return response()->json($tugas);
    }

    public function izinKaryawanSearch(Request $request){
        $query = $request->input('query');
        $karyawanID = Auth::user()->karyawan_id;

        $izin = FormIzin::where('karyawan_id', $karyawanID)
            ->orwhere('jenis_izin', 'like', "%$query%")
            ->orWhere('nama_karyawan', 'like', "%$query%")
            ->orWhere('tanggal_izin', 'like', "%$query%")
            ->get();

        return response()->json($izin);
    }
    
}
