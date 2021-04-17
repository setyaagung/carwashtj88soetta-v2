<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    protected $table = 'rekap';
    protected $fillable = ['tanggal_rekap', 'shift', 'total'];

    public function rekap_detail()
    {
        return $this->hasMany(RekapDetail::class);
    }
}
