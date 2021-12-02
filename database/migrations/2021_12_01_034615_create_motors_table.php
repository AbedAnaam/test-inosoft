<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_motor', function (Blueprint $table) {
            $table->id();
            $table->string('mesin');
            $table->string('tipe_suspensi');
            $table->string('tipe_transmisi');
            $table->unsignedInteger('motor_id');
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
        Schema::dropIfExists('tbl_motor');
    }
}
