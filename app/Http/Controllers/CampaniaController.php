<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

##librerias agregadas
use Illuminate\Support\Facades\DB;
use Excel;
use Auth; 
use Illuminate\Contracts\Auth\Guard;
use App\Models\Proceso;
use App\Models\Universo;
use App\Models\Campania;
use App\Models\Frecuencia;
use App\Models\CicloMes;
use App\Models\CicloAnio;
use App\Models\Intervalo;
use App\Models\Notificacion;
use App\Models\Calendario;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Laracasts\Flash\Flash;

class CampaniaController extends Controller
{
    
     public function __construct()
    {   
        //dd(Auth::check());
       // dd(Auth::user());
        //dd($this->auth);
        //dd($auth);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
    
        	$universos=Universo::where('proceso_id','=',$request->get('dato'))->get();
          //dd($universos);
        	return compact('universos');
        }
        
       
        $campanias = Campania::campanias();

          $procesos = Proceso::all();
         
          $filtros="?dato=dato";
         
          

          //dd($request->actualizacion);
          
        
        return view('campanias.listado_campanias',compact('campanias','procesos','filtros','request'));
        
    }

     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $datos_campania=$request;
      
        
        if($datos_campania->tipo_campania=="manual")
        {
            $datos_campania->proceso="Sin proceso";
            if(!$datos_campania->proceso || !$datos_campania->asunto || !$datos_campania->comentario || !$datos_campania->tipo_campania)
            {
             // dd("entra");
                flash('Error! Existen parámetros obligatorios vacios.', 'danger');
                return redirect()->back();
            }
        }else
        if(!$datos_campania->proceso || !$datos_campania->asunto || !$datos_campania->comentario || !$datos_campania->tipo_campania  || !$datos_campania->universo)
          {
           // dd("entra");
              flash('Error! Existen parámetros obligatorios vacios.', 'danger');
              return redirect()->back();
          }
      //dd("no paso");
        $nueva_campania= new Campania;
        $nuevo_intervalo=new Intervalo;
        $frecuencia=new Frecuencia;

     #########################    intervalo   ##########################

        if($datos_campania->tipo_intervalo=="sin_fecha"){
                      
            $nuevo_intervalo->tipo_intervalo=0;
            $nuevo_intervalo->fecha_inicio=$datos_campania->fecha_inicio;
            $nuevo_intervalo->save();
        }
        if($datos_campania->tipo_intervalo=="finaliza_despues_de"){

            $nuevo_intervalo->tipo_intervalo=1;
            $nuevo_intervalo->fecha_inicio=$datos_campania->fecha_inicio;
            $nuevo_intervalo->repeticiones=$datos_campania->finaliza_despues_de;
            $nuevo_intervalo->save();
        }
        if($datos_campania->tipo_intervalo=="finaliza_el"){

            $nuevo_intervalo->tipo_intervalo=2;
            $nuevo_intervalo->fecha_inicio=$datos_campania->fecha_inicio;
            $nuevo_intervalo->fecha_fin=$datos_campania->finaliza_el;
            $nuevo_intervalo->save();
        }
#########################    frecuencia    ##########################

#########################    ciclo anual    ##########################

        if($datos_campania->frecuencia=="por_anio"){

            
            $ciclo_anio=new CicloAnio;

            $ciclo_anio->ciclos_anios=$datos_campania->por_anio[0];

            if($datos_campania->por_anio[1]=="por_anio_dia_mes"){

                $ciclo_anio->tipo_ciclo_anio=0;
                $ciclo_anio->repetir_el_0=$datos_campania->por_anio_dia_mes[0];
                $ciclo_anio->del_mes_0=$datos_campania->por_anio_dia_mes[1] ;
            }else{
               
                $ciclo_anio->tipo_ciclo_anio=1;
                $ciclo_anio->repetir_el_1=$datos_campania->por_anio_dia_semana_mes[0];
                $ciclo_anio->dia_1=$datos_campania->por_anio_dia_semana_mes[1];
                $ciclo_anio->mes_1=$datos_campania->por_anio_dia_semana_mes[2];
            }

            $ciclo_anio->save();
            $frecuencia->anual_id=$ciclo_anio->id;
            $frecuencia->tipo_frecuencia=3;
            $frecuencia->save();
           
        }

