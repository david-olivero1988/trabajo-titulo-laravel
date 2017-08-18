<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinatariossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('destinatarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rut_beneficiario');
            $table->integer('notificacion_id');
            $table->string('enviado');
            $table->date('fecha_envio')->nullable();
            $table->string('leido');
            $table->date('feha_leido')->nullable();


            $table->timestamps();

            $table->foreign('rut_beneficiario')
                  ->references('rut')
                  ->on('beneficiarios');
            $table->foreign('notificacion_id')
                  ->references('id')
                  ->on('notificaciones');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::drop('destinatarios');
    }
}

