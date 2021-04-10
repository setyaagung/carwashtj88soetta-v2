<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use SoftDeletes;
    protected $table = 'kendaraan';
    protected $fillable = ['jenis_kendaraan'];
}
