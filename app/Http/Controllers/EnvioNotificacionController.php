<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use App\Models\ConfCampania;
use App\Models\CumpleCondicion;
use App\Models\Destinatario;
use App\Models\Notificacion;
use Carbon\Carbon;
use Excel;
use FCM;
######FCM
use Illuminate\Support\Facades\Log;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class EnvioNotificacionController extends Controller
{

    public function __construct()
    {
        //dd(Auth::check());
        // dd(Auth::user());
        //dd($this->auth);
        //dd($auth);
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fecha_actual = Carbon::now();
        // $fecha_actual= Carbon::create(2017,03,24);
        $id_aux = 0;

/*++++++++++++++++++++inicio automatica+++++++++++++++++++++++++++*/

        ###consulta que añade beneficiarios con valor 1 y que les toque notificar en la fecha actual

        // dd($calendario_condicion);
        ###guarda notificaciones y destinatarios en base de datos
        $this->guardaNotificacionesDestinatarios($id_aux, $fecha_actual);
//dd("guardadas");
        /*++++++++++++++++++++fin automatica+++++++++++++++++++++++++++*/

/*++++++++++++++++++++inicio manual+++++++++++++++++++++++++++*/

        ##guarda notificaciones y los destinatarios de las campañas manuales
        $this->guardaNotificacionesDestinatariosManual($fecha_actual);

/*++++++++++++++++++++fin manual+++++++++++++++++++++++++++*/

        return "notificaciones guardadas";
    }

    protected function guardaNotificacionesDestinatarios($id_aux, $fecha_actual)
    {

        $calendario_condicion = Calendario::retornaNotificaciones($fecha_actual);
        //dd($calendario_condicion);
        Log::info('trae calendario');
        Log::info($calendario_condicion);
        // dd($calendario_condicion);
        foreach ($calendario_condicion as $key => $value) {

            if ($id_aux != $value->calendario_id) {

                $notificacion = new Notificacion;
                $notificacion->campania_id = $value->campania_id;
                $notificacion->fecha_envio = $fecha_actual->toDateString();
                $notificacion->notificacion_enviada = 'NO';
                Log::info('guardando notificacion');
                Log::info($notificacion);
                $notificacion->save();
                $id_aux = $value->calendario_id;

                $calendario = Calendario::find($value->calendario_id);
                $calendario->guardada = 'SI';
                $calendario->save();
            }

            $destinatario = new Destinatario;
            $destinatario->rut_beneficiario = $value->rut_beneficiario;
            $destinatario->leido = 'NO';
            $destinatario->enviado = 'NO';
            $destinatario->notificacion_id = $notificacion->id;

            Log::info('guardando destinatario');
            Log::info($destinatario);
            $destinatario->save();

        }

    }

    protected function guardaNotificacionesDestinatariosManual($fecha_actual)
    {

        //$fecha_actual= Carbon::create(2017,03,24);###debe ser fecha actual
        $campania_manual = Calendario::campaniaManual($fecha_actual);
        //  dd($campania_manual);
        foreach ($campania_manual as $key => $value) {
            // dd();
            $notificacion = new Notificacion;
            $notificacion->campania_id = $value->campania_id;
            $notificacion->fecha_envio = $fecha_actual->toDateString();
            $notificacion->notificacion_enviada = 'NO';
            $notificacion->save();
            //$value->
            $calendario = Calendario::find($value->calendario_id);
            $calendario->guardada = 'SI';
            $calendario->save();
            // dd();

            $results = Excel::load('uploads/' . $value->nombre_archivo)->get();
            //dd($results);
            foreach ($results as $k => $v) {

                $destinatario = new Destinatario;
                $destinatario->rut_beneficiario = $v->rut;
                $destinatario->leido = 'NO';
                $destinatario->enviado = 'NO';
                $destinatario->notificacion_id = $notificacion->id;

                $destinatario->save();

            }

        }
        // dd();
    }

    public function envioNotificacion()
    {

        $fecha_actual = Carbon::now();
        //$fecha_actual= Carbon::create(2017, 04, 04);
        $confCamp_hora_envio = ConfCampania::first();
        Log::info('configuracion de campaña');
        Log::info($confCamp_hora_envio);

        $hora_conf = Carbon::createFromFormat('g:i', $confCamp_hora_envio->hora);
        //dd($hora_conf);
        $hora = $fecha_actual->format('g:i:s');
        $mediodia = $fecha_actual->format('A');
        $hora_actual = Carbon::createFromFormat('g:i:s', $hora);

        if (true) {

            /*++++++++++++++++++++inicio automatica+++++++++++++++++++++++++++*/

            ###consulta que añade beneficiarios con valor 1 y que les toque notificar en la fecha actual

            ###guarda notificaciones y destinatarios en base de datos
            $this->guardaNotificacionesDestinatarios(0, $fecha_actual);
            /*++++++++++++++++++++fin automatica+++++++++++++++++++++++++++*/

            /*++++++++++++++++++++inicio manual+++++++++++++++++++++++++++*/

            ##guarda notificaciones y los destinatarios de las campañas manuales
            $this->guardaNotificacionesDestinatariosManual($fecha_actual);

            /*++++++++++++++++++++fin manual+++++++++++++++++++++++++++*/

            Log::info($fecha_actual);
            $envio_notificacion = Notificacion::retornaNotificacionAutoManual($fecha_actual);

            if (empty($envio_notificacion->all())) {
                return "no existen notificaciones para esta fecha";
            } else {

                Log::info('hay notificacion');

                $envio_notificacionAuto = Notificacion::retornaNotificacionActual($fecha_actual);
                if (empty($envio_notificacionAuto->all())) {
                    Log::info('hay notificacion manual');
                    $envio_notificacionManual = Notificacion::retornaNotificacionManual($fecha_actual);

                    $this->envioNotificacionManual($fecha_actual);
                    return "notificaciones manuales enviadas, no existen notificaciones automaticas para hoy";

                } else {
                    Log::info('hay notificacion automatica');

                    $fecha_actualizacion = $this->fechaUltimaActualizacion();
                    Log::info('fecha ultima actualizacion' . $fecha_actualizacion);
                    if ($fecha_actual->eq($fecha_actualizacion)) //compara fecha actual con fecha ultima acualización
                    {

                        $envio_notificacion = Notificacion::retornaNotificacionManual($fecha_actual);
                        if (empty($envio_notificacion->all())) {
                            $this->envioNotificacionAutomatica($fecha_actual);
                            return "se enviaron notificaciones solo automaticas, ya que no hay manuales para hoy";
                        } else {
                            $this->envioNotificacionAutoManual($fecha_actual);
                            return "se han enviados notificaciones manuales y automaticas correspondientes a la fecha";
                        }
                    } else {
                        $envio_notificacion = Notificacion::retornaNotificacionManual($fecha_actual);
                        if (empty($envio_notificacion->all())) {
                            return "no existen notificaciones para esta fecha, ya que la tabla cumplimmiento de condicion no ha sido actualizada, y no existen notificaciones manuales para hoy";
                        } else {

                            $this->envioNotificacionManual($fecha_actual);
                            return "notificaciones manuales enviadas, no existen notificaciones automaticas para hoy ya que no se ha actualizado la tabla cumplimiento de condición";
                        }
                    }

                }

            }
        }
        return "no es la hora configurada";
    }

    protected function fechaUltimaActualizacion()
    {
        $fecha_actualizacion = CumpleCondicion::select('fecha')->first();
        return Carbon::createFromFormat('Y-m-d', $fecha_actualizacion->fecha);
    }

    protected function envioNotificacionAutomatica($fecha_actual)
    {

        $envio_notificacion = Notificacion::retornaNotificacionActual($fecha_actual);

        $contadorRut = $this->conf_campanias($envio_notificacion);
        $this->envioPush($envio_notificacion, $fecha_actual, $contadorRut);
    }

    protected function envioNotificacionManual($fecha_actual)
    {

        $envio_notificacion = Notificacion::retornaNotificacionManual($fecha_actual);
        $contadorRut = $this->conf_campanias($envio_notificacion);
        $this->envioPush($envio_notificacion, $fecha_actual, $contadorRut);

    }

    protected function envioNotificacionAutoManual($fecha_actual)
    {
        $envio_notificacion = Notificacion::retornaNotificacionAutoManual($fecha_actual);

        $contadorRut = $this->conf_campanias($envio_notificacion);
        $this->envioPush($envio_notificacion, $fecha_actual, $contadorRut);

    }

    protected function conf_campanias($notificaciones)
    {
        $arrayAuxiliar = $this->llenaArregloAuxiliar($notificaciones);
        $contadorRut = array();
        foreach ($arrayAuxiliar as $key => $value) {
            foreach ($notificaciones as $k => $v) {
                if ($value[0] == $v->rut) {
                    $value[1]++;

                }
            }
            array_push($contadorRut, $value);
        }

        return $contadorRut;

    }

    protected function llenaArregloAuxiliar($notificaciones) //ordena todos los rut sin repeticiones

    {
        $arrayAuxiliar = array();
        $arrayAuxiliar[0][0] = $notificaciones[0]->rut;
        $arrayAuxiliar[0][1] = 0;
        foreach ($notificaciones as $key => $value) {
            $aux = true;
            if ($key != 0) {
                foreach ($arrayAuxiliar as $k => $v) {

                    if ($v[0] == $value->rut) {

                        $aux = false;
                    }
                }

                if ($aux) {

                    array_push($arrayAuxiliar, [0 => $value->rut, 1 => 0]);

                }

            }
        }
        return $arrayAuxiliar;
    }

    protected function envioPush($envio_notificacion, $fecha_actual, $contadorRut)
    {

        $genericos = [0];
        foreach ($envio_notificacion as $key => $value) {
            $generica = true;

            $generica = $this->verificaEnvio($contadorRut, $value, $fecha_actual, $genericos);

            if ($generica) {

                $optionBuiler = new OptionsBuilder();
                $optionBuiler->setTimeToLive(60 * 20);

                $option = $optionBuiler->build();

                $notificationBuilder = new PayloadNotificationBuilder('my title');
                $notificationBuilder->setTitle($value->asunto)
                    ->setBody($value->mensaje);

                $notification = $notificationBuilder->build();

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['destinatario_id' => $value->destinatarios_id]);

                $data = $dataBuilder->build();

                $token = "edmkzTTiNZA:APA91bHNDQjZvwmQzm1pP1JSLCAAlHpxu6yBExNEOZU-_CxOpQpK1y8G3EK50IP6rfbyx7a9veu_wei-gdKtY_W5E5nzxZMX2jvzPmti2pzkYdpXLkJMTuU9-Behg6xRqkmgchQbmsOw";

                $token = "fu9pqP3433U:APA91bGQCMnfuXz0mOpe-pmg0dOsrng3d3qIUX5PhOKMlWfB5bmvLVNBlQZBE8Yr8Lxbz2uNOld9N9z_RDwXHjBs1jUKQ_MQCKcN698b4nGJeCMWSyfcMVcj7VRWOrMLouvYxBytW1Lu";
                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                // $downstreamResponse = FCM::sendTo($tokens, $option, $notification);

                if ($downstreamResponse->numberSuccess() == 1) {

                    $notificacion = Notificacion::find($value->notificaciones_id);
                    $notificacion->notificacion_enviada = "SI";
                    $notificacion->save();

                    $destinatario = Destinatario::find($value->destinatarios_id);
                    $destinatario->fecha_envio = $fecha_actual->toDateString();
                    $destinatario->enviado = "SI";

                    $destinatario->save();

                }

                if ($downstreamResponse->numberFailure() == 1) {
                    dd($downstreamResponse);
                }
                $downstreamResponse->numberModification();

            }
        }

    }

    protected function verificaEnvio($contadorRut, $notificacion, $fecha_actual, &$genericos)
    {

        $conf_campania = ConfCampania::first();
        foreach ($contadorRut as $key => $value) {
            if ($notificacion->rut == $value[0]) {
                if ($value[1] > $conf_campania->num_notificaciones) {
                    foreach ($genericos as $key => $value) {

                        if ($value == $notificacion->rut) {
                            $notificacion_update = Notificacion::find($notificacion->notificaciones_id);
                            $notificacion_update->notificacion_enviada = "SI";
                            $notificacion_update->save();

                            $destinatario = Destinatario::find($notificacion->destinatarios_id);
                            $destinatario->fecha_envio = $fecha_actual->toDateString();
                            $destinatario->enviado = "SI";
                            $destinatario->save();
                            return false;

                        }
                    }
                    $this->envioNotificacionConfigurada($conf_campania->mensaje_generico, $notificacion, $fecha_actual, $genericos);
                    array_push($genericos, $notificacion->rut);
                    return false;
                }
                return true;

            }
        }

        return true;

    }

    protected function envioNotificacionConfigurada($mensaje_generico, $notificacion, $fecha_actual, $genericos)
    {
        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60 * 20);

        $option = $optionBuiler->build();

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setTitle('Ingresa')
            ->setBody($mensaje_generico);

        // dd($value);
        $notification = $notificationBuilder->build();

        // $dataBuilder = new PayloadDataBuilder();
        // $dataBuilder->addData('datos');
        //dd();
        //  $data = $dataBuilder->build();
        //dd($notificacion->fcm_token);
        //$token = $value->fcm_token;
        // $token ="edmkzTTiNZA:APA91bHNDQjZvwmQzm1pP1JSLCAAlHpxu6yBExNEOZU-_CxOpQpK1y8G3EK50IP6rfbyx7a9veu_wei-gdKtY_W5E5nzxZMX2jvzPmti2pzkYdpXLkJMTuU9-Behg6xRqkmgchQbmsOw";
        $downstreamResponse = FCM::sendTo($notificacion->fcm_token, $option, $notification); //, $data);
        // $downstreamResponse = FCM::sendTo($tokens, $option, $notification);

        //dd($downstreamResponse);
        if ($downstreamResponse->numberSuccess() == 1) {
            // dd($fecha_actual);

            $notificacion_update = Notificacion::find($notificacion->notificaciones_id);
            $notificacion_update->notificacion_enviada = "SI";
            $notificacion_update->save();
            //dd($notificacion);
            $destinatario = Destinatario::find($notificacion->destinatarios_id);
            // dd($destinatario);
            //dd();
            $destinatario->fecha_envio = $fecha_actual->toDateString();
            $destinatario->enviado = "SI";

            $destinatario->save();

            // dd($genericos);

        }
        // dd($downstreamResponse->numberSuccess());
    }

}
