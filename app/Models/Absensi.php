<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function izin()
    {
        return $this->belongsTo(FormIzin::class, 'izin_id');
    }

    // filter tanggal
    public function scopeFilterByTanggal($query, $tanggal)
    {
        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        return $query;
    }

    // filter karyawan
    public function scopeFilterByKaryawan($query, $karyawanId)
{
    if ($karyawanId) {
        $query->whereHas('karyawan', function ($query) use ($karyawanId) {
            $query->where('id', $karyawanId);
        });
    }

    return $query;
}



}
