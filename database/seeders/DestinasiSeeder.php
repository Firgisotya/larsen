<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinasis')->insert([
            [
                'nama_destinasi' => 'Kantor',
            ],
            [
                'nama_destinasi' => 'Rumah',
            ],
            [
                'nama_destinasi' => 'Luar Kota',
            ],
            [
                'nama_destinasi' => 'Luar Negeri',
            ],
        ]);
    }
}
