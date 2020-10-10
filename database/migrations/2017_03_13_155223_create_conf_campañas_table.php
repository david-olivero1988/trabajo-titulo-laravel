<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfCampañasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('conf_campanias')){

            Schema::create('conf_campanias', function (Blueprint $table) {
                $table->increments('id');
                $table->time('hora');
                $table->string('mediodia');
                $table->text('mensaje_generico');
                $table->integer('num_notificaciones');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conf_campanias');
    }
}
