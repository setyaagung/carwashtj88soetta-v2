<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = ['rekap_id', 'karyawan_id', 'tanggal_absensi', 'shift', 'pendapatan'];
}
