<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormIzin extends Model
{
    use HasFactory;
    protected $table = 'form_izins';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'izin_id');
    }
}
