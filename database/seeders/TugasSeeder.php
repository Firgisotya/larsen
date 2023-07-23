<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tugas')->insert([
            [
                'nama_tugas' => 'Membuat Laporan',
                'karyawan_id' => '1',
                'destinasi_id' => '1',
                'deskripsi_tugas' => 'Membuat laporan mengenai kegiatan yang dilakukan selama di destinasi',
                'tanggal' => now(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '17:00:00',
                'status_tugas' => 'Belum Dikerjakan',
            ],
            [
                'nama_tugas' => 'Membuat Laporan',
                'karyawan_id' => '1',
                'destinasi_id' => '1',
                'deskripsi_tugas' => 'Membuat laporan mengenai kegiatan yang dilakukan selama di destinasi',
                'tanggal' => now(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '17:00:00',
                'status_tugas' => 'Belum Dikerjakan',
            ],
            [
                'nama_tugas' => 'Membuat Laporan',
                'karyawan_id' => '1',
                'destinasi_id' => '1',
                'deskripsi_tugas' => 'Membuat laporan mengenai kegiatan yang dilakukan selama di destinasi',
                'tanggal' => now(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '17:00:00',
                'status_tugas' => 'Belum Dikerjakan',
            ],
            [
                'nama_tugas' => 'Membuat Laporan',
                'karyawan_id' => '1',
                'destinasi_id' => '1',
                'deskripsi_tugas' => 'Membuat laporan mengenai kegiatan yang dilakukan selama di destinasi',
                'tanggal' => now(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '17:00:00',
                'status_tugas' => 'Belum Dikerjakan',
            ]
        ]);
    }
}
