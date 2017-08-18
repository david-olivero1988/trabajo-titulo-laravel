<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicloAniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclo_anios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo');
            $table->integer('int_ciclos_anios');
            $table->integer('int_repetir_el_0');
            $table->string('str_del_mes_0');
            $table->string('str_repetir_el_1');
            $table->string('str_dia_1');
            $table->string('str_mes_1');
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
       // Schema::drop('ciclo_anios');
    }
}
