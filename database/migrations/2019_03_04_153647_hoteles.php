<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hoteles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->increments('id_hotel');
            $table->string('nombre_ho')->unique();
            $table->string('direccion_ho');
            $table->integer('id_ciudad')->unsigned();
            $table->foreign('id_ciudad')->references('id_ciudad')->on('ciudades');
            $table->string('nit')->unique();
            $table->integer('numero_habit');
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
        Schema::dropIfExists('hoteles');
    }
}
