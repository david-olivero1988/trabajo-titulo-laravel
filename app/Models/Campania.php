<?php

namespace App\Models;

##agregadas

use Illuminate\Database\Eloquent\Model;

##clases agregadas

class Campania extends Model
{
    protected $table = 'campanias';
    protected $fillable = ['asunto', 'mensaje', 'tipo_campania', 'universos_id', 'estado', 'frecuencia_id'];

    protected function campania_por_id($request)
    {

        //dd($request);
        if ($request->tipo_frecuencia == 2) {

            return $campania = Campania::select('*', 'campanias.id')->where('campanias.id', '=', $request->campania_id)
                ->join('intervalos', 'campanias.intervalo_id', '=', 'intervalos.id')
                ->join('frecuencias', 'campanias.frecuencias_id', '=', 'frecuencias.id')
                ->join('universos', 'campanias.universos_id', '=', 'universos.id')
                ->join('procesos', 'universos.proceso_id', '=', 'procesos.id')
                ->join('ciclo_mes', 'frecuencias.mensual_id', '=', 'ciclo_mes.id')
                ->first();
            // dd($campania);
        }
        if ($request->tipo_frecuencia == 3) {

            return $campania = Campania::select('*', 'campanias.id')->where('campanias.id', '=', $request->campania_id)
                ->join('intervalos', 'campanias.intervalo_id', '=', 'intervalos.id')
                ->join('frecuencias', 'campanias.frecuencias_id', '=', 'frecuencias.id')
                ->join('universos', 'campanias.universos_id', '=', 'universos.id')
                ->join('procesos', 'universos.proceso_id', '=', 'procesos.id')
                ->join('ciclo_anios', 'frecuencias.anual_id', '=', 'ciclo_anios.id')
                ->first();
        }
        //dd($request->campania_id);
        //dd($campania1);
        return $campania = Campania::select('*', 'campanias.id')->where('campanias.id', $request->campania_id)
            ->join('intervalos', 'campanias.intervalo_id', '=', 'intervalos.id')
            ->join('frecuencias', 'campanias.frecuencias_id', '=', 'frecuencias.id')
            ->join('universos', 'campanias.universos_id', '=', 'universos.id')
            ->join('procesos', 'universos.proceso_id', '=', 'procesos.id')
            ->first();
        // dd($campania);

    }

    protected function campanias()
    {

        return $campanias = Campania::select('campanias.id',
            'campanias.mensaje',
            'campanias.asunto',
            'campanias.tipo_campania',
            'campanias.estado',

            'universos.nombre_universo',
            'procesos.proceso',

            'intervalos.fecha_inicio',
            'intervalos.tipo_intervalo',
            'intervalos.fecha_fin',
            'intervalos.repeticiones'

        )
            ->where('campanias.estado', '<>', 'eliminado')
            ->join('universos', 'campanias.universos_id', '=', 'universos.id')
            ->join('procesos', 'universos.proceso_id', '=', 'procesos.id')
            ->join('intervalos', 'campanias.intervalo_id', '=', 'intervalos.id')
            ->orderBy('campanias.id')
            ->paginate(17);

    }

    protected function verCampania($id)
    {
        return $campania = Campania::select('*', 'campanias.id as id')->where('campanias.id', '=', $id)
            ->join('intervalos', 'campanias.intervalo_id', '=', 'intervalos.id')
            ->join('frecuencias', 'campanias.frecuencias_id', '=', 'frecuencias.id')
            ->join('universos', 'campanias.universos_id', '=', 'universos.id')
            ->join('procesos', 'universos.proceso_id', '=', 'procesos.id')
            ->first();
    }

    protected function editarCampania($id)
    {
        return $edit_campania = Campania::select('*', 'campanias.asunto',
            'campanias.id as campania_id',
            'campanias.mensaje',
            'campanias.tipo_campania',
            'campanias.estado',
            'universos.nombre_universo',
            'universos.descripcion',
            'procesos.proceso'
        )
            ->where('campanias.id', '=', $id)
            ->join('universos', 'campanias.universos_id', '=', 'universos.id')
            ->join('procesos', 'universos.proceso_id', '=', 'procesos.id')
            ->join('frecuencias', 'campanias.frecuencias_id', '=', 'frecuencias.id')
            ->first();
    }

}
