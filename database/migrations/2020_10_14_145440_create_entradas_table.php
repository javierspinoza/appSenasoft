<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->char('estado',1);
            $table->decimal('total',12,3);
            $table->integer('id_proveedores')->unsigned();
            $table->foreign('id_proveedores')->references('id')->on('personas');
            $table->integer('id_empleados')->unsigned();
            $table->foreign('id_empleados')->references('id')->on('personas');
            $table->integer('id_sucursales')->unsigned();
            $table->foreign('id_sucursales')->references('id')->on('sucursales');
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
        Schema::dropIfExists('entradas');
    }
}
