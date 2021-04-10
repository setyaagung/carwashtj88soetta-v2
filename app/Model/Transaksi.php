<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['no_invoice', 'user_id', 'tanggal', 'shift', 'paket_id', 'kendaraan_id', 'nama_kendaraan', 'plat_nomor', 'total'];
}
