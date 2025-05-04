<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'tblpendaftaran';

    protected $fillable = [
        'user_id',
        'nama_santri',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nama_orang_tua',
        'no_hp',
        'akta_kelahiran',
        'kartu_keluarga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
