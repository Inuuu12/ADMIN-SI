<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'tblguru';
    protected $fillable = [
        'nama',
        'nip',
        'alamat',
        'no_hp',
        'email',
        'pendidikan_terakhir',
        'mata_pelajaran',
    ];
}
