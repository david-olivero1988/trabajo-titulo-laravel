@extends('layout.base')

@section('titulo')
Detalle notificación
@stop

@section('contenido')
@parent

<div class="container-fluid">



      <div class="jumbotron"> 
        Detalle notificación
  </div> 
  <div class="row">

       <div class="col-md-6" style="padding:0px 5px 0px 0px;">

        <div class="caja_altura">
         <div class="cajas_cabecera" style="">
          <p>Información de campaña</p>
    </div>
    <div class="cajas_cuerpo">
      <label class="col-md-12 title_label_panel_doble">Asunto</label>
      <div class="col-md-12">
            <input type="text" class="input_box_text ancho input_border color_letra" name="asunto" value="{{$campania->asunto}}" disabled style="">
                           
      </div>
      <label class="col-md-12 title_label_panel_doble">Mensaje</label>
      <div class="col-md-12">
            
            <textarea name="comentario" rows="10" cols="40" class="ancho" disabled style="resize:none; height:130px;">{{$campania->mensaje}}</textarea>
      </div>


      <div class="col-md-8" style="">
            <label class="title_label_nueva_campania">Universo</label><br>
            <input type="text" class="input_box_text ancho input_border" value="{{$campania->nombre_universo}}" disabled name="" style=""> 

      </div>
      



      <!--++++++++++++++++++++++++++++++++++++++-->
      <div class="col-md-6" style="padding:0px; margin:0px;">
            <div class="col-md-6 ajustarright" style="">
                  <label class="title_label_nueva_campania">Frecuencia</label><br>


                  <input id="frecuencia" type="text" class="ancho input_box_text input_border" value="{{$frecuencia}}" disabled style="">
                   

            </div>


<!--+++++++++++++++++++++++++++++++++++inicio por dia++++++++++++++++++++++++++++++++++++++++++--> 
            <div id="por_dia" class="ocultar">
                   <div class="col-md-6 ajustar" style="">
                        <label class="title_label_nueva_campania">Repetir cada</label><br>
                        <input id="tipo_ciclo" type="text" class="input_box_text ancho input_border" disabled value="{{$campania->ciclo_dias_0}}" style=""><label class="title_label_nueva_campania" style="margin-top: 0px">Días</label>
                        
                  </div>
            </div>

<!--+++++++++++++++++++++++++++++++++++fin por dia++++++++++++++++++++++++++++++++++++++++++--> 





<!--+++++++++++++++++++++++++++++++++++inicio por semana++++++++++++++++++++++++++++++++++++++++++--> 
      <div id="por_semana" class="ocultar">
             <div class="col-md-6 ajustar" style="">
                  <label class="title_label_nueva_campania">Repetir cada</label><br>
                  <input id="tipo_ciclo" type="text" class="input_box_text ancho input_border" disabled value="{{$campania->ciclo_semanas_1}}" style=""><label class="title_label_nueva_campania" style="margin-top: 0px">Vez, por semana el</label>
                  
            </div>
            <div class="col-md-12 ajustarright" style="">
                  <label class="title_label_nueva_campania">Días</label>
                  <label class="title_label_nueva_campania ancho" style="">{{$campania->dias_1}}</label>
                  
            </div>

      </div>



<!--+++++++++++++++++++++++++++++++++++fin por semana++++++++++++++++++++++++++++++++++++++++++--> 





<!--+++++++++++++++++++++++++++++++++++inicio por mes++++++++++++++++++++++++++++++++++++++++++--> 
      <div id="por_mes" class="ocultar">
                  <input type="text" id="tipo_mes" value="{{$campania->tipo_ciclo_mes}}" style="display:none">
                 

             <div class="col-md-6 ajustar" style="">
                  <label class="title_label_nueva_campania">Ciclo</label><br>
                  <input id="tipo_ciclo_mes" type="text" class="input_box_text ancho input_border" disabled value="Día del mes" style=""> 
            </div>

<!--+++++++++++++++++++++++++++++++++++inicio dia del mes++++++++++++++++++++++++++++++++++++++++++--> 
            <div id="mensual_dia_mes_div" class="ocultar">
                  <div class="col-md-6 ajustarright" style="">
                        <label class="title_label_nueva_campania">Repetir el día</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->repetir_dia_0}}" style=""> 
                  </div>
                  
                  <div class="col-md-6 ajustar" style="">
                        <label class="title_label_nueva_campania">Cada</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->por_meses_0}}" style=""><label class="title_label_nueva_campania" style="margin-top: 0px">Meses</label>
                  </div>
            </div>      
