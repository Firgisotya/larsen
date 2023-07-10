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
            $table->time('jam_pagi')->nullable();
            $table->string('lokasi_pagi')->nullable();
            $table->string('foto_pagi')->nullable();
            $table->time('jam_siang')->nullable();
            $table->string('lokasi_siang')->nullable();
            $table->string('foto_siang')->nullable();
            $table->time('jam_sore')->nullable();
            $table->string('lokasi_sore')->nullable();
            $table->string('foto_sore')->nullable();
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
