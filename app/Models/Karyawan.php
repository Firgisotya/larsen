<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    protected $guarded = ['id'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function formIzin()
    {
        return $this->hasMany(FormIzin::class);
    }
}
