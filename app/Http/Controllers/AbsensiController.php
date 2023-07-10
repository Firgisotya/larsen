<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{

    public function store(Request $request)
    {
        $waktu = $request->input('waktu');

        if ($waktu == 'masuk') {
            $dateTime = Carbon::now();
            $karyawanId = auth()->user()->karyawan_id;
            $tanggal = now()->toDateString();
            $jam = $dateTime->format('H:i:s');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            // simpan foto ke direktori
            $foto = $request->input('captured_image');
            $image_parts = explode(";base64,", $foto);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'absensi_' . $karyawanId . '_' . time() . '.png';
            $file = $fileName;

            Storage::disk('public')->put('images/absensi/' . $file, $image_base64);

            // menghitung lama telat absensi
            $jamAbsen = Carbon::createFromFormat('H:i:s', $jam);
            $jamBatas = Carbon::createFromFormat('H:i:s', '08:00:00');
            $telat = $jamAbsen->diffInMinutes($jamBatas);

            // validasi foto absensi
            if (empty($foto)) {
                Alert::error('Foto absensi tidak ditemukan', 'Silahkan ambil foto terlebih dahulu');
                return response()->json(['message' => 'Foto absensi tidak ditemukan'], 400);
            }

            // konversi telat
            $jam = floor($telat / 60); // Menghitung jumlah jam
            $menit = $telat % 60; // Menghitung jumlah menit
            $detik = 0; // Jumlah detik diabaikan dalam contoh ini

            $hasilTelat = $jam . ' jam ' . $menit . ' menit ' . $detik . ' detik';



            // validasi lokasi absensi

            $allowedLatitude = -7.7365248;  // Ganti dengan latitude lokasi yang diizinkan
            $allowedLongitude = 112.7022592; // Ganti dengan longitude lokasi yang diizinkan

            // Menghitung jarak menggunakan formula Haversine
            $earthRadius = 6371; // Radius bumi dalam kilometer
            $latDiff = deg2rad($allowedLatitude - $latitude);
            $lonDiff = deg2rad($allowedLongitude - $longitude);
            $a = sin($latDiff / 2) * sin($latDiff / 2) + cos(deg2rad($latitude)) * cos(deg2rad($allowedLatitude)) * sin($lonDiff / 2) * sin($lonDiff / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $earthRadius * $c;

            // Menentukan radius yang diizinkan (misalnya, 1 kilometer)
            $allowedRadius = 0.1; // Ganti dengan radius yang diizinkan dalam kilometer

            if ($distance <= $allowedRadius) {

                // simpan data absensi
                $absensi = new Absensi;
                $absensi->karyawan_id = $karyawanId;
                $absensi->tanggal = $tanggal;
                $absensi->jam_masuk = $jam;
                $absensi->lokasi_masuk = $latitude . ',' . $longitude;
                $absensi->foto_masuk = $fileName;
                $absensi->telat = $hasilTelat;
                $absensi->save();

                Alert::success('Absensi masuk berhasil disimpan', 'Selamat bekerja');
                return response()->json(['message' => 'Absensi saved successfully'], 200);
            } else {
                Alert::error('Lokasi tidak valid untuk absen', 'Anda tidak berada di kantor');
                return response()->json(['message' => 'Lokasi tidak valid untuk absen'], 400);
            }
        } else if ($waktu == 'pulang') {
            $dateTime = Carbon::now();
            $karyawanId = auth()->user()->karyawan_id;
            $tanggal = now()->toDateString();
            $jam = $dateTime->format('H:i:s');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            // simpan foto ke direktori
            $foto = $request->input('captured_image');
            $image_parts = explode(";base64,", $foto);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'absensi_' . $karyawanId . '_' . time() . '.png';
            $file = $fileName;

            Storage::disk('public')->put('images/absensi/' . $file, $image_base64);

            // Lokasi yang diizinkan (misalnya, koordinat kantor)
            // $allowedLatitude = -7.8713039;  // Ganti dengan latitude lokasi yang diizinkan
            // $allowedLongitude = 112.5245536; // Ganti dengan longitude lokasi yang diizinkan

            $allowedLatitude = -6.7633152;  // Ganti dengan latitude lokasi yang diizinkan
            $allowedLongitude = 106.7843584; // Ganti dengan longitude lokasi yang diizinkan

            // Menghitung jarak menggunakan formula Haversine
            $earthRadius = 6371; // Radius bumi dalam kilometer
            $latDiff = deg2rad($allowedLatitude - $latitude);
            $lonDiff = deg2rad($allowedLongitude - $longitude);
            $a = sin($latDiff / 2) * sin($latDiff / 2) + cos(deg2rad($latitude)) * cos(deg2rad($allowedLatitude)) * sin($lonDiff / 2) * sin($lonDiff / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $earthRadius * $c;

            // Menentukan radius yang diizinkan (misalnya, 1 kilometer)
            $allowedRadius = 0.1; // Ganti dengan radius yang diizinkan dalam kilometer

            if ($distance <= $allowedRadius) {
                // update data absensi berdasarkan karyawan_id dan tanggal
                $absensi = Absensi::where('karyawan_id', $karyawanId)->where('tanggal', $tanggal)->first();
                $absensi->jam_pulang = $jam;
                $absensi->lokasi_pulang = $latitude . ',' . $longitude;
                $absensi->foto_pulang = $fileName;
                $absensi->save();

                Alert::success('Absensi pulang berhasil disimpan', 'Selamat pulang');
                return response()->json(['message' => 'Absensi saved successfully'], 200);
            } else {
                Alert::error('Lokasi tidak valid untuk absen', 'Anda tidak berada di kantor');
                return response()->json(['message' => 'Lokasi tidak valid untuk absen'], 400);
            }
        }
    }

    public function checkAbsen(Request $request)
    {
        $user = auth()->user();
        $karyawanId = $user->karyawan_id;

        $attendance = Absensi::where('karyawan_id', $karyawanId)->where('tanggal', now()->toDateString())->first();
        if ($attendance->foto_pagi != null and $attendance->lokasi_pagi != null) {
            dd('Anda sudah absen pagi');
        } else if ($attendance->foto_siang != null and $attendance->lokasi_siang != null) {
            dd('Anda sudah absen siang');
        } else if ($attendance->foto_sore != null and $attendance->lokasi_sore != null) {
            dd('Anda sudah absen sore');
        } else {
            dd('Anda belum absen');
        }
    }
}
