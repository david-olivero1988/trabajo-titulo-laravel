<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsToCicloAniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ciclo_anios', function(Blueprint $table){
            $table->integer('ciclos_anios')->nullable()->change();
            $table->integer('repetir_el_0')->nullable()->change();
            $table->string('del_mes_0')->nullable()->change();
            $table->string('repetir_el_1')->nullable()->change();
            $table->string('dia_1')->nullable()->change();
            $table->string('mes_1')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
