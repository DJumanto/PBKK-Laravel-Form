<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_table';
    protected $fillable = [
        'name', 'nrp', 'email', 'phone', 'gpa', 'portrait',
    ];
}
