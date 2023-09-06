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
        $request->validate([
            'captured_image' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);


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

        // validasi foto absensi
        if (empty($foto)) {
            Alert::error('Foto absensi tidak ditemukan', 'Silahkan ambil foto terlebih dahulu');
            return response()->json(['message' => 'Foto absensi tidak ditemukan'], 400);
        }

        // menghitung lama telat absensi
        $jamAbsen = Carbon::createFromFormat('H:i:s', $jam);
        $dueDate = LokasiKantor::all();

        $telat = null; // Menyimpan lama telat awal sebagai null

        foreach ($dueDate as $date) {
            $jamBatas = Carbon::createFromFormat('H:i:s', $date->jam_masuk);

            // Hitung selisih antara waktu masuk dan batas waktu masuk
            $telatTemp = $jamAbsen->diffInMinutes($jamBatas);

            // Jika $telat masih null atau lebih kecil dari $telatTemp, maka update $telat
            if ($telat === null || $telatTemp < $telat) {
                $telat = $telatTemp;
            }
        }

        // Konversi lama telat dari menit menjadi format yang diinginkan
        $jamTelat = floor($telat / 60); // Menghitung jam
        $menitTelat = $telat % 60;      // Menghitung sisa menit
        $detikTelat = $jamAbsen->second; // Menghitung detik

        // Format lama telat dalam format yang diinginkan
        $hasilTelat = "$jamTelat jam $menitTelat menit $detikTelat detik";


        // Validasi apakah lama telat lebih dari 30 menit
        if ($telat > 30) {
            Alert::error('Telat lebih dari 30 menit', 'Anda telat untuk absen');
            return response()->json(['message' => 'Anda telat untuk absen'], 400);
        }

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
        $request->validate([
            // 'captured_image' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

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

        // validasi foto absensi
        if (empty($foto)) {
            Alert::error('Foto absensi tidak ditemukan', 'Silahkan ambil foto terlebih dahulu');
            return response()->json(['message' => 'Foto absensi tidak ditemukan'], 400);
        }

        // menghitung lama telat absensi
        $jamAbsen = Carbon::createFromFormat('H:i:s', $jam);
        $dueDate = LokasiKantor::all();

        $telat = null; // Menyimpan lama telat awal sebagai null

        foreach ($dueDate as $date) {
            $jamBatas = Carbon::createFromFormat('H:i:s', $date->jam_pulang);

            // Hitung selisih antara waktu masuk dan batas waktu masuk
            $telatTemp = $jamAbsen->diffInMinutes($jamBatas);

            // Jika $telat masih null atau lebih kecil dari $telatTemp, maka update $telat
            if ($telat === null || $telatTemp < $telat) {
                $telat = $telatTemp;
            }
        }

        // Validasi apakah lama telat lebih dari 30 menit
        if ($telat > 30) {
            Alert::error('Telat lebih dari 30 menit', 'Anda terlalu telat untuk absen');
            return response()->json(['message' => 'Anda terlalu telat untuk absen'], 400);
        }


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


            Alert::success('Absensi pulang berhasil disimpan', 'Hati Hati Dijalan');
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
