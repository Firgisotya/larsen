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
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('karyawans')->insert([
                'divisi_id' => null,
                'nik' => $faker->unique()->randomNumber(6),
                'nama_karyawan' => $faker->name,
                'tanggal_lahir' => $faker->date,
                'tempat_lahir' => $faker->city,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'no_telepon' => $faker->phoneNumber,
                'tahun_masuk' => $faker->year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
