<?php

namespace App\Http\Controllers;

use App\Models\ConfCampania;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ConfiguracionGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conf_campania = ConfCampania::find(1);
        $fecha_hora = $conf_campania->updated_at->format('d-m-Y  h:i:s A');
        $horaArray = explode(':', $conf_campania->hora);
        $hora = $horaArray[0] . ':' . $horaArray[1];

        return view('campanias.configuracion_general', compact('fecha_hora', 'conf_campania', 'hora'));
    }

    public function store(Request $request)
    {

        if (!$request->mediodia) {

            flash('Error! Por favor ingresar horario PM o AM.', 'danger');
            return redirect()->action('ConfiguracionGeneralController@index');
        }
        if (!$request->hora) {

            flash('Error! Debe ingresa la hora.', 'danger');
            return redirect()->action('ConfiguracionGeneralController@index');
        }
        if (!$request->num_notificaciones) {

            flash('Error! Debe ingresar número de notificaciones.', 'danger');
            return redirect()->action('ConfiguracionGeneralController@index');
        }
        if (!$request->mensaje_generico) {

            flash('Error! Debe ingresar un mensaje genérico.', 'danger');
            return redirect()->action('ConfiguracionGeneralController@index');
        }
        $horaArray = explode(':', $request->hora);

        if (count($horaArray) < 2) {

            flash('Error! formato hora incorrecto.', 'danger');
            return redirect()->action('ConfiguracionGeneralController@index');
        }

        $conf_campania = ConfCampania::find(1);
        if (!$conf_campania) {

            ConfCampania::create([
                'hora' => $request->hora,
                'mediodia' => $request->mediodia,
                'num_notificaciones' => $request->num_notificaciones,
                'mensaje_generico' => $request->mensaje_generico,
                'usuario' => $request->usuario,
            ]);
        }

        $conf_campania->hora = $request->hora;
        $conf_campania->mediodia = $request->mediodia;
        $conf_campania->num_notificaciones = $request->num_notificaciones;
        $conf_campania->mensaje_generico = $request->mensaje_generico;
        $conf_campania->usuario = $request->usuario;

        $conf_campania->save();

        flash('Configuración exitosa', 'success');

        return redirect()->action('ConfiguracionGeneralController@index');
    }
}
