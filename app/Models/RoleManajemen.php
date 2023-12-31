<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleManajemen extends Model
{
    use HasFactory;
    protected $table = "role_manajemens";
    protected $fillable = [
        'nama_role',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
