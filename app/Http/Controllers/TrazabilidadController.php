<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Notificacion;
use App\Models\Destinatario;
use App\Models\Campania;
use App\Models\Universo;
use App\Models\Proceso;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Excel;
use Laracasts\Flash\Flash;


class TrazabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*++++++++++++++++++++++++++++++inicio función pública index+++++++++++++++++++++++++*/
    public function index()
    {


        $notificaciones=Notificacion::retornaNotificacion();

        //dd($notificaciones[0]);
        foreach ($notificaciones as $key => $value) 
        {
            $totales[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->count();

            //dd($totales[$key]);
            $reales[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->where('enviado','SI')->count();
            //dd($reales[$key]);

            $lecturas[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->where('leido','SI')->count();
            //dd($lecturas[$key]);
        }
        $universos=Universo::all();
        $procesos=Proceso::all();
        //dd($universos);
        $render=false;
        $request=new Request;
       // dd($notificaciones);
        foreach ($notificaciones as $key => $value)
        {
            if($value->fecha_envio)
            {
               $fecha_inicio=explode('-',$value->fecha_envio);
                $value->fecha_envio=$fecha_inicio[2].'-'.$fecha_inicio[1].'-'.$fecha_inicio[0]; 
            }
            
        }
      
        return view('trazabilidad.listado_notificaciones',compact('notificaciones','totales','reales','lecturas','universos','procesos','render','request'));
    }
/*++++++++++++++++++++++++++++++fin función pública index+++++++++++++++++++++++++*/



/*++++++++++++++++++++++++++++++inicio función pública detalle+++++++++++++++++++++++++*/
    public function detalle($id)
    {
        
        
        $fecha=Notificacion::notificacionesPorId($id);      
        //dd($fecha);
        $campania=Campania::campania_por_id($fecha);
            if($fecha->fecha_hora_envio)
            {
                $fecha_envio=explode('-',$fecha->fecha_hora_envio);
               // dd($fecha_envio);
                $hora=explode(' ',$fecha_envio[2]);
                $fecha->fecha_hora_envio=$hora[0].'-'.$fecha_envio[1].'-'.$fecha_envio[0].' '.$hora[1];
            }
        
            if($campania->fecha_inicio)
            {
               $fecha_inicio=explode('-',$campania->fecha_inicio);
                $campania->fecha_inicio=$fecha_inicio[2].'-'.$fecha_inicio[1].'-'.$fecha_inicio[0]; 
            }

             if($campania->fecha_fin)
            {
                 $fecha_fin=explode('-',$campania->fecha_fin);
                
                $campania->fecha_fin=$fecha_fin[2].'-'.$fecha_fin[1].'-'.$fecha_fin[0];
            }   
            
        


       
        $frecuencia=$this->frecuencia($campania->tipo_frecuencia);
        
        return view('trazabilidad.detalle',compact('campania','frecuencia','fecha'));
    }

/*++++++++++++++++++++++++++++++fin función pública detalle+++++++++++++++++++++++++*/





/*++++++++++++++++++++++++++++++inicio función pública filtro+++++++++++++++++++++++++*/
    public function filtro(Request $request)
    {
        

        
        $condicion=$this->condicion($request);

        $notificaciones_query=Notificacion::queryNotificaciones($condicion,$request);

        $notificaciones_colleccion=collect($notificaciones_query);
        $notificaciones= $this->paginate($notificaciones_colleccion);
         
        $path="/ADNLaravel/public/filtro_listado_notificaciones?".$_SERVER['QUERY_STRING'];
        
        $notificaciones->setPath($path);

        foreach ($notificaciones as $key => $value) 
        {
            $totales[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->count();
            $reales[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->where('enviado','SI')->count();

            $lecturas[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->where('leido','SI')->count();
        }
        $universos=Universo::all();
        $procesos=Proceso::all();
        $render=true;
        
        return view('trazabilidad.listado_notificaciones',compact('notificaciones','totales','reales','lecturas','universos','procesos','render','request'));        


    }

    /*++++++++++++++++++++++++++++++fin función pública filtro+++++++++++++++++++++++++*/

    /*++++++++++++++++++++++++++++++inicio función pública exportar+++++++++++++++++++++++++*/

    public function exportar(Request $request)
    {
        //dd($request);
        

        $condicion= $this->condicionExportar($request);
        //dd($condicion);
        $notificaciones=Notificacion::queryNotificacionesExportar($condicion,$request);
        //dd($notificaciones);
       /* $totales=array();
        $reales=array();
        $lecturas=array();
        if ($notificaciones)
        {
            foreach ($notificaciones as $key => $value) 
            {
                $totales[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->count();
                $reales[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->where('enviado','SI')->count();

                $lecturas[$key]=Destinatario::where('notificacion_id',$value->notificaciones_id)->where('leido','SI')->count();
            }

        }*/
         
        $listado_notificaciones_excel=$this->creaArregloExcel($notificaciones);

         //dd($listado_campanias_excel);
        if($request->detalle)
            $nombre='Reporte de Notificaciones';
        else
            $nombre='Reporte General de Notificaciones';
        Excel::create($nombre, function($excel) use($listado_notificaciones_excel){
            $excel->sheet('Sheet 1', function($sheet) use($listado_notificaciones_excel){

                $sheet->cells('A1:N1',function($cells){

                    $cells->setBackground('#cccccc');
                    $cells->setFontcolor('#000');
                    $cells->setAlignment('center');                    
                    $cells->setValignment('middler');
                   
                });

                $sheet->fromArray($listado_notificaciones_excel);    
            });
            

        })->export('xls');

    }

    /*++++++++++++++++++++++++++++++fin función pública exportar+++++++++++++++++++++++++*/

    /*++++++++++++++++++++++++++++++inicio funciones auxiliares+++++++++++++++++++++++++*/

    protected function condicionExportar($request)
    {   
        $condicion= "0=1";
        if($request->check_notificaciones_id)
        foreach ($request->check_notificaciones_id as $key => $value)
        {
            $condicion.=" or n.id =".$value;
        }
        return $condicion;
    }

    protected function creaArregloExcel($notificaciones)
    {
    //dd($notificaciones);
        if($notificaciones)
        {
            foreach ($notificaciones as $key => $value)
                {
                    if($value->destinatarios_fecha_envio)
                    {
                       $fecha_inicio=explode('-',$value->destinatarios_fecha_envio);
                        $value->destinatarios_fecha_envio=$fecha_inicio[2].'-'.$fecha_inicio[1].'-'.$fecha_inicio[0]; 
                    }

                    if($value->fecha_leido)
                        {
                             $fecha_fin=explode('-',$value->fecha_leido);
                            
                            $value->fecha_leido=$fecha_fin[2].'-'.$fecha_fin[1].'-'.$fecha_fin[0];
                        }  
                    
                }
            foreach ($notificaciones as $key => $value)
             {
                           
                 $listado_notificaciones_excel[$key]['RUT']=$value->rut_beneficiario;
                 $listado_notificaciones_excel[$key]['Nombres']=$value->nombres;
                 $listado_notificaciones_excel[$key]['Apellidos']=$value->apellidos;
                 $listado_notificaciones_excel[$key]['ID Fono']=$value->device_id;
                 $listado_notificaciones_excel[$key]['SO']=$value->so;
                 $listado_notificaciones_excel[$key]['Versión']=$value->version;
                 $listado_notificaciones_excel[$key]['ID Campaña']=$value->campania_id;
                 $listado_notificaciones_excel[$key]['ID Notificación']=$value->notificacion_id;
                 $listado_notificaciones_excel[$key]['Asunto']=$value->asunto;
                 $listado_notificaciones_excel[$key]['Universo']=$value->nombre_universo;
                 $listado_notificaciones_excel[$key]['Enviado']=$value->enviado;
                 $listado_notificaciones_excel[$key]['Fecha de envio']=$value->destinatarios_fecha_envio;
                 $listado_notificaciones_excel[$key]['Apertura']=$value->leido;
                 $listado_notificaciones_excel[$key]['Fecha de apertura']=$value->fecha_leido;
             }
        }else
        {
            $listado_notificaciones_excel[0]['RUT']="";
             $listado_notificaciones_excel[0]['Nombres']="";
             $listado_notificaciones_excel[0]['Apellidos']="";
             $listado_notificaciones_excel[0]['ID Fono']="";
             $listado_notificaciones_excel[0]['SO']="";
            $listado_notificaciones_excel[0]['Versión']="";
             $listado_notificaciones_excel[0]['ID Campaña']="";
             $listado_notificaciones_excel[0]['ID Notificación']="";
             $listado_notificaciones_excel[0]['Asunto']="";
             $listado_notificaciones_excel[0]['Universo']="";
             $listado_notificaciones_excel[0]['Enviado']="";
             $listado_notificaciones_excel[0]['Fecha de envio']="";
             $listado_notificaciones_excel[0]['Apertura']="";
             $listado_notificaciones_excel[0]['Fecha de apertura']="";
        }
        return $listado_notificaciones_excel;
    }

    protected function condicion($request)
    {
        $condicion = "0=0";
        if(is_numeric($request->notificacion_id))
        if($request->notificacion_id)
            $condicion.=" and n.id = ".$request->notificacion_id; 
        if($request->asunto)
            $condicion.=" and c.asunto ilike '%".$request->asunto."%'";
        if($request->universo)
            $condicion.=" and u.nombre_universo ='".$request->universo."'";
        if($request->proceso)
            $condicion.=" and p.proceso ='".$request->proceso."'";
        if($request->tipo_campania)
            $condicion.=" and c.tipo_campania='".$request->tipo_campania."'";
        if($request->fecha_desde)
            $condicion.=" and fecha_envio >='".$request->fecha_desde."'";
        if($request->fecha_hasta)
           $condicion.=" and fecha_envio <='".$request->fecha_hasta."'";
      // dd($condicion);
        return $condicion;
    }

    protected function paginate($items, $perPage = 17)
    {

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage);
        
        return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    }

    protected function frecuencia($frecuencia)
    {
        switch($frecuencia)
        {
            case 0:
                return "Diario";
            case 1:
                return "Semanal";
            case 2:
                return "Mensual";
            case 3:
                return "Anual";
        }
    }

    /*++++++++++++++++++++++++++++++fin funciones auxiliares+++++++++++++++++++++++++*/

    





}
