<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
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
            'latMasuk' => $latMasuk[0] ?? null,
            'longMasuk' => $latMasuk[1] ?? null,
            'latPulang' => $latPulang[0] ?? null,
            'longPulang' => $latPulang[1] ?? null,
        ];


        return view('admin.presensi.show', [
            'absensi' => $absensi,
            'masuk_pulang' => $masuk_pulang,
        ]);
    }

    public function exportPdf()
    {

        $query = "
        SELECT b.nama_karyawan,c.jenis_izin,a.tanggal,a.jam_masuk,
        a.lokasi_masuk,a.jam_pulang,a.lokasi_pulang,a.telat,
        COUNT(d.id) AS total_tugas,
        SUM(CASE WHEN d.status_tugas = 'Selesai' THEN 1 ELSE 0 END) AS total_tugas_selesai	
        FROM absensis a
        JOIN karyawans b ON a.karyawan_id = b.id
        LEFT JOIN form_izins c ON a.izin_id = c.id
        LEFT JOIN tugas d ON a.karyawan_id = d.karyawan_id 
        GROUP BY b.nama_karyawan, c.jenis_izin, a.tanggal, a.jam_masuk,
        a.lokasi_masuk, a.jam_pulang, a.lokasi_pulang, a.telat
        ";

        $absensi = DB::select(DB::raw($query));

        // $absensi = Absensi::with(['karyawan', 'izin'])->get();
        $pdf = PDF::loadView('admin.presensi.export_pdf', [
            'absensi' => $absensi,
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-presensi.pdf');
    }

    public function exportExcel()
    {
        // Mendapatkan data absensi bersamaan dengan relasi 'karyawan' dan 'izin'
        $absensi = Absensi::with(['karyawan', 'izin'])->get();

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
        $sheet->mergeCells('A1:H1');

        // Menambahkan header kolom
        $sheet->fromArray(
            ['Nama', 'Izin', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Lokasi Masuk', 'Lokasi Pulang', 'Telat'],
            null,
            'A2'
        );

        // Pemformatan header kolom
        $sheet->getStyle('A2:H2')->getFont()->setBold(true);
        $sheet->getStyle('A2:H2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorYellow);

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
            ];
        }

        // Menambahkan data ke lembar kerja
        $sheet->fromArray($exportData, null, 'A3');

        // Pemformatan data
        $sheet->getStyle('A3:H' . (count($exportData) + 2))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('D3:E' . (count($exportData) + 2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H3:H' . (count($exportData) + 2))->getFont()->getColor()->setARGB($colorRed);

        // Menyesuaikan lebar kolom
        foreach (range('A', 'H') as $column) {
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
