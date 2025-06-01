<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nip',
        'jabatan',
        'divisi',
        'nomor_telepon',
        'alamat',
        'tanggal_masuk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