<!--+++++++++++++++++++++++++++++++++++fin dia del mes++++++++++++++++++++++++++++++++++++++++++--> 

<!--+++++++++++++++++++++++++++inicio dia de la semana del mes+++++++++++++++++++++++++++++++++--> 

            <div id="mensual_dia_semana_mes_div" class="ocultar">
                  <div class="col-md-6 ajustarright" style="">
                        <label class="title_label_nueva_campania">Repetir el</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->repetir_el_1}}" style=""> 
                  </div>
                  <div class="col-md-6 ajustar" style="">
                        <label class="title_label_nueva_campania">Día</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->dia_1}}" style=""> 
                  </div>
                  
                  <div class="col-md-6 ajustarright" style="">
                        <label class="title_label_nueva_campania">Cada</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->por_1}}" style=""><label class="title_label_nueva_campania" style="margin-top: 0px">Meses</label>
                  </div>

            </div>      
<!--++++++++++++++++++++++++++++fin dia de la semana del mes+++++++++++++++++++++++++++++++++--> 


      </div>




<!--+++++++++++++++++++++++++++++++++++fin por mes++++++++++++++++++++++++++++++++++++++++++--> 


<!--+++++++++++++++++++++++++++++++++++inicio por anio++++++++++++++++++++++++++++++++++++++++++-->    
<div id="por_anio" class="ocultar">   
       
            <div class="col-md-6 ajustar" style="">
                  <label class="title_label_nueva_campania">Repetir cada (años)</label><br>
                  <input type="text" class="input_box_text ancho input_border" value="{{$campania->ciclos_anios}}" disabled name="" style=""> 
            </div>

            <div class="col-md-8 ajustarright" style="">
                  <input type="text" id="tipo_anio" value="{{$campania->tipo_ciclo_anio}}" style="display:none">
                 <input type="text" id="valor_tipo" value="" style="display:none">  

                  <label class="title_label_nueva_campania">Tipo frecuencia</label><br>
                  <input id="tipo_ciclo_anio" type="text" class="input_box_text ancho input_border" disabled name="" value="" style=""> 

            </div>

<!--+++++++++++++++++++++++++++++++++++inicio dia de la semana del mes+++++++++++++++++++++++++++++++++++++++-->
            <div id="anual_dia_mes_div" class="ocultar">
                  <div class="col-md-4 ajustar" style="">
                        <label class="title_label_nueva_campania">El</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->repetir_el_1}}" style=""> 
                  </div>

                  <div class="col-md-6 ajustarright" style="">
                        <label class="title_label_nueva_campania">Día</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->dia_1}}" style=""> 

                  </div>
                  <div class="col-md-6 ajustar" style="">
                        <label class="title_label_nueva_campania">De</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->mes_1}}" style=""> 
                  </div>
            </div>
<!--+++++++++++++++++++++++++++++++++++fin dia de la semana del mes++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++inicio dia del mes++++++++++++++++++++++++++++++++++++++++++-->
            <div id="anual_dia_semana_mes_div" class="ocultar">
                  <div class="col-md-4 ajustar" style="">
                        <label class="title_label_nueva_campania">El</label><br>
                        <input type="text" class="input_box_text input_border ancho" disabled name="" value="{{$campania->repetir_el_0}}" style=""> 
                  </div>
                  
                  <div class="col-md-6 ajustarright" style="">
                        <label class="title_label_nueva_campania">Del mes de</label><br>
                        <input type="text" class="input_box_text ancho input_border" disabled name="" value="{{$campania->del_mes_0}}" style=""> 
                  </div>
            </div>
