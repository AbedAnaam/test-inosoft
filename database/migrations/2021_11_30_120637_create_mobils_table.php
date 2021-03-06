<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mobil', function (Blueprint $table) {
            $table->id();
            $table->string('mesin');
            $table->string('kapasitas_penumpang');
            $table->string('tipe');
            $table->unsignedInteger('mobil_id');
            $table->timestamps();

            $table->foreign('mobil_id')->references('id')->on('tbl_kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_mobil');
    }
}
