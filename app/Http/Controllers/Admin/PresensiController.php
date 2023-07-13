<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\FormIzin;
use App\Models\Karyawan;
use App\Models\LokasiKantor;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function export_pdf()
    {
        // $key = Absensi::with(['karyawan', 'izin'])->get();
        // var_dump($key);
        // $pdf = PDF::loadview('admin.presensi.export-pdf', [
        //     'absensi' => $key,
        //     // 'title' => 'Export PDF',
        // ])->setPaper('a4', 'portrait');
        // return $pdf->download('presensi.pdf');
        return view('home');
        
    }

    public function export_excel()
    {
        $absensi = Absensi::with(['karyawan', 'izin'])->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Karyawan');
        $sheet->setCellValue('C1', 'Izin');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Jam Masuk');
        $sheet->setCellValue('F1', 'Lokasi Masuk');
        $sheet->setCellValue('G1', 'Foto Masuk');
        $sheet->setCellValue('H1', 'Jam Pulang');
        $sheet->setCellValue('I1', 'Lokasi Pulang');
        $sheet->setCellValue('J1', 'Foto Pulang');
        $sheet->setCellValue('K1', 'Telat');

        $row = 2;
        foreach ($absensi as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->karyawan->nama_karyawan);
            $sheet->setCellValue('C' . $row, $item->izin ? $item->izin->jenis_izin : '-');
            $sheet->setCellValue('D' . $row, $item->tanggal);
            $sheet->setCellValue('E' . $row, $item->jam_masuk);
            $sheet->setCellValue('F' . $row, $item->lokasi_masuk);
            $sheet->setCellValue('G' . $row, $item->foto_masuk);
            $sheet->setCellValue('H' . $row, $item->jam_pulang);
            $sheet->setCellValue('I' . $row, $item->lokasi_pulang);
            $sheet->setCellValue('J' . $row, $item->foto_pulang);
            $sheet->setCellValue('K' . $row, $item->telat);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('presensi.xlsx');

        return Response::download('presensi.xlsx', 'presensi.xlsx');
    }
}
