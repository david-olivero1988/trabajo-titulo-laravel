<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrecuenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frecuencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo');
            $table->integer('int_ciclo_dias_0');
            $table->integer('int_ciclo_semenas_1');
            $table->string('str_dias_1');
            $table->integer('mensual_id');
            $table->integer('anual_id');
            $table->timestamps();

            $table->foreign('mensual_id')
                  ->references('id')
                  ->on('ciclo_mes');

            $table->foreign('anual_id')
                  ->references('id')
                  ->on('ciclo_anios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('frecuencias');
    }
}
