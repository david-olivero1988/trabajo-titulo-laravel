<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
## clases agregadas

use App\Models\Proceso;
use App\Models\Universo;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TrazabilidadIndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notificaciones_por_rut = Destinatario::destinatariosAll();
        $universos = Universo::all();
        $procesos = Proceso::all();
        $request = new Request;
        $filtros = "";

        foreach ($notificaciones_por_rut as $key => $value) {
            if ($value->notificaciones_fecha_envio) {
                $fecha_inicio = explode('-', $value->notificaciones_fecha_envio);
                $value->notificaciones_fecha_envio = $fecha_inicio[2] . '-' . $fecha_inicio[1] . '-' . $fecha_inicio[0];
            }

            if ($value->fecha_leido) {
                $fecha_fin = explode('-', $value->fecha_leido);

                $value->fecha_leido = $fecha_fin[2] . '-' . $fecha_fin[1] . '-' . $fecha_fin[0];
            }
        }

        return view('trazabilidad.listado_individual', compact('notificaciones_por_rut', 'universos', 'procesos', 'request', 'render', 'filtros'));
    }

    public function filtro(Request $request)
    {
        //dd($request);
        $condicion = $this->condicion($request);
        $notificaciones_por_rut_query = Destinatario::destinatariosPorFiltros($condicion);
        //dd($notificaciones_por_rut_query);
        $notificaciones_por_rut_collection = collect($notificaciones_por_rut_query);
        $notificaciones_por_rut = $this->paginate($notificaciones_por_rut_collection);

        $path = "/ADNLaravel/public/filtro_listado_individual?" . $_SERVER['QUERY_STRING'];
        $notificaciones_por_rut->setPath($path);

        $universos = Universo::all();
        $procesos = Proceso::all();
        $render = true;
        $filtros = "?" . $_SERVER['QUERY_STRING'];
        //dd($filtros);
        return view('trazabilidad.listado_individual', compact('notificaciones_por_rut', 'universos', 'procesos', 'request', 'render', 'filtros'));

    }

    public function exportar(Request $request)
    {
        //dd($request);
        $condicion = $this->condicion($request);
        // dd("pasa");
        $notificaciones_por_rut_query = Destinatario::destinatariosPorFiltros($condicion);
        // dd($notificaciones_por_rut_query);

        foreach ($notificaciones_por_rut_query as $key => $value) {
            if ($value->destinatarios_fecha_envio) {
                $fecha_inicio = explode('-', $value->destinatarios_fecha_envio);
                $value->destinatarios_fecha_envio = $fecha_inicio[2] . '-' . $fecha_inicio[1] . '-' . $fecha_inicio[0];
            }

            if ($value->fecha_leido) {
                $fecha_fin = explode('-', $value->fecha_leido);

                $value->fecha_leido = $fecha_fin[2] . '-' . $fecha_fin[1] . '-' . $fecha_fin[0];
            }
        }

        foreach ($notificaciones_por_rut_query as $key => $value) {

            $listado_campanias_excel[$key]['RUT'] = $value->rut_beneficiario;
            $listado_campanias_excel[$key]['Nombres'] = $value->nombres;
            $listado_campanias_excel[$key]['Apellidos'] = $value->apellidos;
            $listado_campanias_excel[$key]['ID Fono'] = $value->device_id;
            $listado_campanias_excel[$key]['SO'] = $value->so;
            $listado_campanias_excel[$key]['Versión SO'] = $value->version;
            $listado_campanias_excel[$key]['ID Campaña'] = $value->campania_id;
            $listado_campanias_excel[$key]['Nombre Campaña'] = $value->asunto;
            $listado_campanias_excel[$key]['ID Notificación'] = $value->notificaciones_id;
            $listado_campanias_excel[$key]['Asunto'] = $value->asunto;
            $listado_campanias_excel[$key]['Universo'] = $value->nombre_universo;
            $listado_campanias_excel[$key]['Enviado'] = $value->enviado;
            $listado_campanias_excel[$key]['Fecha Envio'] = $value->destinatarios_fecha_envio;
            $listado_campanias_excel[$key]['Apertura'] = $value->leido;
            $listado_campanias_excel[$key]['Fecha Apertura'] = $value->fecha_leido;
        }
        // dd($listado_campanias_excel);
        Excel::create('Reporte individual de Notificaciones', function ($excel) use ($listado_campanias_excel) {
            $excel->sheet('Sheet 1', function ($sheet) use ($listado_campanias_excel) {

                $sheet->cells('A1:O1', function ($cells) {

                    $cells->setBackground('#cccccc');
                    $cells->setFontcolor('#000');
                    $cells->setAlignment('center');
                    $cells->setValignment('middler');

                });

                $sheet->fromArray($listado_campanias_excel);
            });

        })->export('xls');
    }

    protected function condicion($request)
    {
        $condicion = "0=0";

        if (is_numeric($request->rut)) {
            if ($request->rut) {
                $condicion .= " and d.rut_beneficiario = " . $request->rut;
            }
        }

        if (is_numeric($request->notificacion_id)) {
            if ($request->notificacion_id) {
                $condicion .= " and n.id = " . $request->notificacion_id;
            }
        }

        if ($request->asunto) {
            $condicion .= " and c.asunto = '" . $request->asunto . "'";
        }

        if ($request->universo) {
            $condicion .= " and u.nombre_universo ='" . $request->universo . "'";
        }

        if ($request->proceso) {
            $condicion .= " and p.proceso ='" . $request->proceso . "'";
        }

        if ($request->tipo_campania) {
            $condicion .= " and c.tipo_campania='" . $request->tipo_campania . "'";
        }

        if ($request->fecha_desde) {
            $condicion .= " and fecha_envio >='" . $request->fecha_desde . "'";
        }

        if ($request->fecha_hasta) {
            $condicion .= " and fecha_envio <='" . $request->fecha_hasta . "'";
        }

        // dd($condicion);
        return $condicion;
    }

    protected function paginate($items, $perPage = 17)
    {

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage);

        return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    }
}
