<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiKantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lokasi_kantors')->insert([
            [
                'nama_kantor' => 'Kantor Pusat',
                'alamat_kantor' => 'Jl. Raya Tlogomas No. 246, Tlogomas, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144',
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '17:00:00',
                'latitude' => -6.7633152,
                'longitude' => 106.7843584,
                'radius' => 100
            ],
            [
                'nama_kantor' => 'Kantor Cabang',
                'alamat_kantor' => 'Jl Raya Pasuruan, Kec. Bangil, Pasuruan, Jawa Timur 67153',
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '17:00:00',
                'latitude' => -7.723947,
                'longitude' => 112.709815,
                'radius' => 300
            ]
        ]);
    }
}
