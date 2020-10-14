<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->decimal('iva',13,2);
            $table->char('estado',1);
            $table->decimal('total');
            $table->integer('id_clientes')->unsigned();
            $table->foreign('id_clientes')->references('id')->on('personas');
            $table->integer('id_vendedores')->unsigned();
            $table->foreign('id_vendedores')->references('id')->on('personas');
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
        Schema::dropIfExists('facturas');
    }
}
