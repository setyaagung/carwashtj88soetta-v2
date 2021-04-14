<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RekapDetail extends Model
{
    protected $table = 'rekap_detail';
    protected $fillable = ['rekap_id', 'paket_id', 'qty'];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
