<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users') // Add this line
            ->insert([ // Add this line
                [
                    'karyawan_id' => 1,
                    'username' => 'tes',
                    'email' => 'Tes@gmail.com',
                    'password' => bcrypt('password'),
                    'role' => 'karyawan',
                ],
                [
                    'karyawan_id' => null,
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('password'),
                    'role' => 'admin',
                ]
            ]);
    }
}
