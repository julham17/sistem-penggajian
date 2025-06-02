<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    
    // Accessor: total_bersih otomatis
    public function getTotalBersihAttribute()
    {
        return $this->gaji_pokok + $this->tunjangan - $this->potongan_cuti;
    }
}