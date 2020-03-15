<?php

namespace App\Http\Controllers;

use App\Models\Calendario;

##Clases agregadas

use App\Models\Campania;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->editar) {
            Calendario::where('campania_id', $request->campania_id)->delete();
        }

        $campania = Campania::campania_por_id($request); //retorna campaña reciencreada
        if ($campania->tipo_frecuencia == 0) {
            $this->dias($campania);
        }

        if ($campania->tipo_frecuencia == 1) {
            $this->semanas($campania);
        }

        if ($campania->tipo_frecuencia == 2) {
            if ($campania->repetir_dia_0) {
                $this->meses0($campania);
            } else {
                $this->meses1($campania);
            }

        }

        if ($campania->tipo_frecuencia == 3) {
            if ($campania->repetir_el_0) {
                $this->anio0($campania);
            } else {
                $this->anio1($campania);
            }
        }

        return redirect()->action('CampaniaController@index', ['data' => 1]);
    }

    protected function dias($campania)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_envio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_intervalo == 2) {
            $this->dias_intervalo_fechas($campania, $fecha_envio, $campania->ciclo_dias_0);
        }

        if ($campania->tipo_intervalo == 1) {
            $this->dias_intervalo_repeticion($campania, $fecha_envio, $campania->repeticiones);
        }

        if ($campania->tipo_intervalo == 0) {
            $this->dias_intervalo_repeticion($campania, $fecha_envio, 10);
        }

    }

    protected function dias_intervalo_fechas($campania, $fecha_envio, $dias)
    {
        $fecha = explode('-', $campania->fecha_fin);
        $fecha_fin = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_inicio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);


        for ($i = 0; $i < 200; $i++) {

            if ($fecha_envio->gte($fecha_inicio) and $fecha_envio->lte($fecha_fin)) {

                $notificacion = new Calendario;
                $notificacion->fecha_envio = $fecha_envio->toDateString();
                $notificacion->campania_id = $campania->id;
                $notificacion->save();
                $fecha_envio->addDays($dias);
            }

        }
    }
    protected function dias_intervalo_repeticion($campania, $fecha_envio, $repeticiones)
    {
        for ($i = 0; $i < $repeticiones; $i++) {

            $notificacion = new Calendario;
            $notificacion->fecha_envio = $fecha_envio->toDateString();
            $notificacion->campania_id = $campania->id;
            $fecha_envio->addDays($campania->ciclo_dias_0);
            $notificacion->save();

        }
    }

    protected function semanas($campania)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_envio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]); //se convierte fecha de inicio a objeto carbon
        if ($campania->tipo_intervalo == 2) {
            $fecha = explode('-', $campania->fecha_fin);
            $fecha_fin = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]); //se convierte fecha fin a objeto carbon

            $repeticiones = $fecha_envio->diffInWeeks($fecha_fin) / $campania->ciclo_semanas_1 + 1; //se obtiene el numero de repeticiones mediante la diferencia de semanas entre fecha de inicio y fecha fin dividido en ciclo de semanas

            $dias_semana_num = $this->arreglo($fecha_envio->dayOfWeek, $campania->tipo_intervalo); //entrega los dias de la semana que se deben notificar

        }
        if ($campania->tipo_intervalo == 1) {
            $repeticiones = $campania->repeticiones;
            $fecha_fin = null;
            $dias_semana_num = $this->arreglo($fecha_envio->dayOfWeek, $campania->tipo_intervalo);
        }
        if ($campania->tipo_intervalo == 0) {
            $repeticiones = 10;
            $fecha_fin = null;
            $dias_semana_num = $this->arreglo($fecha_envio->dayOfWeek, $campania->tipo_intervalo);
        }

        $dias_semana = explode(',', $campania->dias_1);

        $cont = 0;
        $aux = 0;
        $cantidadNotificaciones = 0;
        $dias_semana_num1 = array('lunes' => 1, 'martes' => 2, 'miercoles' => 3, 'jueves' => 4, 'viernes' => 5, 'sabado' => 6, 'domingo' => 7);
        $repeticiones1 = $repeticiones + 10;
        for ($i = 0; $i < $repeticiones1; $i++) {
            foreach ($dias_semana as $key => $value) {
                if ($value) {
                    $notificacion = new Calendario;

                    $fecha = explode('-', $campania->fecha_inicio);
                    $fecha_envio1 = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

                    if ($fecha_fin) {

                        if ($i > 0) {
                            $fecha_envio1->addWeeks($campania->ciclo_semanas_1 * $i);
                            $aux = 1;
                        }

                        $fecha_dia = $fecha_envio1->dayOfWeek;
                        if ($fecha_dia == 0) {
                            $fecha_dia = 7;
                        }

                        if ($fecha_dia <= $dias_semana_num1[$value] || $aux == 1) {
                            if ($fecha_dia > $dias_semana_num1[$value]) {
                                $notificacion->fecha_envio = $fecha_envio1->subDays($dias_semana_num[$value])->toDateString();
                            } else {
                                $notificacion->fecha_envio = $fecha_envio1->addDays($dias_semana_num[$value])->toDateString();
                            }

                            $notificacion->campania_id = $campania->id;

                            if ($fecha_envio1->gte($fecha_envio1) and $fecha_envio1->lte($fecha_fin)) {
                                $notificacion->save();
                            }

                        }

                    } else {
                        if ($i > 0) {
                            $fecha_envio1->addWeeks($campania->ciclo_semanas_1 * $i);
                            $aux = 1;
                        }

                        $fecha_dia = $fecha_envio1->dayOfWeek;
                        if ($fecha_dia == 0) {
                            $fecha_dia = 7;
                        }

                        if ($fecha_dia <= $dias_semana_num1[$value] || $aux == 1) {
                            if ($fecha_dia > $dias_semana_num1[$value]) {
                                $notificacion->fecha_envio = $fecha_envio1->subDays($dias_semana_num[$value])->toDateString();
                            } else {
                                $notificacion->fecha_envio = $fecha_envio1->addDays($dias_semana_num[$value])->toDateString();
                            }

                            $notificacion->campania_id = $campania->id;
                            if ($cantidadNotificaciones < $repeticiones) {

                                $notificacion->save();
                                $cantidadNotificaciones++;
                            }
                        }
                    }

                }

            }
            $cont = $i;
        }
    }

    protected function meses0($campania)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_inicio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_intervalo == 2) {
            $this->guarda_datos_con_fecha($fecha_inicio, $campania, $campania->por_meses_0);
        }
        if ($campania->tipo_intervalo == 1) {
            $this->guarda_datos_con_repeticion($campania->repeticiones, $fecha_inicio, $campania, $campania->por_meses_0);
        }
        if ($campania->tipo_intervalo == 0) {
            $this->guarda_datos_con_repeticion(10, $fecha_inicio, $campania, $campania->por_meses_0);
        }

    }

    protected function meses1($campania)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_inicio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_intervalo == 2) {
            $this->guarda_datos_con_fecha($fecha_inicio, $campania, $campania->por_1);
        }

        if ($campania->tipo_intervalo == 1) {
            $this->guarda_datos_con_repeticion1($campania->repeticiones, $fecha_inicio, $campania, $campania->por_1);
        }
        if ($campania->tipo_intervalo == 0) {
            $this->guarda_datos_con_repeticion1(10, $fecha_inicio, $campania, $campania->por_1);
        }

    }

    protected function guarda_datos_con_repeticion($repeticion, $fecha_inicio, $campania, $meses)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_envio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_frecuencia == 2 && $campania->repetir_dia_0) {
            $fecha_envio->day = $campania->repetir_dia_0;
        }

        if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_0) {

            $fecha_envio->month = $this->retorna_numero_mes($campania->del_mes_0);
            $fecha_envio->day = $campania->repetir_el_0;
            $meses = $meses * 12;

        }

        for ($i = 0; $i < $repeticion; $i++) {

            if ($campania->tipo_frecuencia == 2 && $campania->repetir_el_1) {
                $fecha_envio = $this->fecha_posicion_dia($campania->repetir_el_1, $campania->dia_1, "", $fecha_envio);
            }

            if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_1) //anio 1
            {

                $fecha_envio->month = $this->retorna_numero_mes($campania->mes_1);

                $fecha_envio = $this->fecha_posicion_dia($campania->repetir_el_1, $campania->dia_1, $campania->mes_1, $fecha_envio);

                $meses = $campania->ciclos_anios * 12;

            }

            if ($fecha_envio->gte($fecha_inicio)) {
                $notificacion = new Calendario;
                $notificacion->fecha_envio = $fecha_envio->toDateString();
                $notificacion->campania_id = $campania->id;
                if ($fecha_envio->day == $campania->repetir_dia_0 and $campania->tipo_frecuencia == 2) {
                    $notificacion->save();

                } else {
                    if ($campania->tipo_frecuencia == 2) {
                        $fecha_envio->subWeek(1);
                        $i--;
                    }

                }

                if ($campania->tipo_frecuencia == 3) {
                    $notificacion->save();
                }

                if ($fecha_envio->day >= 28 && $campania->tipo_frecuencia == 2) {

                    $fecha_envio->subWeek(1);
                    $fecha_envio->addMonths($meses);

                } else {
                    $fecha_envio->addMonths($meses);
                }

                if ($campania->tipo_frecuencia == 2 && $campania->repetir_dia_0) {
                    $fecha_envio->day = $campania->repetir_dia_0;
                }

                if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_0) {
                    $fecha_envio->day = $campania->repetir_el_0;
                }

            } else {
                if ($campania->tipo_frecuencia == 3) {
                    $fecha_envio->addYears(1);
                } else {
                    $fecha_envio->addMonths(1);
                }

                $i--;
            }
        }

    }

    protected function guarda_datos_con_repeticion1($repeticion, $fecha_inicio, $campania, $meses)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_envio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_frecuencia == 2 && $campania->repetir_dia_0) {
            $fecha_envio->day = $campania->repetir_dia_0;
        }

        if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_0) {

            $fecha_envio->month = $this->retorna_numero_mes($campania->del_mes_0);
            $fecha_envio->day = $campania->repetir_el_0;
            $meses = $meses * 12;

        }

        for ($i = 0; $i < $repeticion; $i++) {

            if ($campania->tipo_frecuencia == 2 && $campania->repetir_el_1) {
                $fecha_envio = $this->fecha_posicion_dia($campania->repetir_el_1, $campania->dia_1, "", $fecha_envio);
            }

            if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_1) //anio 1
            {


                $fecha_envio->month = $this->retorna_numero_mes($campania->mes_1);

                $fecha_envio = $this->fecha_posicion_dia($campania->repetir_el_1, $campania->dia_1, $campania->mes_1, $fecha_envio);

                $meses = $campania->ciclos_anios * 12;

            }

            if ($fecha_envio->gte($fecha_inicio)) {
                $notificacion = new Calendario;
                $notificacion->fecha_envio = $fecha_envio->toDateString();
                $notificacion->campania_id = $campania->id;
                $notificacion->save();

                $fecha_envio->addMonths($meses);
                if ($campania->tipo_frecuencia == 2 && $campania->repetir_dia_0) {
                    $fecha_envio->day = $campania->repetir_dia_0;
                }

                if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_0) {
                    $fecha_envio->day = $campania->repetir_el_0;
                }

            } else {
                if ($campania->tipo_frecuencia == 3) {
                    $fecha_envio->addYears(1);
                } else {
                    $fecha_envio->addMonths(1);
                }

                $i--;
            }
        }

    }

    protected function guarda_datos_con_fecha($fecha_inicio, $campania, $meses)
    {
        $fecha = explode('-', $campania->fecha_fin);
        $fecha_fin = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        $fecha = explode('-', $campania->fecha_inicio);

        $fecha_envio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_frecuencia == 2 && $campania->repetir_dia_0) //mes 0
        {
            $fecha_envio->day = $campania->repetir_dia_0;
        }

        if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_0) //anio 0
        {

            $fecha_envio->day = $campania->repetir_el_0;
            $fecha_envio->month = $this->retorna_numero_mes($campania->del_mes_0);
            $meses = $campania->ciclos_anios * 12;

        }

        for ($i = 0; $i < 200; $i++) {

            if ($campania->tipo_frecuencia == 2 && $campania->repetir_el_1) //mes 1
            {
                $fecha_envio = $this->fecha_posicion_dia($campania->repetir_el_1, $campania->dia_1, "", $fecha_envio);
            }

            if ($campania->tipo_frecuencia == 3 && $campania->repetir_el_1) //anio 1
            {

                $fecha_envio->month = $this->retorna_numero_mes($campania->mes_1);

                $fecha_envio = $this->fecha_posicion_dia($campania->repetir_el_1, $campania->dia_1, $campania->mes_1, $fecha_envio);

                $meses = $campania->ciclos_anios * 12;

            }

            if ($fecha_envio->gte($fecha_inicio) and $fecha_envio->lte($fecha_fin)) {

                $notificacion = new Calendario;
                $notificacion->fecha_envio = $fecha_envio->toDateString();
                $notificacion->campania_id = $campania->id;
                $notificacion->save();

                if ($fecha_envio->day >= 28) {
                    $fecha_envio->addMonths($meses);
                    $fecha_envio->subWeek(1);
                } else {
                    $fecha_envio->addMonths($meses);
                }

            } else {

                if ($campania->tipo_frecuencia == 3) {

                    $fecha_envio->addYears(1);
                } else {

                    $fecha_envio->addMonths(1);

                }

            }
            if ($fecha_envio->gte($fecha_fin)) {
                $i = 200;
            }
        }

    }

    protected function fecha_posicion_dia($posicion, $dia_semana, $mes, $fecha)
    {

        switch ($posicion) {
            case "primer":
                return $this->retorna_fecha($dia_semana, $fecha, 1);
            case "segundo":
                return $this->retorna_fecha($dia_semana, $fecha, 2);
            case "tercer":
                return $this->retorna_fecha($dia_semana, $fecha, 3);
            case "cuarto":
                return $this->retorna_fecha($dia_semana, $fecha, 4);
            case "ultimo":
                return $this->retorna_fecha($dia_semana, $fecha, 5);

        }
    }

    protected function retorna_fecha($dia_semana, $fecha, $posicion)
    {
        $fecha->day = 1;

        $mes = $fecha->month;
        $cont = 0;
        for ($i = 0; $i < 12; $i++) {
            if ($fecha->dayOfWeek == $this->numero_por_dia($dia_semana)) {
                $cont++;

                if ($cont == $posicion) {

                    if ($cont == 5) {
                        if ($fecha->month == $mes) {
                            return $fecha;
                        } else {
                            $fecha->subDays(7);
                        }

                    }
                    return $fecha;
                }
                $fecha->addDays(7);
            } else {
                $fecha->addDays(1);
            }

        }

    }

    protected function numero_por_dia($dia_semana)
    {
        switch ($dia_semana) {
            case "lunes":
                return 1;
            case "martes":
                return 2;
            case "miercoles":
                return 3;
            case "jueves":
                return 4;
            case "viernes":
                return 5;
            case "sabado":
                return 6;
            case "domingo":
                return 0;

        }
    }
    protected function retorna_numero_mes($mes)
    {

        switch ($mes) {
            case "enero":
                return 1;
            case "febrero":
                return 2;
            case "marzo":
                return 3;
            case "abril":
                return 4;
            case "mayo":
                return 5;
            case "junio":
                return 6;
            case "julio":
                return 7;
            case "agosto":
                return 8;
            case "septiembre":
                return 9;
            case "octubre":
                return 10;
            case "noviembre":
                return 11;
            case "diciembre":
                return 12;

        }
    }

    protected function anio0($campania)
    {
        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_inicio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_intervalo == 2) {
            $this->guarda_datos_con_fecha($fecha_inicio, $campania, $campania->ciclos_anios);
        }
        if ($campania->tipo_intervalo == 1) {
            $this->guarda_datos_con_repeticion($campania->repeticiones, $fecha_inicio, $campania, $campania->ciclos_anios);
        }
        if ($campania->tipo_intervalo == 0) {
            $this->guarda_datos_con_repeticion(10, $fecha_inicio, $campania, $campania->ciclos_anios);
        }
    }

    protected function anio1($campania)
    {

        $fecha = explode('-', $campania->fecha_inicio);
        $fecha_inicio = Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2]);

        if ($campania->tipo_intervalo == 2) {
            $this->guarda_datos_con_fecha($fecha_inicio, $campania, $campania->ciclos_anios);
        }
        if ($campania->tipo_intervalo == 1) {
            $this->guarda_datos_con_repeticion1($campania->repeticiones, $fecha_inicio, $campania, $campania->ciclos_anios);
        }
        if ($campania->tipo_intervalo == 0) {

            $this->guarda_datos_con_repeticion1(10, $fecha_inicio, $campania, $campania->ciclos_anios);
        }
    }

    protected function arreglo($fecha, $tipo_intervalo)
    {

        if ($fecha == Carbon::MONDAY) {

            return array('lunes' => 0, 'martes' => 1, 'miercoles' => 2, 'jueves' => 3, 'viernes' => 4, 'sabado' => 5, 'domingo' => 6);
        }

        if ($fecha == Carbon::TUESDAY) {

            return array('lunes' => 1, 'martes' => 0, 'miercoles' => 1, 'jueves' => 2, 'viernes' => 3, 'sabado' => 4, 'domingo' => 5);
        }

        if ($fecha == Carbon::WEDNESDAY) {

            return array('lunes' => 2, 'martes' => 1, 'miercoles' => 0, 'jueves' => 1, 'viernes' => 2, 'sabado' => 3, 'domingo' => 4);
        }

        if ($fecha == Carbon::THURSDAY) {

            return array('lunes' => 3, 'martes' => 2, 'miercoles' => 1, 'jueves' => 0, 'viernes' => 1, 'sabado' => 2, 'domingo' => 3);
        }

        if ($fecha == Carbon::FRIDAY) {

            return array('lunes' => 4, 'martes' => 3, 'miercoles' => 2, 'jueves' => 1, 'viernes' => 0, 'sabado' => 1, 'domingo' => 2);
        }

        if ($fecha == Carbon::SATURDAY) {

            return array('lunes' => 5, 'martes' => 4, 'miercoles' => 3, 'jueves' => 2, 'viernes' => 1, 'sabado' => 0, 'domingo' => 1);
        }

        if ($fecha == Carbon::SUNDAY) {

            return array('lunes' => 6, 'martes' => 5, 'miercoles' => 4, 'jueves' => 3, 'viernes' => 2, 'sabado' => 1, 'domingo' => 0);
        }

    }

}
