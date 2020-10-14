<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->char('estado',1);
            $table->decimal('total',13,3);
            $table->integer('id_facturas')->unsigned();
            $table->foreign('id_facturas')->references('id')->on('facturas');
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
        Schema::dropIfExists('det_facturas');
    }
}
