<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

##clases agregadas

use Illuminate\Support\Facades\DB;

class Destinatario extends Model
{
    protected $table='destinatarios';

    protected $fillable=['notificaciones_id','rut_beneficiario','campania_id','enviado','fecha_envio','leido','fecha_leido'];


    protected function destinatariosAll()
    {
    	$destinatarios = Destinatario::select('*','notificaciones.fecha_envio as notificaciones_fecha_envio')
    						->join('beneficiarios','destinatarios.rut_beneficiario','=','beneficiarios.rut')
    						->join('notificaciones','destinatarios.notificacion_id','=','notificaciones.id')
    						->join('campanias','notificaciones.campania_id','=','campanias.id')
    						->join('universos','campanias.universos_id','=','universos.id')
    						->join('procesos','universos.proceso_id','=','procesos.id')
                            ->join('contacto','destinatarios.rut_beneficiario','=','contacto.rut')
                            ->where('notificaciones.fecha_envio','<>',NULL)
    						->orderBy('destinatarios.rut_beneficiario')
    						->paginate(17);


    	return $destinatarios;
    }

    protected function destinatariosPorFiltros($condicion)
    {

    	$q="select *,
                    n.id as notificaciones_id,
                    n.fecha_envio as notificaciones_fecha_envio,
                    d.fecha_envio as destinatarios_fecha_envio

                    from destinatarios d
                    inner join beneficiarios b on (d.rut_beneficiario = b.rut)
                    inner join notificaciones n on (d.notificacion_id = n.id)
                    inner join campanias c on (n.campania_id = c.id)
                    inner join universos u on (c.universos_id = u.id)
                    inner join procesos p on (u.proceso_id = p.id)
                    inner join contacto con on (d.rut_beneficiario = con.rut)

                    where ".$condicion." order by d.rut_beneficiario";
       // dd($q);



    	return $notificaciones = DB::select($q);
    }
}