<!--+++++++++++++++++++++++++++++++++++fin dia del mes++++++++++++++++++++++++++++++++++++++++++-->
</div>
<!--+++++++++++++++++++++++++++++++++++fin por anio++++++++++++++++++++++++++++++++++++++++++-->            


      </div>

      <div class="col-md-6" style="padding:0px; margin:0px;">
            <div class="col-md-12 ajustarleft" style="">
                  <label class="title_label_nueva_campania">Comienza</label><br>
                  <input type="text" class="input_box_text input_border ancho" value="{{$campania->fecha_inicio}}" disabled name="" style=""> 
                  <input id="tipo_intervalo" type="text" class="input_box_text input_border" disabled value="{{$campania->tipo_intervalo}}" name="" style="display:none"> 
            </div>
            <div class="col-md-12 ocultar ajustarleft" id="sin_finalizacion" style="">
                  <label class="title_label_nueva_campania">Finaliza</label><br>
                  <input  type="text" class="input_box_text input_border ancho" disabled value="Sin fecha de finalización" name="" style=""> 
            </div>

            <div id="intervalo_repeticiones" class="col-md-12 ocultar ajustarleft" style="">
                  <label class="title_label_nueva_campania">Repeticiones</label><br>
                  <input  type="text" class="input_box_text ancho input_border" value="{{$campania->repeticiones}}" disabled name="" style=""> 

            </div>

            <div id="intervalo_fecha_fin" class="col-md-12 ocultar ajustarleft" style="">
                  <label class="title_label_nueva_campania">Fecha</label><br>
                  <input  type="text" class="input_box_text input_border ancho" value="{{$campania->fecha_fin}}" disabled name="" style=""> 

            </div>
            

      </div>
</div>
</div>
</div>
<div class="col-md-6" style="padding:0px 0px 0px 5px;">
  <div class="caja_altura" >
   <div class="cajas_cabecera">
    <p>Información de notificación</p>
</div>
<div class="cajas_cuerpo">
    <label class="col-md-12 title_label_panel_doble">Reporte</label>
      <div class="col-md-12">
            <a href="{{url('exportar_notificaciones?check_notificaciones_id[]='.$fecha->notificacion_id.'&detalle=detalle')}}"><input style="" class="btn btn-danger btn-sm btn_genera_reporte input_btn_buscar_admin_user" type="submit" value="Descargar Reporte de la Notificación"></a>                
      </div>
      <div class="col-md-12">
      <label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label>
      </div>
      <label class="col-md-12 title_label_panel_doble">Fecha y hora de envío</label>
      <div class="col-md-12">
            <input type="text" class="input_box_text input_border" disabled="" value="{{$fecha->fecha_hora_envio}}" name="" style="width:40%">               
      </div>


</div>
</div>
</div>
</div>

<div class="col-md-12" style="margin:5px 0px 5px 0px; ">

      <a href="{{url('/listado_notificaciones')}}"><input style="" class="btn btn-danger btn_genera_reporte btn-sm btn_footer input_btn_buscar_admin_user"  type="submit" value="VOLVER"></a>        

</div>

</div>



@stop
<script type="text/javascript"  src="{{url('js/jquery-3.1.1.min.js')}}"></script>
<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >
  
 
 <script type="text/javascript">
  $(document).ready(function(){
      $("#trazabilidad").css('background', '#0091c2');

    

      if($('#frecuencia').val()=="Anual"){
           $('#por_anio').removeClass('ocultar');
           if($('#tipo_anio').val()==0){
                  $('#anual_dia_semana_mes_div').removeClass('ocultar');
                  $('#tipo_ciclo_anio').val('Día del mes');
                  
           }else{
                  $('#anual_dia_mes_div').removeClass('ocultar');
                  $('#tipo_ciclo_anio').val('Día de la semana del mes');
           }  
      }else{
            if ($('#frecuencia').val()=="Mensual") {
                  $('#por_mes').removeClass('ocultar');                  
                  if ($('#tipo_mes').val()==0) {
                        $('#mensual_dia_mes_div').removeClass('ocultar');
                        $('#tipo_ciclo_mes').val('Día del mes');
                  }else{
                        $('#mensual_dia_semana_mes_div').removeClass('ocultar');
                        $('#tipo_ciclo_mes').val('Día de la semana del mes');
                  } 
            }else{
                  if($('#frecuencia').val()=="Semanal"){
                        $('#por_semana').removeClass('ocultar');
                  }else{
                        if($('#frecuencia').val()=="Diario"){
                              $('#por_dia').removeClass('ocultar');
                        }
                  }
            }
      }
//alert($('#tipo_intervalo').val());
      if($('#tipo_intervalo').val()==0)
      {
            $('#sin_finalizacion').removeClass('ocultar');
      }
      if($('#tipo_intervalo').val()==1)
      {
            $('#intervalo_repeticiones').removeClass('ocultar');      
      }
      if($('#tipo_intervalo').val()==2)
      {
            $('#intervalo_fecha_fin').removeClass('ocultar');      
      }
            
      
  });
  
</script>


</body>
</html>