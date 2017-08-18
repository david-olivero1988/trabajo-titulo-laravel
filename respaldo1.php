<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

##Clases agregadas

use Illuminate\Contracts\Auth\Guard;
use App\Models\Proceso;
use App\Models\Universo;
use App\Models\Campania;
use App\Models\Frecuencia;
use App\Models\CicloMes;
use App\Models\CicloAnio;
use App\Models\Intervalo;
use App\Models\Notificacion;
use Carbon\Carbon;

class NotificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       // dd($request);

        $campania=Campania::select('*')->where('campanias.id','=',17)
                                       ->join('intervalos','campanias.intervalo_id','=','intervalos.id')
                                       ->join('frecuencias','campanias.frecuencias_id','=','frecuencias.id')
                                       ->join('universos','campanias.universos_id','=','universos.id')
                                       ->join('procesos','universos.proceso_id','=','procesos.id')
                                      // ->join('ciclo_anios','frecuencias.anual_id','=','ciclo_anios.id')
                                      // ->join('ciclo_mes','frecuencias.mensual_id','=','ciclo_mes.id')
                                       ->firstOrFail(); 

        

            if($campania->tipo_frecuencia==0){


                    $fecha=explode('-',$campania->fecha_inicio);
                    $fecha_envio=Carbon::createFromDate($fecha[0],$fecha[1],$fecha[2]);
                    //dd($fecha_envio->toDateString());
                    if($campania->tipo_intervalo==2){
                       
                        $fecha=explode('-',$campania->fecha_fin);
                        $fecha_fin=Carbon::createFromDate($fecha[0],$fecha[1],$fecha[2]);

                        $repeticiones=$fecha_envio->diffInDays($fecha_fin)/$campania->ciclo_dias_0;
                    }else{
                        if($campania->tipo_intervalo==1)
                        $repeticiones=$campania->repeticiones;
                    }

                for ($i=0; $i < $repeticiones ; $i++) { 
                    $notificacion=new Notificacion;
                    $notificacion->fecha_envio=$fecha_envio->toDateString();
                    $notificacion->campania_id=16;
                    $fecha_envio->addDays($campania->ciclo_dias_0);
                    $notificacion->save();
                    
                }
            }else{
                if($campania->tipo_frecuencia==1){


                    $fecha=explode('-',$campania->fecha_inicio);
                    $fecha_envio=Carbon::createFromDate($fecha[0],$fecha[1],$fecha[2]);
                    //dd($fecha_envio->addDays(1)->toDateString());
                    if($campania->tipo_intervalo==2){
                       
                        $fecha=explode('-',$campania->fecha_fin);
                        $fecha_fin=Carbon::createFromDate($fecha[0],$fecha[1],$fecha[2]);
                        
                        $repeticiones=$fecha_envio->diffInWeeks($fecha_fin)/$campania->ciclo_semanas_1;
                        $repeticiones++;
                        //dd($repeticiones);
                    }else{
                        if($campania->tipo_intervalo==1)
                        $repeticiones=$campania->repeticiones;
                        $fecha_fin=NULL;

                    }

                    $dias_semana=explode(',',$campania->dias_1);              
                    
                    $cont=0;
                    $aux=0;
                    for ($i=0; $i < $repeticiones ; $i++) { 

                    
                        if($fecha_envio->dayOfWeek==Carbon::MONDAY){
                          //  foreach ($dias as $key => $value) {
                            $dias_semana_num = array('lunes' => 0,'martes' => 1, 'miercoles' => 2, 'jueves' => 3, 'viernes' => 4, 'sabado' => 5, 'domingo' => 6);
            
                        }
                        if($fecha_envio->dayOfWeek==Carbon::TUESDAY){
                          //  foreach ($dias as $key => $value) {

                            $dias_semana_num = array('lunes' => 1, 'martes' => 0, 'miercoles' => 1, 'jueves' => 2, 'viernes' => 3, 'sabado' => 4, 'domingo' => 5);
                            //dd();
                            
                        }
                        if($fecha_envio->dayOfWeek==Carbon::WEDNESDAY){
                          
                            $dias_semana_num = array('lunes' => 2,'martes' => 1, 'miercoles' => 0, 'jueves' => 1, 'viernes' => 2, 'sabado' => 3, 'domingo' => 4);
                            
            
                        }
                        if($fecha_envio->dayOfWeek==Carbon::THURSDAY){

                            $dias_semana_num = array('lunes' => 3,'martes' => 2, 'miercoles' => 1, 'jueves' => 0, 'viernes' => 1, 'sabado' => 2, 'domingo' => 3);
                           
                            
                        }
                        if($fecha_envio->dayOfWeek==Carbon::FRIDAY){
                          
                            $dias_semana_num = array('lunes' => 4,'martes' => 3, 'miercoles' => 2, 'jueves' => 1, 'viernes' => 0, 'sabado' => 1, 'domingo' => 2);
            
                        }
                        if($fecha_envio->dayOfWeek==Carbon::SATURDAY){
                       
                            $dias_semana_num = array('lunes' => 5,'martes' => 4, 'miercoles' => 3, 'jueves' => 2, 'viernes' => 1, 'sabado' => 0, 'domingo' => 1);
                            
                        }
                        if($fecha_envio->dayOfWeek==Carbon::SUNDAY){
                       
                            $dias_semana_num = array('lunes' => 6,'martes' => 5, 'miercoles' => 4, 'jueves' => 3, 'viernes' => 2, 'sabado' => 1, 'domingo' => 0);
                            
                        }

                         $dias_semana_num1 = array('lunes' => 1,'martes' => 2, 'miercoles' => 3, 'jueves' => 4, 'viernes' => 5, 'sabado' => 6, 'domingo' => 7);
                        
                        
                        foreach ($dias_semana as $key => $value) {

                                if($value){
                                    $notificacion=new Notificacion;
                                    
                                    
                                    $fecha=explode('-',$campania->fecha_inicio);
                                    $fecha_envio1=Carbon::createFromDate($fecha[0],$fecha[1],$fecha[2]);
                                    

                                    if($fecha_fin){   

                                        $fecha=explode('-',$campania->fecha_inicio);
                                        $fecha_envio2=Carbon::createFromDate($fecha[0],$fecha[1],$fecha[2]);

                                        if($fecha_envio2->addDays($dias_semana_num[$value]+$i*$campania->ciclo_semanas_1*7)->between($fecha_envio1,$fecha_fin)){
                                            

                                            if($i>0){ $fecha_envio1->addWeeks($campania->ciclo_semanas_1*$i); $aux=1;
                                              
                                            }  
                                                
                                            $fecha_dia=$fecha_envio1->dayOfWeek;
                                            if($fecha_dia==0)$fecha_dia=7;
                                            if($fecha_dia<=$dias_semana_num1[$value] || $aux==1 ){
                                               
                                                

                                                if($fecha_dia>$dias_semana_num1[$value] ){
                                                   
                                                    $notificacion->fecha_envio=$fecha_envio1->subDays($dias_semana_num[$value])->toDateString();
                                                }else{

                                                    $notificacion->fecha_envio=$fecha_envio1->addDays($dias_semana_num[$value])->toDateString();
                                                }
                                            
                                            $notificacion->campania_id=17; 
                                         
                                            $notificacion->save();
                                            }
                                          
                                                
                                        }
                                    }else{
                                        $notificacion->fecha_envio=$fecha_envio1->addDays($dias_semana_num[$value]+$i*$campania->ciclo_semanas_1*7)->toDateString();
                                        $notificacion->campania_id=17; 
                                        //dd($notificacion);
                                        $notificacion->save();
                                    }
                                       
                                
                                    
                                }
                                
                            }
                        $cont=$i;
                    
                    }


              }
          } 
            
        
        dd($campania);

        return redirect()->action('CampaniaController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
