<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function divisiSearch(Request $request)
    {
        $query = $request->input('query');

        // Query database untuk mencari divisi berdasarkan $searchTerm
        $divisi = Divisi::where('nama_divisi', 'like', "%$query%")->get();

        return response()->json($divisi);
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

}
