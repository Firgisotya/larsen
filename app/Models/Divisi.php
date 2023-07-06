<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisis';
    protected $guarded = [''];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