#########################    ciclo mensual    ##########################

        if($datos_campania->frecuencia=="por_mes"){

            
            $ciclo_mes=new CicloMes;

            if($datos_campania->por_mes[0]=="dia_del_mes"){
                
                $ciclo_mes->tipo_ciclo_mes=0;
                $ciclo_mes->repetir_dia_0=$datos_campania->dia_del_mes[0];
                $ciclo_mes->por_meses_0=$datos_campania->dia_del_mes[1];
                
                
                
            }else{
                $ciclo_mes->tipo_ciclo_mes=1;
                $ciclo_mes->repetir_el_1=$datos_campania->dia_semana_mes[0];
                $ciclo_mes->dia_1=$datos_campania->dia_semana_mes[1];
                $ciclo_mes->por_1=$datos_campania->dia_semana_mes[2];

                
                
            }

            $ciclo_mes->save();
            $frecuencia->mensual_id=$ciclo_mes->id;
            $frecuencia->tipo_frecuencia=2;
            $frecuencia->save();
         
        }

#########################    ciclo semanal    ##########################

        if($datos_campania->frecuencia=="por_semana"){
            
            

            $frecuencia->tipo_frecuencia=1;
            $frecuencia->ciclo_semanas_1=$datos_campania->por_semana[0];

            $dias_totales="";

            foreach ($datos_campania->por_semana as $key => $value) {
                if ($key>0) {

                    $dias=$value;
                    $dias_totales=$dias_totales.",".$dias;
                    
                }               
            }
           
                    
            $frecuencia->dias_1=$dias_totales;
            $frecuencia->save();
            
        }

#########################    ciclo diario    ##########################

        if($datos_campania->frecuencia=="por_dia"){

            

            $frecuencia->tipo_frecuencia=0;
            $frecuencia->ciclo_dias_0=$datos_campania->por_dia[0];
            $frecuencia->save();
         


        }

