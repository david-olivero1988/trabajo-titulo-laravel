<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CumpleCondicion extends Model
{
    protected $table ='cumplimiento_condicion';

    protected $fillable=['campania_id','rut_beneficiario','valor','fecha'];



    protected function retornaNotificaciones($fecha_actual)
    {
    	return $calendario_condicion=Calendario::select('*','calendario.id as id_calendario')
                            ->join('cumplimiento_condicion','calendario.campania_id','=','cumplimiento_condicion.campania_id')
                            ->where('calendario.fecha_envio',$fecha_actual)
                            ->where('cumplimiento_condicion.valor',1)
                            ->get();
    }
}
