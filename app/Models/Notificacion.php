<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Notificacion extends Model
{
    protected $table='notificaciones';

    protected $fillable=['notificaciones_id','campania_id','fecha_envio'];


    protected function retornaNotificacionActual($fecha_actual)
    {
	  return Notificacion::select('*',
                                'notificaciones.id as notificaciones_id',
                                'notificaciones.fecha_envio as notificaciones_fecha_envio',
                                'destinatarios.id as destinatarios_id',
                                'destinatarios.fecha_envio as destinatarios_fecha_envio')
                                ->where('notificaciones.notificacion_enviada','NO')
                                ->where('notificaciones.fecha_envio',$fecha_actual->toDateString())
                                ->where('campanias.tipo_campania','automatica')
                                ->join('destinatarios','notificaciones.id','=','destinatarios.notificacion_id')
                                ->join('beneficiarios','destinatarios.rut_beneficiario','=','beneficiarios.rut')
                                ->join('campanias','notificaciones.campania_id','=','campanias.id')
                                
                                ->where('campanias.estado','activado')
                                ->get();
    }

     protected function retornaNotificacionManual($fecha_actual)
    {
      return Notificacion::select('*',
                                'notificaciones.id as notificaciones_id',
                                'notificaciones.fecha_envio as notificaciones_fecha_envio',
                                'destinatarios.id as destinatarios_id',
                                'destinatarios.fecha_envio as destinatarios_fecha_envio')
                                ->where('notificaciones.notificacion_enviada','NO')
                                ->where('notificaciones.fecha_envio',$fecha_actual->toDateString())
                                ->where('campanias.tipo_campania','manual')
                                ->join('destinatarios','notificaciones.id','=','destinatarios.notificacion_id')
                                ->join('beneficiarios','destinatarios.rut_beneficiario','=','beneficiarios.rut')
                                ->join('campanias','notificaciones.campania_id','=','campanias.id')
                                ->where('campanias.estado','activado')
                                ->get();
    }

     protected function retornaNotificacionAutoManual($fecha_actual)
    {
        dd($fecha_actual->toDateString());
      return Notificacion::select('*',
                                'notificaciones.id as notificaciones_id',
                                'notificaciones.fecha_envio as notificaciones_fecha_envio',
                                'destinatarios.id as destinatarios_id',
                                'destinatarios.fecha_envio as destinatarios_fecha_envio')
                                ->where('notificaciones.notificacion_enviada','NO')
                                ->where('notificaciones.fecha_envio',$fecha_actual->toDateString())
                                //->where('campanias.tipo_campania','automatica')
                                ->join('destinatarios','notificaciones.id','=','destinatarios.notificacion_id')
                                ->join('beneficiarios','destinatarios.rut_beneficiario','=','beneficiarios.rut')
                                ->join('campanias','notificaciones.campania_id','=','campanias.id')                                
                                ->where('campanias.estado','activado')
                                ->get();
    }

    protected function retornaNotificacion()
    {
      return Notificacion::select('*',
                                'notificaciones.id as notificaciones_id',
                                'notificaciones.fecha_envio as notificaciones_fecha_envio'
                                //'destinatarios.id as destinatarios_id',
                                //'destinatarios.fecha_envio as destinatarios_fecha_envio'
                                )

                                
                                //->join('destinatarios','notificaciones.id','=','destinatarios.notificacion_id')
                                //->join('beneficiarios','destinatarios.rut_beneficiario','=','beneficiarios.rut')
                                ->join('campanias','notificaciones.campania_id','=','campanias.id')
                                ->join('universos','campanias.universos_id','=','universos.id')
                                ->join('procesos','universos.proceso_id','=','procesos.id')

                                ->where('notificaciones.notificacion_enviada','SI')
                                ->orderBy('notificaciones.id')
                                ->paginate(17);
    }

    protected function notificacionesPorId($id)
    {
        return Notificacion::select('*','campanias.id as campania_id','notificaciones.id as notificacion_id','notificaciones.updated_at as fecha_hora_envio')
                                  ->where('notificaciones.id',$id)      
                                  ->join('campanias','notificaciones.campania_id','=','campanias.id')
                                  ->join('frecuencias','campanias.frecuencias_id','=','frecuencias.id')
                                   ->first();
    }

    protected function queryNotificaciones($condicion, $request)
    {

        $condicion.=" and n.notificacion_enviada = 'SI' ";
        
        if($request->rut_beneficiario)
        {

            if(is_numeric($request->rut_beneficiario))
            $condicion.=" and d.rut_beneficiario = ".$request->rut_beneficiario;

            $q="select
                    n.id as notificaciones_id,
                    n.fecha_envio,
                     p.proceso,
                    u.nombre_universo,
                    c.asunto
                    
                    from destinatarios d
                    inner join notificaciones n on (d.notificacion_id = n.id)
                    inner join campanias c on (n.campania_id = c.id)
                    inner join universos u on (c.universos_id = u.id)
                    inner join procesos p on (u.proceso_id = p.id)
                    
                    where ".$condicion." group by n.id,c.id,p.id,u.id order by n.id";
                    //dd($q);
        }else
        {
            //dd();
            $q="select *,
                n.id as notificaciones_id,
                n.fecha_envio as notificaciones_fecha_envio

                from notificaciones n
                inner join campanias c on (n.campania_id = c.id)
                inner join universos u on (c.universos_id = u.id)
                inner join procesos p on (u.proceso_id = p.id)
                
                where ".$condicion." order by n.id";
        }
       // dd($q);

     return $campanias = DB::select($q);
       // dd($campanias); 
    }

     protected function queryNotificacionesExportar($condicion, $request)
    {

        $condicion.=" and d.fecha_envio is not NULL ";
            
            $q="select *,
                    n.id as notificaciones_id,
                    n.fecha_envio as notificaciones_fecha_envio,
                    d.fecha_envio as destinatarios_fecha_envio
                    from destinatarios d
                    inner join notificaciones n on (d.notificacion_id = n.id)
                    inner join campanias c on (n.campania_id = c.id)
                    inner join universos u on (c.universos_id = u.id)
                    inner join procesos p on (u.proceso_id = p.id)
                    inner join beneficiarios b on (d.rut_beneficiario = b.rut)
                    inner join contacto con on (d.rut_beneficiario = con.rut)
                    
                    where ".$condicion." order by n.id";
        
      // dd($q);

     return $campanias = DB::select($q);
       // dd($campanias); 
    }


}
