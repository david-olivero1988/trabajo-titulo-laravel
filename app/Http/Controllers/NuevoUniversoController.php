<?php

namespace App\Http\Controllers;

use App\Models\Proceso;

##agregados
use App\Models\Universo;
use DateTime;
use Excel;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class NuevoUniversoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $procesos = Proceso::all();

        return view('campanias.nuevo_universo', compact('procesos', 'universos', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $parametros = $request->only('comentario', 'proceso', 'nombre', 'proceso_nuevo');

        if ($parametros['proceso_nuevo']) {
            $nuevo_proceso = new Proceso;
            $nuevo_proceso->proceso = $parametros['proceso_nuevo'];

            $nuevo_proceso->save();
            $proceso_id = $nuevo_proceso->id;
            $proceso_actual = $nuevo_proceso;
        } else {
            $proceso_creado = Proceso::select('*')->where('proceso', '=', $parametros['proceso'])->get();
            $proceso_id = $proceso_creado[0]->id;
            $proceso_actual = $proceso_creado[0];
        }

        $nuevo_universo = new Universo;
        $nuevo_universo->nombre_universo = $parametros['nombre'];
        $nuevo_universo->descripcion = $parametros['comentario'];
        $nuevo_universo->proceso_id = $proceso_id;
        $nuevo_universo->tipo_universo = 'automatico';
        $nuevo_universo->save();

        $procesos = Proceso::all();
        $universos = Universo::all();
        flash('Universo creado exitosamente', 'success');
        return view('campanias.nueva_campania', compact('procesos', 'universos', 'request', 'proceso_actual'));
    }

    public function universoManual(Request $request)
    {

        $transfer = array();
        $archivo = $request->file('carga_universo');

        $nombre_original = $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        if ($extension == "xls" || $extension == "xlsx") {

            $now = DateTime::createFromFormat('U.u', microtime(true));
            $now_date = $now->format("YmdHis");
            // dd($now_date);
            $path = public_path() . '/uploads/';

            $filename = "carga_universo_" . $now_date . "." . $extension;

            $archivo->move($path, $filename); //moviendo archivo a uploads
            //permisos al directorio//
            //# chmod 755 /var/www/html/ADNLaravel/public/uploads/
            //# chown www-data:www-data /var/www/html/ADNLaravel/public/uploads/

            $ruta = $path . "" . $filename;

            /*$resultados=Excel::selectSheetsByIndex(0)->load($ruta, function($reader) {
            $reader->each(function($fila){
            $id  = $fila->id;
            $asunto = $fila->asunto;
            });

            })->get();*/
            $formato = 'correcto';
            $results = Excel::load($ruta)->get();
            foreach ($results as $key => $value) {

                if (!$value->rut) {
                    $formato = 'incorrecto';

                } else {
                    if (!is_numeric($value->rut)) {
                        $formato = 'incorrecto';
                    }

                }
            }
            if ($formato == 'incorrecto') {
                $archivo->delete($path, $filename);
                return response()->json(compact("extension", "formato"));
            }

            $universo1 = explode(".", $nombre_original);
            $universo = $universo1[0];
            $nuevo_universo = new Universo;
            $nuevo_universo->nombre_universo = $universo;
            $nuevo_universo->nombre_archivo = $filename;
            $nuevo_universo->descripcion = $request->descripcion_manual;
            $nuevo_universo->proceso_id = 1;
            $nuevo_universo->tipo_universo = 'manual';
            $nuevo_universo->save();
            $universo_id = $nuevo_universo->id;

            $tipo_universo = "manual";
            return response()->json(compact("universo", "universo_id", "extension", "tipo_universo", "formato"));
        }

        return response()->json(compact("extension"));

    }

    public function eliminaManual(Request $request)
    {

        $archivo = $request->file('carga_universo');

        $nombre_original = $archivo->getClientOriginalName();

        $extension = $archivo->getClientOriginalExtension();
        if ($extension == "xls" || $extension == "xlsx") {

            $now = DateTime::createFromFormat('U.u', microtime(true));
            $now_date = $now->format("YmdHis");
            // dd($now_date);
            $path = public_path() . '/uploads/';

            $filename = "carga_universo_" . $now_date . "." . $extension;

            $archivo->move($path, $filename); //moviendo archivo a uploads
            //permisos al directorio//
            //# chmod 755 /var/www/html/ADNLaravel/public/uploads/
            //# chown www-data:www-data /var/www/html/ADNLaravel/public/uploads/

            $ruta = $path . "" . $filename;

            /*$resultados=Excel::selectSheetsByIndex(0)->load($ruta, function($reader) {
            $reader->each(function($fila){
            $id  = $fila->id;
            $asunto = $fila->asunto;
            });

            })->get();*/

            $formato = 'correcto';
            $results = Excel::load($ruta)->get();
            foreach ($results as $key => $value) {

                if (!$value->rut) {
                    $formato = 'incorrecto';

                } else {
                    if (!is_numeric($value->rut)) {
                        $formato = 'incorrecto';
                    }

                }
            }

            if ($formato == 'incorrecto') {
                return response()->json(compact("extension", "formato"));
            }

            $universo1 = explode(".", $nombre_original);
            $universo = $universo1[0];
            $nuevo_universo = Universo::where('id', $request->universo_id)->first();

            $nuevo_universo->nombre_universo = $universo;
            $nuevo_universo->nombre_archivo = $filename;
            $nuevo_universo->proceso_id = 1;
            $nuevo_universo->tipo_universo = 'manual';
            $nuevo_universo->save();
            $universo_id = $nuevo_universo->id;

            $tipo_universo = "manual";
            return response()->json(compact("universo", "universo_id", "extension", "tipo_universo", "formato"));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
