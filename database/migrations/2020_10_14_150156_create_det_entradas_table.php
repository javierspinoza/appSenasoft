<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->integer('id_entradas')->unsigned();
            $table->foreign('id_entradas')->references('id')->on('entradas');
            $table->integer('id_productos')->unsigned();
            $table->foreign('id_productos')->references('id')->on('productos');
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
        Schema::dropIfExists('det_entradas');
    }
}
