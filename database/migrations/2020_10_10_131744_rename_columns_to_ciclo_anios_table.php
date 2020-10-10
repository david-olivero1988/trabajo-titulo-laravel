<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsToCicloAniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ciclo_anios', function(Blueprint $table){
            $table->renameColumn('int_ciclos_anios', 'ciclos_anios')->nullable();
            $table->renameColumn('int_repetir_el_0', 'repetir_el_0')->nullable();
            $table->renameColumn('str_del_mes_0', 'del_mes_0')->nullable();
            $table->renameColumn('str_repetir_el_1', 'repetir_el_1')->nullable();
            $table->renameColumn('str_dia_1', 'dia_1')->nullable();
            $table->renameColumn('str_mes_1', 'mes_1')->nullable();
            $table->renameColumn('tipo', 'tipo_ciclo_anio')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
