<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\LokasiKantor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{


    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius Bumi dalam meter

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    public function absenMasuk(Request $request)
    {
        $dateTime = Carbon::now();
        $karyawanId = auth()->user()->karyawan_id;
        $tanggal = now()->toDateString();
        $jam = now()->format('H:i:s');
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
        $jamval = floor($telat / 60); // Menghitung jumlah jam
        $menitval = $telat % 60; // Menghitung jumlah menit
        $detikval = 0; // Jumlah detik diabaikan dalam contoh ini

        $hasilTelat = $jamval . ' jam ' . $menitval . ' menit ' . $detikval . ' detik';

        $allowLocation = LokasiKantor::all();

        $allowed = false;
        foreach ($allowLocation as $location) {
            $distance = $this->haversineDistance($latitude, $longitude, $location->latitude, $location->longitude);
            if ($distance <= $location->radius) {
                $allowed = true;
                break;
            }
        }

        if ($allowed) {
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
    }

    public function absenPulang(Request $request)
    {
        $dateTime = Carbon::now();
        $karyawanId = auth()->user()->karyawan_id;
        $tanggal = now()->toDateString();
        $jam = now()->format('H:i:s');
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
        $jamBatas = Carbon::createFromFormat('H:i:s', '17:00:00');
        $telat = $jamAbsen->diffInMinutes($jamBatas);

        // validasi foto absensi
        if (empty($foto)) {
            Alert::error('Foto absensi tidak ditemukan', 'Silahkan ambil foto terlebih dahulu');
            return response()->json(['message' => 'Foto absensi tidak ditemukan'], 400);
        }

        // konversi telat
        $jamval = floor($telat / 60); // Menghitung jumlah jam
        $menitval = $telat % 60; // Menghitung jumlah menit
        $detikval = 0; // Jumlah detik diabaikan dalam contoh ini

        $hasilTelat = $jamval . ' jam ' . $menitval . ' menit ' . $detikval . ' detik';

        $allowLocation = LokasiKantor::all();

        $allowed = false;
        foreach ($allowLocation as $location) {
            $distance = $this->haversineDistance($latitude, $longitude, $location->latitude, $location->longitude);
            if ($distance <= $location->radius) {
                $allowed = true;
                break;
            }
        }

        if ($allowed) {
            // simpan data absensi
            $absensi = Absensi::where('karyawan_id', $karyawanId)->where('tanggal', $tanggal)->first();
            if ($absensi == null) {
                $absensi = new Absensi;
                $absensi->jam_pulang = $jam;
                $absensi->lokasi_pulang = $latitude . ',' . $longitude;
                $absensi->foto_pulang = $fileName;
                $absensi->save();
            }
            $absensi->jam_pulang = $jam;
            $absensi->lokasi_pulang = $latitude . ',' . $longitude;
            $absensi->foto_pulang = $fileName;
            $absensi->save();


            Alert::success('Absensi masuk berhasil disimpan', 'Selamat bekerja');
            return response()->json(['message' => 'Absensi saved successfully'], 200);
        } else {
            Alert::error('Lokasi tidak valid untuk absen', 'Anda tidak berada di kantor');
            return response()->json(['message' => 'Lokasi tidak valid untuk absen'], 400);
        }
    }

    public function checkAbsen()
    {
        $karyawanId = auth()->user()->karyawan_id;
        $tanggal = now()->toDateString();

        $absensi = Absensi::where('karyawan_id', $karyawanId)->where('tanggal', $tanggal)->first();

       return $absensi;
    }
}
