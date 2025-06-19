<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';

    protected $fillable = [
        'karyawan_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan_cuti',
        'status_kelola',
    ];

    protected $casts = [
        'bulan' => 'date',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(PembayaranGaji::class);
    }

    // Accessor: total_bersih otomatis
    public function getTotalBersihAttribute()
    {
        return $this->gaji_pokok + $this->tunjangan - $this->potongan_cuti;
    }

    public function getBulanFormatAttribute()
    {
        try {
            return $this->bulan->translatedFormat('F Y');
        } catch (Exception $e) {
            return $this->bulan;
        }
    }
}