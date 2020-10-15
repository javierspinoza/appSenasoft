<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario');
            $table->string('password');
            $table->integer('condicion',1);
            $table->integer('nombre');
            $table->string('remember_token');
            $table->integer('id_personas')->unsigned();
            $table->foreign('id_personas')->references('id')->on('personas');
            $table->integer('id_roles')->unsigned();
            $table->foreign('id_roles')->references('id')->on('roles');
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
        Schema::dropIfExists('usuarios');
    }
}
