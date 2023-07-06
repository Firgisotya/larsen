<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisis')->insert([
            [
                'nama_divisi' => 'IT',
            ],
            [
                'nama_divisi' => 'HRD',
            ],
            [
                'nama_divisi' => 'Marketing',
            ],
            [
                'nama_divisi' => 'Keuangan',
            ],
        ]);
    }
}
