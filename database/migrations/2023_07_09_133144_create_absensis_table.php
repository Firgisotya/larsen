<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id');
            $table->foreignId('izin_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->string('lokasi_masuk')->nullable();
            $table->string('foto_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('lokasi_pulang')->nullable();
            $table->string('foto_pulang')->nullable();
            $table->string('telat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}
