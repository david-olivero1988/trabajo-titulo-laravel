<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervalosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervalos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin');
            $table->integer('repeticiones');
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
       // Schema::drop('intervalos');
    }
}
