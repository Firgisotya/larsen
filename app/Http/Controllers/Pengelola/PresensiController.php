<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Tugas;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
            return view('pengelola.presensi.index', compact('absensi'))->render();
        }

        return view('pengelola.presensi.index', [
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
            'latMasuk' => $latMasuk[0] ?? null,
            'longMasuk' => $latMasuk[1] ?? null,
            'latPulang' => $latPulang[0] ?? null,
            'longPulang' => $latPulang[1] ?? null,
        ];


        return view('pengelola.presensi.show', [
            'absensi' => $absensi,
            'masuk_pulang' => $masuk_pulang,
        ]);
    }

    public function exportPdf()
    {
        $absensi = Absensi::with(['karyawan', 'izin'])->get();
        $tugas = Tugas::all();

        $totalTugas = [];
        $totalTugasSelesai = [];

        foreach ($absensi as $absen) {
            $tanggalAbsen = $absen->tanggal;
            $karyawanId = $absen->karyawan->id;

            // hitung total tugas
            $totalTugas[$tanggalAbsen][$karyawanId] = $tugas->where('tanggal', $tanggalAbsen)
                ->where('karyawan_id', $karyawanId)
                ->count();

            $totalTugasSelesai[$tanggalAbsen][$karyawanId] = $tugas->where('tanggal', $tanggalAbsen)
                ->where('karyawan_id', $karyawanId)
                ->where('status_tugas', 'Selesai')
                ->count();
        }

        $pdf = PDF::loadView('pengelola.presensi.export_pdf', [
            'absensi' => $absensi,
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-presensi.pdf');
    }

    public function exportExcel()
    {
        // Mendapatkan data absensi bersamaan dengan relasi 'karyawan' dan 'izin'
        $absensi = Absensi::with(['karyawan', 'izin'])->get();
        $tugas = Tugas::all();

        $totalTugas = [];
        $totalTugasSelesai = [];

        foreach ($absensi as $absen) {
            $tanggalAbsen = $absen->tanggal;
            $karyawanId = $absen->karyawan->id;

            // hitung total tugas
            $totalTugas[$tanggalAbsen][$karyawanId] = $tugas->where('tanggal', $tanggalAbsen)
                ->where('karyawan_id', $karyawanId)
                ->count();

            $totalTugasSelesai[$tanggalAbsen][$karyawanId] = $tugas->where('tanggal', $tanggalAbsen)
                ->where('karyawan_id', $karyawanId)
                ->where('status_tugas', 'Selesai')
                ->count();
        }

        // Pemformatan warna
        $colorYellow = 'FFFF00';
        $colorRed = 'FF0000';

        // Membuat objek spreadsheet dan lembar kerja
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Pemformatan judul
        $sheet->setCellValue('A1', 'Data Absensi');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorYellow);
        $sheet->mergeCells('A1:J1');

        // Menambahkan header kolom
        $sheet->fromArray(
            ['Nama', 'Izin', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Lokasi Masuk', 'Lokasi Pulang', 'Telat', 'Total Tugas', 'Total Tugas Selesai'],
            null,
            'A2'
        );

        // Pemformatan header kolom
        $sheet->getStyle('A2:J2')->getFont()->setBold(true);
        $sheet->getStyle('A2:J2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorYellow);

        // Proses data ke dalam bentuk array yang sesuai untuk diekspor
        $exportData = [];

        foreach ($absensi as $item) {
            $exportData[] = [
                $item->karyawan->nama_karyawan, // Ambil atribut 'nama' dari relasi 'karyawan'
                $item->izin ? $item->izin->jenis_izin : 'Tidak Ada Izin', // Ambil alasan izin jika ada
                $item->tanggal,
                $item->jam_masuk,
                $item->jam_pulang,
                $item->lokasi_masuk,
                $item->lokasi_pulang,
                $item->telat,
                $totalTugas[$item->tanggal][$item->karyawan->id] ?? 0, // Total tugas
                $totalTugasSelesai[$item->tanggal][$item->karyawan->id] ?? 0, // Total tugas selesai
            ];
        }

        // Menambahkan data ke lembar kerja
        $sheet->fromArray($exportData, null, 'A3');

        // Pemformatan data
        $sheet->getStyle('A3:J' . (count($exportData) + 2))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('D3:E' . (count($exportData) + 2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H3:J' . (count($exportData) + 2))->getFont()->getColor()->setARGB($colorRed);

        // Menyesuaikan lebar kolom
        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Membuat objek writer untuk menulis spreadsheet ke dalam file Excel
        $writer = new Xlsx($spreadsheet);

        // Set header HTTP untuk men-download file Excel
        $fileName = 'export_data.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        // Menulis data spreadsheet ke dalam output HTTP
        $writer->save('php://output');
    }
}
