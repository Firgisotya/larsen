<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Destinasi;
use App\Models\Divisi;
use App\Models\FormIzin;
use App\Models\Karyawan;
use App\Models\LokasiKantor;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function HomeAdmin()
    {
        $karyawan = Karyawan::all();
        $divisi = Divisi::all();
        $destinasi = Destinasi::all();
        $tugas = Tugas::all();
        $absensi = Absensi::latest('id')->paginate(20);

        $countKaryawan = $karyawan->count();
        $countDivisi = $divisi->count();
        $countDestinasi = $destinasi->count();
        $countTugas = $tugas->count();

        return view('admin.homeAdmin', [
            'countKaryawan' => $countKaryawan,
            'countDivisi' => $countDivisi,
            'countDestinasi' => $countDestinasi,
            'countTugas' => $countTugas,
            'absensi' => $absensi,
        ]);
    }

    public function HomeKaryawan()
    {
        $hari_ini = now()->format('l, d F Y');

        $time = now()->format('H:i:s');
        $karyawanId = auth()->user()->karyawan_id;

        $cek = Absensi::where('karyawan_id', $karyawanId)->where('tanggal', now()->format('Y-m-d'))->first();
        // $cek = Absensi::where('karyawan_id', $karyawanId)->where('tanggal', '2023-07-12')->first();
        // dd($cek);

        // count absen
        // Mendapatkan tanggal awal dan akhir bulan saat ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Menghitung jumlah hari kerja dalam sebulan
        $absensi = Absensi::where('karyawan_id', $karyawanId)->whereBetween('tanggal', [$startDate, $endDate])->get();
        $countAbsen = $absensi->count();

        //menghitung jumlah izin dalam sebulan
        $izin = FormIzin::where('karyawan_id', $karyawanId)->whereBetween('tanggal_izin', [$startDate, $endDate])->where('status', '=', 'disetujui')->get();
        $countIzin = $izin->count();

        //menghitung jumlah tugas dalam sebulan
        $tugas = Tugas::where('karyawan_id', $karyawanId)->whereBetween('tanggal', [$startDate, $endDate])->where('status_tugas', '=', 'Selesai')->get();
        $countTugas = $tugas->count();

        //menghitung jumlah telat dalam sebulan
        $telat = Absensi::where('karyawan_id', $karyawanId)->whereBetween('tanggal', [$startDate, $endDate])->where('telat', '!=', null)->get();
        $countTelat = $telat->count();


        return view(
            'karyawan.homeKaryawan',
            [
                'time' => $time,
                'karyawanId' => $karyawanId,
                'countAbsen' => $countAbsen,
                'countIzin' => $countIzin,
                'countTugas' => $countTugas,
                'countTelat' => $countTelat,
                'hari_ini' => $hari_ini,
                'cek' => $cek,

            ]

        );
    }

    public function HomePengelola()
    {
        $karyawan = Karyawan::all();
        $divisi = Divisi::all();
        $destinasi = Destinasi::all();
        $tugas = Tugas::all();
        $absensi = Absensi::latest('id')->paginate(20);

        $countKaryawan = $karyawan->count();
        $countDivisi = $divisi->count();
        $countDestinasi = $destinasi->count();
        $countTugas = $tugas->count();

        return view('pengelola.homePengelola', [
            'countKaryawan' => $countKaryawan,
            'countDivisi' => $countDivisi,
            'countDestinasi' => $countDestinasi,
            'countTugas' => $countTugas,
            'absensi' => $absensi,
        ]);
    }

    public function lokasiKantor()
    {
        $lokasi = LokasiKantor::all();
        return $lokasi;
    }

    public function tesFoto(Request $request)
    {
        $imageData = $request->input('webcam-pagi');
        $image = substr($imageData, strpos($imageData, ',') + 1);
        $decodedImage = base64_decode($image);

        $imageName = 'tesFoto.png';

        file_put_contents(public_path('images/tesFoto/') . $imageName, $decodedImage);
        return response()->json(['success' => 'Image uploaded successfully']);
    }

    public function teslok(Request $request)
    {
        // Cek apakah browser mendukung geolocation
        if ($request->has('geolocation')) {
            // Mendapatkan geolocation dari request
            $geolocation = $request->input('geolocation');

            // Memisahkan latitude dan longitude dari geolocation
            list($latitude, $longitude) = explode(',', $geolocation);

            // Lakukan pemrosesan lebih lanjut sesuai kebutuhan Anda
            // ...

            return response()->json(['latitude' => $latitude, 'longitude' => $longitude]);
        }

        return response()->json(['error' => 'Geolocation not found.']);
    }
}
