<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HabitAcomd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_hab_acomd', function (Blueprint $table) {
            $table->increments('id_tipo_hab_acomd');
            $table->integer('id_tipo_acom')->unsigned();
            $table->foreign('id_tipo_acom')->references('id_tipo_acom')->on('tipo_acomodacion');
            $table->integer('id_tipo_hab')->unsigned();
            $table->foreign('id_tipo_hab')->references('id_tipo_hab')->on('tipo_habitacion');
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
        Schema::dropIfExists('tipo_hab_acomd');                
    }
}
