<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_invoice');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->string('shift');
            $table->unsignedBigInteger('paket_id');
            $table->unsignedBigInteger('kendaraan_id');
            $table->string('nama_kendaraan');
            $table->string('plat_nomor');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
