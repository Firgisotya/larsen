<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("divisi_id")->nullable()->constrained("divisis")->onDelete("cascade");
            $table->string('nik')->unique();
            $table->string('nama_karyawan');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->string('tahun_masuk');
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
        Schema::dropIfExists('karyawans');
    }
}
