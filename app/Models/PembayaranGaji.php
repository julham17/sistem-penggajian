<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranGaji extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_gaji';

    protected $fillable = [
        'gaji_id',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'bukti_pembayaran',
    ];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
