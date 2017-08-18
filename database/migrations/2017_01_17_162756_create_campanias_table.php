<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asunto');
            $table->text('mensaje');
            $table->string('tipo');
           
            $table->string('estado');
            
            $table->integer('universos_id');
            $table->integer('frecuencias_id');
            $table->timestamps();

            $table->foreign('universos_id')
                  ->references('id')
                  ->on('universos');

            $table->foreign('frecuencias_id')
                  ->references('id')
                  ->on('frecuencias');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::drop('campanias');
    }
}
