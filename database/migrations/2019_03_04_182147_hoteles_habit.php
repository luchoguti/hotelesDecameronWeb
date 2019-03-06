<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HotelesHabit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoteles_habit', function (Blueprint $table) {
            $table->increments('id_hoteles_habit');
            $table->integer('numero_hoteles_habit');
            $table->integer('id_tipo_hab_acomd')->unsigned();
            $table->foreign('id_tipo_hab_acomd')->references('id_tipo_hab_acomd')->on('tipo_hab_acomd');
            $table->integer('id_hotel')->unsigned();
            $table->foreign('id_hotel')->references('id_hotel')->on('hoteles');
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
        Schema::dropIfExists('hoteles_habit');                
    }
}
