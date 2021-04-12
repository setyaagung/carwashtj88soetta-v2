<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = ['tanggal_pengeluaran', 'nama_pengeluaran', 'jenis', 'jumlah', 'keterangan'];
}
