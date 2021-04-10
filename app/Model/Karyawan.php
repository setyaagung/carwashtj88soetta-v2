<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;
    protected $table =  'karyawan';
    protected $fillable = ['user_id', 'nama_karyawan', 'jabatan', 'alamat', 'no_telp'];
}
