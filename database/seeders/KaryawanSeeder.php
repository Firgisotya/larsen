<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            [
                'nama_karyawan' => 'Rizky',
                'divisi_id' => 1,
                'nik' => '123456789',
                'tanggal_lahir' => '2000-01-01',
                'tempat_lahir' => 'Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jakarta',
                'no_telepon' => '08123456789',
                'tahun_masuk' => '2021',

            ],
        ]);
    }
}
