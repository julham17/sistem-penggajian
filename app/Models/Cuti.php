<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model
{
    use HasFactory;
    protected $table = 'cuti';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
