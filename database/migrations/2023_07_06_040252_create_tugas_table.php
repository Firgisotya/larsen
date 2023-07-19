<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("karyawan_id")->nullable()->constrained("karyawans")->onDelete("cascade");
            $table->foreignId("destinasi_id")->nullable()->constrained("destinasis")->onDelete("cascade");
            $table->string('nama_tugas');
            $table->string('deskripsi_tugas');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('file_tugas')->nullable();
            $table->enum('status_tugas', ['Belum Dikerjakan', 'Dikerjakan', 'Ditolak', 'Selesai'])->default('Belum Dikerjakan');
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
        Schema::dropIfExists('tugas');
    }
}
