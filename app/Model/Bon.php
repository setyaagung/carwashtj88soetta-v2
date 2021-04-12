<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    protected $table = 'bon';
    protected $fillable = ['tanggal_bon', 'pengeluaran_id', 'karyawan_id', 'jumlah', 'keterangan'];
}
