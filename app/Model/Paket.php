<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use SoftDeletes;
    protected $table = 'paket';
    protected $fillable = ['nama_paket', 'harga'];
}
