<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rekap_id');
            $table->unsignedBigInteger('paket_id');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('rekap_id')->references('id')->on('rekap')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_detail');
    }
}
