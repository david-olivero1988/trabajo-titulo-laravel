<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicloMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclo_mes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo');
            $table->integer('int_repetir_dia_0');
            $table->integer('int_por_meses_0');
            $table->string('str_repetir_el_1');
            $table->string('str_dia_1');
            $table->integer('int_por_1');
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
        //Schema::drop('ciclo_mes');
    }
}
