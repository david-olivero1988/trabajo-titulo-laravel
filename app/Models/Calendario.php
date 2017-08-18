<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table='calendario';
    protected $fillable=['id','campania_id','fecha_envio'];


     protected function retornaNotificaciones($fecha_actual)
    {
    	return $calendario_condicion=Calendario::select('*','calendario.id as calendario_id')
                            ->join('cumplimiento_condicion','calendario.campania_id','=','cumplimiento_condicion.campania_id')
                            ->join('campanias','calendario.campania_id','=','campanias.id')
                            ->where('calendario.fecha_envio',$fecha_actual)
                            ->where('cumplimiento_condicion.valor',1)
                            ->where('calendario.guardada',NULL)
                            ->orderBy('calendario.id')
                            ->get();
    }

    protected function campaniaManual($fecha_actual)
    {
      return $campania_manual=Calendario::select('*','calendario.id as calendario_id','campanias.id as campania_id','universos.id as universo_id')
      ->join('campanias','calendario.campania_id','=','campanias.id')
      ->join('universos','universos.id','=','campanias.universos_id')
      ->where('tipo_universo','manual')
      ->where('calendario.fecha_envio',$fecha_actual)
      ->where('calendario.guardada',NULL)
      ->get();
    }
}
