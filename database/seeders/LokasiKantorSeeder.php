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
                'latitude' => -7.7365248,
                'longitude' => 112.7022592
            ]
        ]);
    }
}
