<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut');
            $table->char('dv',1);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('rol_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rol_id')
                  ->references('id')
                  ->on('rol_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}



####respaldo envio notificacion


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\CumpleCondicion;
use App\Models\Notificacion;
use App\Models\Destinatario;
use App\Models\Calendario;
use App\Models\Campania;
use App\Models\ConfCampania;
use Carbon\Carbon;
use Excel;
######FCM
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class EnvioNotificacionController extends Controller
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
    public function index()
    {
       
      //$fecha_actual=Carbon::now();
      $fecha_actual= Carbon::create(2017,03,24);
      $id_aux=0;

/*++++++++++++++++++++inicio automatica+++++++++++++++++++++++++++*/

      ###consulta que añade beneficiarios con valor 1 y que les toque notificar en la fecha actual
      $calendario_condicion=Calendario::retornaNotificaciones($fecha_actual);
     // dd($calendario_condicion);
      ###guarda notificaciones y destinatarios en base de datos
      $this->guardaNotificacionesDestinatarios($id_aux,$calendario_condicion,$fecha_actual);
//dd("guardadas");
/*++++++++++++++++++++fin automatica+++++++++++++++++++++++++++*/



/*++++++++++++++++++++inicio manual+++++++++++++++++++++++++++*/

     ##guarda notificaciones y los destinatarios de las campañas manuales
      $this->guardaNotificacionesDestinatariosManual($fecha_actual);

/*++++++++++++++++++++fin manual+++++++++++++++++++++++++++*/



      
      return "notificaciones guardadas";
    }

    protected function guardaNotificacionesDestinatarios($id_aux,$calendario_condicion,$fecha_actual)
    {
     
      foreach ($calendario_condicion as $key => $value)
       {
          if($id_aux!=$value->id_calendario)
          {
            $notificacion = new Notificacion;
                        $notificacion->campania_id = $value->campania_id;
                        $notificacion->fecha_envio = $fecha_actual->toDateString();
                        $notificacion->notificacion_enviada='NO'; 
                        $notificacion->save();
                        $id_aux=$value->id_calendario;
          }
         

          $destinatario = new Destinatario;
                        $destinatario->rut_beneficiario=$value->rut_beneficiario;
                        $destinatario->leido='NO';
                        $destinatario->enviado='NO';
                        $destinatario->notificacion_id=$notificacion->id;
                        $destinatario->conf_camp=0;
                        
                        $destinatario->save(); 

       } 
       
    }

    protected function guardaNotificacionesDestinatariosManual($fecha_actual)
    {
      
      $fecha_actual= Carbon::create(2017,03,24);###debe ser fecha actual
      $campania_manual=Campania::campaniaManual($fecha_actual);

      foreach ($campania_manual as $key => $value)
       {
          
          $notificacion = new Notificacion;
                      $notificacion->campania_id = $value->campania_id; 
                      $notificacion->fecha_envio = $fecha_actual->toDateString();  
                      $notificacion->notificacion_enviada='NO';                   
                      $notificacion->save();

          $results=Excel::load('uploads/'.$value->nombre_archivo)->get();
       //dd($results);
          foreach ($results as $k => $v) 
          {

            
            $destinatario = new Destinatario;
            $destinatario->rut_beneficiario=$v->rut;
            $destinatario->leido='NO';
            $destinatario->enviado='NO';
            $destinatario->notificacion_id=$notificacion->id;
            $destinatario->conf_camp=0;            

            $destinatario->save();
            
          }
        

       }
      // dd(); 
    }

    public function envioNotificacion()
    {
      $fecha_actual= Carbon::create(2017,03,24);
      //$fecha_actual->subDays(1);
      //dd($fecha_actual);
     // $this->envioNotificacionManual($fecha_actual);
      $fecha_actualizacion=$this->fechaUltimaActualizacion();//extrae fecha ultima actualización

     if($fecha_actual->eq($fecha_actualizacion))//compara fecha actual con fecha ultima acualización
     {
      //dd("automatica");
      $this->envioNotificacionAutomatica($fecha_actual);  

      } 

    }

    

    protected function fechaUltimaActualizacion()
   {
    $fecha_actualizacion=CumpleCondicion::select('fecha')->first();
    return Carbon::createFromFormat('Y-m-d', $fecha_actualizacion->fecha);
   }


   protected function envioNotificacionAutomatica($fecha_actual)
   {

      $envio_notificacion=Notificacion::retornaNotificacionActual($fecha_actual);
      $envio_notificacionManual=Notificacion::retornaNotificacionManual($fecha_actual);
      dd($envio_notificacion);
      $arrayAuxiliar=array();
      $arrayAuxiliar[0][0]=$envio_notificacion[0]->rut;
      $arrayAuxiliar[0][1]=0;
     // dd($envio_notificacion);

      $arrayAuxiliar=$this->llenaArregloAuxiliar($envio_notificacion,$arrayAuxiliar);
         
      $arrayAuxiliar==$this->llenaArregloAuxiliar($envio_notificacionManual,$arrayAuxiliar);
  // dd($arrayAuxiliar);
      $contadorRut = array();
      $contadorRut = $this->conf_campanias($envio_notificacion,$arrayAuxiliar,$contadorRut);
      //dd($contadorRut);
      $contadorRut1 = $this->conf_campanias($envio_notificacionManual,$contadorRut,$contadorRut);
      dd($contadorRut1);
     //dd($envio_notificacion);
      if(!empty($envio_notificacion->all()))
      {
        $guarda_rut_genericos=array();
        $this->envioPush($envio_notificacion,$fecha_actual,$guarda_rut_genericos);
      }
      
   }


   protected function envioNotificacionManual($fecha_actual)
   {

      $envio_notificacion=Notificacion::retornaNotificacionManual($fecha_actual);
      //dd($envio_notificacion->all());
      if(!empty($envio_notificacion->all()))
      {
        dd("entra");
          $contadorRut = $this->conf_campanias($envio_notificacion);
          $this->envioPush($envio_notificacion,$fecha_actual,$contadorRut);
      }
      
      dd();
   }

   protected function conf_campanias($notificaciones,$arrayAuxiliar,&$contadorRut)
   {
      
     // dd($arrayAuxiliar);
       
     // dd($notificaciones);
      foreach ($arrayAuxiliar as $key => $value)
      {
        foreach ($notificaciones as $k => $v)
        {
          if($value[0]==$v->rut)
          {
            //dd($value[1]);
            $value[1]++;
             
          }
        }
        //dd($this->existe($contadorRut,$value));
        if(!$this->existe($contadorRut,$value))
        {
          array_push($contadorRut,$value);
        }
          //$contadorRut
          //dd();
        
        
      }
      //dd($contadorRut);
      return $contadorRut;

   }

   protected function existe(&$contadorRut,$value)
   {
      foreach ($contadorRut as $ke => $val)
        {
          if($value[0]==$val[0])
          {

            $val[1]=$value[1];
            $contadorRut[$ke]=$val;
            return true;
             
          }
         // dd($value[1]);
          
        }
        return false;
   }

   protected function llenaArregloAuxiliar($notificaciones,&$arrayAuxiliar)//ordena todos los rut sin repeticiones
   {
     
       // $arrayAuxiliar[0][0]=$notificaciones[0]->rut;
       // $arrayAuxiliar[0][1]=0;
//dd($notificaciones);
      foreach ($notificaciones as $key => $value)
      {

        $aux=true;
        if($key!=0)
        {
          foreach ($arrayAuxiliar as $k => $v)
          {
            //dd($v[0]);
            if($v[0]==$value->rut)
            {
              $aux=false;
            }
          }
          foreach ($arrayAuxiliar as $k => $v)
          {
            ///if($key!=0)
            if($aux)
              {

                array_push($arrayAuxiliar,[0 => $value->rut]);
                array_push($arrayAuxiliar[1],0);

              }
             // dd($arrayAuxiliar);
          }
         
          
        }
      }

     
      return $arrayAuxiliar;
   }



   protected function envioPush($envio_notificacion,$fecha_actual,$contadorRut)
   {

    $genericos=[0];
     foreach ($envio_notificacion as $key => $value)
        {
          $generica=true;
         // dd($value); 
        // if($key==3)
         // dd($genericos);
            //$conf_campania=ConfCampania::first();
            $generica=$this->verificaEnvio($contadorRut,$value,$fecha_actual,$genericos);
           
            if($generica)
            {
            //dd("aun no");
            $optionBuiler = new OptionsBuilder();
            $optionBuiler->setTimeToLive(60*20);

            $option = $optionBuiler->build();
              
            $notificationBuilder = new PayloadNotificationBuilder('my title');
            $notificationBuilder->setTitle($value->asunto)
                                ->setBody($value->mensaje);
                                
           // dd($value);
            $notification = $notificationBuilder->build();

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['destinatario_id' => $value->destinatarios_id]);

            $data = $dataBuilder->build();
           //dd($value->fcm_token);
            //$token = $value->fcm_token;
           // $token ="edmkzTTiNZA:APA91bHNDQjZvwmQzm1pP1JSLCAAlHpxu6yBExNEOZU-_CxOpQpK1y8G3EK50IP6rfbyx7a9veu_wei-gdKtY_W5E5nzxZMX2jvzPmti2pzkYdpXLkJMTuU9-Behg6xRqkmgchQbmsOw";
            $downstreamResponse = FCM::sendTo($value->fcm_token, $option, $notification, $data);
           // $downstreamResponse = FCM::sendTo($tokens, $option, $notification);

           //dd($downstreamResponse);
           if($downstreamResponse->numberSuccess()==1)
           {
            //dd(1);
            $notificacion=Notificacion::find($value->notificaciones_id);
            $notificacion->notificacion_enviada="SI";
            //$notificacion->save();
            
            $destinatario=Destinatario::find($value->destinatarios_id);
            $destinatario->fecha_envio=$fecha_actual->toDateString();          
            $destinatario->enviado="SI";

            //$destinatario->save();

            
           }
           //dd($downstreamResponse->numberSuccess());
          // if($cont==3)
            //dd($cont);
            //dd($downstreamResponse->numberSuccess());
           //$cont++;
            
           if($downstreamResponse->numberFailure()==1) 
           {

           }
           $downstreamResponse->numberModification();
           
         }
        }
        //dd($downstreamResponse->numberSuccess());

   }

   protected function verificaEnvio($contadorRut,$notificacion,$fecha_actual,&$genericos)
   {
      
     //dd($contadorRut);
      $conf_campania=ConfCampania::first();
         //dd($conf_campania);
//dd($genericos);
      foreach ($contadorRut as $key => $value)
      {
      // dd($value[0]);
        if($notificacion->rut==$value[0])
        {
         // dd($conf_campania->num_notificaciones);
          //dd($value[1]);
          if($value[1]>$conf_campania->num_notificaciones)
          {
            foreach ($genericos as $key => $value)
            {
             
              if($value==$notificacion->rut)
              {
                $notificacion_update=Notificacion::find($notificacion->notificaciones_id);
                $notificacion_update->notificacion_enviada="SI";
                $notificacion_update->save();
               
                $destinatario=Destinatario::find($notificacion->destinatarios_id);
               // dd($destinatario);
                //dd();
                $destinatario->fecha_envio=$fecha_actual->toDateString();          
                $destinatario->enviado="SI";
                $destinatario->save();
               // dd("entro");
                return false;
                
              }
            }
              $this->envioNotificacionConfigurada($conf_campania->mensaje_generico,$notificacion,$fecha_actual,$genericos);
              //dd();
            array_push($genericos,$notificacion->rut);
            //dd($genericos);
            return false;
          }
          return true;
          
        }
      }

      return true;
 

   }

   protected function envioNotificacionConfigurada($mensaje_generico,$notificacion,$fecha_actual,$genericos)
   {
            $optionBuiler = new OptionsBuilder();
            $optionBuiler->setTimeToLive(60*20); 

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
            $downstreamResponse = FCM::sendTo($notificacion->fcm_token, $option, $notification);//, $data);
           // $downstreamResponse = FCM::sendTo($tokens, $option, $notification);

           //dd($downstreamResponse);
           if($downstreamResponse->numberSuccess()==1)
           {
           // dd($fecha_actual);

            $notificacion_update=Notificacion::find($notificacion->notificaciones_id);
            $notificacion_update->notificacion_enviada="SI";
            $notificacion_update->save();
            //dd($notificacion);
            $destinatario=Destinatario::find($notificacion->destinatarios_id);
           // dd($destinatario);
            //dd();
            $destinatario->fecha_envio=$fecha_actual->toDateString();          
            $destinatario->enviado="SI";
            
            $destinatario->save();

            
            
           // dd($genericos);
            
           }
          // dd($downstreamResponse->numberSuccess());
   }

    
}
