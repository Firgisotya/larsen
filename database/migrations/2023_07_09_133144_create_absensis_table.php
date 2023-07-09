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
            $table->date('tanggal');
            $table->time('jam_pagi');
            $table->string('lokasi_pagi');
            $table->string('foto_pagi');
            $table->time('jam_siang');
            $table->string('lokasi_siang');
            $table->string('foto_siang');
            $table->time('jam_sore');
            $table->string('lokasi_sore');
            $table->string('foto_sore');
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
