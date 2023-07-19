<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleManajemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("role_manajemens")->insert([
            [
                "nama_role" => "Admin",
            ],
            [
                "nama_role" => "Karyawan",
            ],
        ]);
    }
}
