<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal_bon');
            $table->unsignedBigInteger('pengeluaran_id');
            $table->unsignedBigInteger('karyawan_id');
            $table->integer('jumlah');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('pengeluaran_id')->references('id')->on('pengeluaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bon');
    }
}