#########################    llenando campañas    ##########################

        $nueva_campania->asunto=$datos_campania->asunto;
        $nueva_campania->mensaje=$datos_campania->comentario;
        $nueva_campania->tipo_campania=$datos_campania->tipo_campania;
        $nueva_campania->estado="activado";
        
        $nueva_campania->frecuencias_id=$frecuencia->id;
        $nueva_campania->intervalo_id=$nuevo_intervalo->id;
         if($datos_campania->tipo_campania=="manual")
        {
          $universo_manual=Universo::find($datos_campania->universo_id);
          $universo_manual->descripcion=$request->descripcion_manual;
          $nueva_campania->universos_id=$universo_manual->id;
          $universo_manual->save();
        }else
         $nueva_campania->universos_id=$datos_campania->universo;


        $nueva_campania->save();
        $campania_id=$nueva_campania;
        $tipo_frecuencia=$frecuencia->tipo_frecuencia;
        $editar=false;
        
        return redirect()->action("NotificacionesController@index",compact("campania_id","tipo_frecuencia","editar"));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $campania=Campania::verCampania($id);

          
          $fecha_inicio=explode('-',$campania->fecha_inicio);
          //$fecha_fin=explode('-',$campania->fecha_fin);
          $campania->fecha_inicio=$fecha_inicio[2].'-'.$fecha_inicio[1].'-'.$fecha_inicio[0];
          if($campania->fecha_fin)
          {
            $fecha_fin=explode('-',$campania->fecha_fin);
            $campania->fecha_fin=$fecha_fin[2].'-'.$fecha_fin[1].'-'.$fecha_fin[0];
           // dd($campania);
          }
          
        //  dd($campania);

        $dias_1=explode(',',$campania->dias_1);
        if ($campania->anual_id) {
          $ciclo=CicloAnio::find($campania->anual_id);
        
          return view('campanias.ver_campania',compact('campania','dias_1','ciclo'));
        }else{
          if($campania->mensual_id){
            $ciclo=CicloMes::find($campania->mensual_id);
         
          return view('campanias.ver_campania',compact('campania','dias_1','ciclo'));

          }else{
            return view('campanias.ver_campania',compact('campania','dias_1'));
          }

          
        }
     
        
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_campania=Campania::editarCampania($id);

      
        $campania=Campania::campania_por_id($edit_campania);
        //if($campania->dias_1)        
          $dias=explode(',',$campania->dias_1);
          $fecha_inicio=explode('-',$campania->fecha_inicio);
          $campania->fecha_inicio=$fecha_inicio[2].'-'.$fecha_inicio[1].'-'.$fecha_inicio[0];

          if($campania->fecha_fin)
          {
            $fecha_fin=explode('-',$campania->fecha_fin);
            $campania->fecha_fin=$fecha_fin[2].'-'.$fecha_fin[1].'-'.$fecha_fin[0];
          }
        
        //dd($campania);
        return view('campanias.editar_campania',compact('campania','dias'));
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
        dd($request);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd();
    }

    public function filtro(Request $request){
        
        
        $id_campania= $request->get("id_campania");
        $asunto=  $request->get("asunto");
        $proceso= $request->get("proceso");
        $estado= $request->get("estado");

           $filtros="?";
        if ($id_campania) {
          $filtros.="id_campania=".$id_campania."&";
        }
        if ($asunto) {
          $filtros.="asunto=".$asunto."&";
        }
        if ($proceso) {
          $filtros.="proceso=".$proceso."&";
        }
        if ($estado) {
          $filtros.="estado=".$estado."&";
        }
          $filtros1=$filtros;
          $filtros.="dato=dato";



        $campanias_query = $this->query($id_campania,$asunto,$proceso,$estado);
          
        $campanias_colleccion=collect($campanias_query);
        
        $campanias= $this->paginate($campanias_colleccion);
        $path="/ADNLaravel/public/filtro".$filtros1;
        
        $campanias->setPath($path);
       
        
        $procesos = Proceso::all();
        return view('campanias.listado_campanias',compact('campanias','procesos','filtros','request'));

    }

    protected function paginate($items, $perPage = 17)
    {

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage);
        
        return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    }

    protected function query($id_campania, $asunto, $proceso, $estado){

      $condicion = " 0=0";
      if(is_numeric($id_campania))
      if($id_campania != ""){
        $condicion.= " and c.id = '".$id_campania."'";
      }
      if($asunto != ""){
        $condicion.= " and asunto ilike '%".$asunto."%'";
      }
      if($proceso != ""){
        $condicion .= " and proceso = '".$proceso."'";
      }
      if($estado != ""){
        $condicion .= " and estado = '".$estado."'";
      }
      //dd($condicion);
      $q="select  c.asunto,
                  c.id,
                  c.mensaje,
                  c.tipo_campania,
                  c.estado,
                  u.nombre_universo,
                  u.descripcion,
                  p.proceso from campanias c 
          inner join universos u on (c.universos_id = u.id)
          inner join procesos p on(u.proceso_id = p.id)
          where ".$condicion." order by c.id";
      $campanias = DB::select($q);
      return $campanias;
    }

    public function getExcel(Request $request){

        $id_campania= $request->get("id_campania");
        $asunto=  $request->get("asunto");
        $proceso= $request->get("proceso");
        $estado= $request->get("estado");
//dd($request);
        $campanias_query = $this->query($id_campania,$asunto,$proceso,$estado);
                
         
         foreach ($campanias_query as $key => $value)
         {
            
             $listado_campanias_excel[$key]['Id Campañas']=$value->id;
             $listado_campanias_excel[$key]['Asunto']=$value->asunto;
             $listado_campanias_excel[$key]['Proceso']=$value->proceso;
             $listado_campanias_excel[$key]['Universo']=$value->nombre_universo;
             $listado_campanias_excel[$key]['Estado']=$value->estado;
         }

        

        Excel::create('Listado de campañas', function($excel) use($listado_campanias_excel){
            $excel->sheet('Sheet 1', function($sheet) use($listado_campanias_excel){

                $sheet->cells('A1:E1',function($cells){

                    $cells->setBackground('#cccccc');
                    $cells->setFontcolor('#000');
                    $cells->setAlignment('center');                    
                    $cells->setValignment('middler');
                   
                });

                $sheet->fromArray($listado_campanias_excel);    
            });
            

        })->export('xls');
    }
    public function eliminar(Request $request){


          
          $campania=Campania::verCampania($request->id);
         

          if ($request->estado=="activado")
          {
              $campania->estado='desactivado';
              $campania->save();
              
              return 'desactivado';
          }

          if ($request->estado=="activado")
          {                    
            
              $campania->estado='activado';
              $campania->save();
              
              return 'activado'; 
          }

          $calendario=Calendario::where('campania_id','=',$request->id)->get();
          foreach ($calendario as $key => $value)
          {
            $value->delete();
          }

          $campania->estado='eliminado';
          $campania->save();

          return 'eliminado';
    }


    public function estado(Request $request){
     
      if($request->ajax()){

        $id=$request->only('id','estado');


        if ($id['estado']=="detener_todo") {
          $detener_todo=Campania::all();
        

            foreach ($detener_todo as $key => $value) {
              $value->estado='desactivado';
              $value->save();
            }
           
            
            return 0;
        }else{              
        

          $campania=Campania::find($id['id']);

          if ($id['estado']=="activado") {
              $campania->estado='desactivado';
              $campania->save();
              
              return 'desactivado';
          }else{                    
            
              $campania->estado='activado';
              $campania->save();
              
              return 'activado';          
                       
          }
        }
      }



    }
    public function editar(Request $request,$id){


       
       
        $update_campania=Campania::find($id);
       
        $frecuencia=Frecuencia::find($update_campania->frecuencias_id);

        $update_intervalo=Intervalo::find($update_campania->intervalo_id);                                   
        
        $datos_campania=$request;
        



#########################    intervalo   ##########################

        if($datos_campania->tipo_intervalo=="sin_fecha"){

            $update_intervalo->tipo_intervalo=0;
            $update_intervalo->fecha_inicio=$datos_campania->fecha_inicio;
            $update_intervalo->repeticiones=NULL;
            $update_intervalo->fecha_fin=NULL;
            $update_intervalo->save();
        }
        if($datos_campania->tipo_intervalo=="finaliza_despues_de"){

            $update_intervalo->tipo_intervalo=1;
            $update_intervalo->fecha_inicio=$datos_campania->fecha_inicio;
            $update_intervalo->repeticiones=$datos_campania->finaliza_despues_de;
            $update_intervalo->fecha_fin=NULL;
            $update_intervalo->save();
        }
        if($datos_campania->tipo_intervalo=="finaliza_el"){

            $update_intervalo->tipo_intervalo=2;
            $update_intervalo->fecha_inicio=$datos_campania->fecha_inicio;
            $update_intervalo->fecha_fin=$datos_campania->finaliza_el;
            $update_intervalo->repeticiones=NULL;
            $update_intervalo->save();
        }
 #########################    frecuencia    ##########################

#########################    ciclo anual    ##########################

        if($datos_campania->frecuencia=="por_anio"){

          if($frecuencia->tipo_frecuencia==3){
            $ciclo_anio=CicloAnio::find($frecuencia->anual_id);
          }else{
            $ciclo_anio=new CicloAnio;
            if($frecuencia->tipo_frecuencia==2){
              $ciclo_mes=CicloMes::find($frecuencia->mensual_id);
              $frecuencia->mensual_id=NULL;
              $frecuencia->save();
              $ciclo_mes->delete();
           
            }else{
              if($frecuencia->tipo_frecuencia==1){
                $frecuencia->ciclo_semanas_1=NULL;
                $frecuencia->dias_1=NULL;
            }else{
              
                $frecuencia->ciclo_dias_0=NULL;
            }
          }
        }
        

            $ciclo_anio->ciclos_anios=$datos_campania->por_anio[0];

            if($datos_campania->por_anio[1]=="por_anio_dia_mes"){

                $ciclo_anio->tipo_ciclo_anio=0;
                $ciclo_anio->repetir_el_0=$datos_campania->por_anio_dia_mes[0];
                $ciclo_anio->del_mes_0=$datos_campania->por_anio_dia_mes[1];

                $ciclo_anio->repetir_el_1=NULL;
                $ciclo_anio->dia_1=NULL;
                $ciclo_anio->mes_1=NULL;

            }else{
           
                $ciclo_anio->tipo_ciclo_anio=1;
                $ciclo_anio->repetir_el_1=$datos_campania->por_anio_dia_semana_mes[0];
                $ciclo_anio->dia_1=$datos_campania->por_anio_dia_semana_mes[1];
                $ciclo_anio->mes_1=$datos_campania->por_anio_dia_semana_mes[2];

                $ciclo_anio->repetir_el_0=NULL;
                $ciclo_anio->del_mes_0=NULL;
            }

            $ciclo_anio->save();
            $frecuencia->anual_id=$ciclo_anio->id;
            $frecuencia->tipo_frecuencia=3;
            $frecuencia->save();
       

        }

#########################    ciclo mensual    ##########################

        if($datos_campania->frecuencia=="por_mes"){

                      

            if($frecuencia->tipo_frecuencia==2){
              $ciclo_mes=CicloMes::find($frecuencia->mensual_id);
            }else{
                $ciclo_mes=new CicloMes;
                if($frecuencia->tipo_frecuencia==3){
                  $ciclo_anio=CicloAnio::find($frecuencia->anual_id);
                  $frecuencia->anual_id=NULL;
                  $frecuencia->save();
                  $ciclo_anio->delete();
                
                }else{
                  if($frecuencia->tipo_frecuencia==1){
                    $frecuencia->ciclo_semanas_1=NULL;
                    $frecuencia->dias_1=NULL;
                }else{
                    $frecuenca->ciclo_dias_0=NULL;
                }
              }
            }

            if($datos_campania->por_mes[0]=="dia_del_mes"){
             
                $ciclo_mes->tipo_ciclo_mes=0;
                $ciclo_mes->repetir_dia_0=$datos_campania->dia_del_mes[0];
                $ciclo_mes->por_meses_0=$datos_campania->dia_del_mes[1];
                
                $ciclo_mes->repetir_el_1=NULL;
                $ciclo_mes->dia_1=NULL;
                $ciclo_mes->por_1=NULL;
                
                
            }else{
                $ciclo_mes->tipo_ciclo_mes=1;
                $ciclo_mes->repetir_el_1=$datos_campania->dia_semana_mes[0];
                $ciclo_mes->dia_1=$datos_campania->dia_semana_mes[1];
                $ciclo_mes->por_1=$datos_campania->dia_semana_mes[2];

                $ciclo_mes->repetir_dia_0=NULL;
                $ciclo_mes->por_meses_0=NULL;

                
                
            }

            $ciclo_mes->save();
            $frecuencia->mensual_id=$ciclo_mes->id;
            $frecuencia->tipo_frecuencia=2;
            $frecuencia->save();
           
        }


#########################    ciclo semanal    ##########################

        if($datos_campania->frecuencia=="por_semana"){
            
             if($frecuencia->tipo_frecuencia==2){
                $ciclo_mes=CicloMes::find($frecuencia->mensual_id);
                $frecuencia->mensual_id=NULL;
                $frecuencia->save();
                $ciclo_mes->delete();
              }else{
              if($frecuencia->tipo_frecuencia==3){
                $ciclo_anio=CicloAnio::find($frecuencia->anual_id);
                $frecuencia->anual_id=NULL;
                $frecuencia->save();
                //dd($frecuencia->id);
                $ciclo_anio->delete();
              }else{
                $frecuencia->ciclo_dias_0=NULL;
              }
            }

            $frecuencia->tipo_frecuencia=1;
            $frecuencia->ciclo_semanas_1=$datos_campania->por_semana[0];

            $dias_totales="";
            
            foreach ($datos_campania->por_semana as $key => $value) {
                if ($key>0) {

                    $dias=$value;
                    $dias_totales=$dias_totales.",".$dias;
                    
                }               
            }
           
                    
            $frecuencia->dias_1=$dias_totales;
            $frecuencia->save();
        
        }

#########################    ciclo diario    ##########################

        if($datos_campania->frecuencia=="por_dia"){

            if($frecuencia->tipo_frecuencia==2){
                $ciclo_mes=CicloMes::find($frecuencia->mensual_id);
                $frecuencia->mensual_id=NULL;
                $frecuencia->save();
                $ciclo_mes->delete();
              }else{
              if($frecuencia->tipo_frecuencia==3){
                $ciclo_anio=CicloAnio::find($frecuencia->anual_id);
                $frecuencia->anual_id=NULL;
                $frecuencia->save();
                //dd($frecuencia->id);
                $ciclo_anio->delete();
              }else{
                $frecuencia->dias_1=NULL;
                $frecuencia->ciclo_semanas_1=NULL;
              }
            }
            

            $frecuencia->tipo_frecuencia=0;
            $frecuencia->ciclo_dias_0=$datos_campania->por_dia[0];
            $frecuencia->save();
          


        }

        if($request->descripcion_manual)
        {

          $universo_manual=Universo::find($request->universo_id);
          $universo_manual->descripcion=$request->descripcion_manual;
          $universo_manual->save();
        }

        


        $campania_id=$id;
        $tipo_frecuencia=$frecuencia->tipo_frecuencia;
        $editar=true;
       
        return redirect()->action("NotificacionesController@index",compact("campania_id","tipo_frecuencia","editar"));

    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $procesos=Proceso::all();
      
        return view('campanias.nueva_campania',compact('procesos','universos'));
    }

}
