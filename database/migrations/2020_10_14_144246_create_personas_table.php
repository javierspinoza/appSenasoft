<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('numero');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('tp_document');
            $table->char('is_usuario',1);
            $table->char('is_cliente',1);
            $table->char('is_proveedor',1);
            $table->char('is_vendedor',1);
            $table->integer('id_tenan')->unsigned();
            $table->foreign('id_tenan')->references('id')->on('tenans');
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
        Schema::dropIfExists('personas');
    }
}
