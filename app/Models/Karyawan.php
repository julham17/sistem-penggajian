<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    return $this->belongsTo(User::class, 'user_id');
}

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }
}
