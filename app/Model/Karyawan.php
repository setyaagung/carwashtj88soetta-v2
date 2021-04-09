<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table =  'karyawan';
    protected $fillable = ['user_id', 'nama_karyawan', 'jabatan', 'alamat', 'no_telp'];
}
