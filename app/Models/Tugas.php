<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $guarded = [''];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    
}
