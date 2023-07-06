<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;
    protected $table = 'destinasis';
    protected $guarded = [''];

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
