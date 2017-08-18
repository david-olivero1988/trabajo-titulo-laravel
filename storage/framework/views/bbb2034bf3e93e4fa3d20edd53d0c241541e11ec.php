<?php $__env->startSection('titulo'); ?>
Detalle notificación
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
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
            <input type="text" class="input_box_text input_border"  name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Mensaje</label>
      <div class="col-md-12">
            <textarea name="comentario" rows="10" cols="40" style="resize:none; width:100%; height:130px;"></textarea>
      </div>


      <div class="col-md-8" style="">
            <label class="title_label_nueva_campania">Universo</label><br>
            <input type="text" class="input_box_text input_border" disabled name="" style="width:100%"> 

      </div>
      



      <!--++++++++++++++++++++++++++++++++++++++-->
      <div class="col-md-6" style="padding:0px; margin:0px;">
            <div class="col-md-6" style="padding-right: 2px">
                  <label class="title_label_nueva_campania">Frecuencia</label><br>
                  <input id="frecuencia" type="text" class="input_box_text input_border"  value="Diario" style="width:100%"> 

            </div>


<!--+++++++++++++++++++++++++++++++++++inicio por dia++++++++++++++++++++++++++++++++++++++++++--> 
            <div id="por_dia" class="ocultar">
                   <div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
                        <label class="title_label_nueva_campania">Repetir cada</label><br>
                        <input id="tipo_ciclo" type="text" class="input_box_text input_border" disabled value="2" style="width:100%"><label class="title_label_nueva_campania" style="margin-top: 0px">Días</label>
                        
                  </div>
            </div>

<!--+++++++++++++++++++++++++++++++++++fin por dia++++++++++++++++++++++++++++++++++++++++++--> 





<!--+++++++++++++++++++++++++++++++++++inicio por semana++++++++++++++++++++++++++++++++++++++++++--> 
      <div id="por_semana" class="ocultar">
             <div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
                  <label class="title_label_nueva_campania">Repetir cada</label><br>
                  <input id="tipo_ciclo" type="text" class="input_box_text input_border" disabled value="2" style="width:100%"><label class="title_label_nueva_campania" style="margin-top: 0px">Vez, por semana el</label>
                  
            </div>
            <div class="col-md-12" style=" padding-right: 2px">
                  <label class="title_label_nueva_campania">Día</label><br>
                  <label class="title_label_nueva_campania" style="width:100%">Lunes, Martes, Miercoles, Jueves, Viernes, Sábado, Domingo</label>
                  
            </div>

      </div>



<!--+++++++++++++++++++++++++++++++++++fin por semana++++++++++++++++++++++++++++++++++++++++++--> 





<!--+++++++++++++++++++++++++++++++++++inicio por mes++++++++++++++++++++++++++++++++++++++++++--> 
      <div id="por_mes" class="ocultar">
                  
             <div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
                  <label class="title_label_nueva_campania">Ciclo</label><br>
                  <input id="tipo_ciclo" type="text" class="input_box_text input_border" disabled value="Día del mes" style="width:100%"> 
            </div>

<!--+++++++++++++++++++++++++++++++++++inicio dia del mes++++++++++++++++++++++++++++++++++++++++++--> 
            <div id="mensual_dia_mes_div" class="ocultar">
                  <div class="col-md-6" style=" padding-right: 2px">
                        <label class="title_label_nueva_campania">Repetir el día</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="1" style="width:100%"> 
                  </div>
                  
                  <div class="col-md-6" style=" padding-left: 2px; padding-right: 2px">
                        <label class="title_label_nueva_campania">Por</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="3" style="width:100%"><label class="title_label_nueva_campania" style="margin-top: 0px">Meses</label>
                  </div>
            </div>      
<!--+++++++++++++++++++++++++++++++++++fin dia del mes++++++++++++++++++++++++++++++++++++++++++--> 

<!--+++++++++++++++++++++++++++++++++++inicio dia de la semana del mes++++++++++++++++++++++++++++++++++++++++++--> 
            <div id="mensual_dia_semana_mes_div" class="ocultar">
                  <div class="col-md-6" style=" padding-right: 2px">
                        <label class="title_label_nueva_campania">Repetir el</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="1" style="width:100%"> 
                  </div>
                  <div class="col-md-6" style=" padding-right: 2px">
                        <label class="title_label_nueva_campania">Día</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="1" style="width:100%"> 
                  </div>
                  
                  <div class="col-md-6" style=" padding-right: 2px">
                        <label class="title_label_nueva_campania">Por</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="3" style="width:100%"><label class="title_label_nueva_campania" style="margin-top: 0px">Meses</label>
                  </div>

            </div>      
<!--+++++++++++++++++++++++++++++++++++fin dia de la semana del mes++++++++++++++++++++++++++++++++++++++++++--> 


      </div>




<!--+++++++++++++++++++++++++++++++++++fin por mes++++++++++++++++++++++++++++++++++++++++++--> 


<!--+++++++++++++++++++++++++++++++++++inicio por anio++++++++++++++++++++++++++++++++++++++++++-->    
<div id="por_anio" class="ocultar">        
            <div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
                  <label class="title_label_nueva_campania">Repetir cada (años)</label><br>
                  <input type="text" class="input_box_text input_border" disabled name="" style="width:100%"> 
            </div>

            <div class="col-md-8" style="padding-right: 2px">
                  <label class="title_label_nueva_campania">Tipo frecuencia</label><br>
                  <input id="tipo_frecuencia" type="text" class="input_box_text input_border" disabled name="" value="Día del mes" style="width:100%"> 

            </div>

<!--+++++++++++++++++++++++++++++++++++inicio dia de la semana del mes++++++++++++++++++++++++++++++++++++++++++-->
            <div id="anual_dia_mes_div" class="ocultar">
                  <div class="col-md-4" style="padding-left: 2px; padding-right: 2px">
                        <label class="title_label_nueva_campania">El</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="primer" style="width:100%"> 
                  </div>

                  <div class="col-md-6" style="padding-right: 2px">
                        <label class="title_label_nueva_campania">Día</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="Lunes" style="width:100%"> 

                  </div>
                  <div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
                        <label class="title_label_nueva_campania">De</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="Enero" style="width:100%"> 
                  </div>
            </div>
<!--+++++++++++++++++++++++++++++++++++fin dia de la semana del mes++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++inicio dia del mes++++++++++++++++++++++++++++++++++++++++++-->
            <div id="anual_dia_semana_mes_div" class="ocultar">
                  <div class="col-md-4" style="padding-left: 2px; padding-right: 2px">
                        <label class="title_label_nueva_campania">El</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="primer" style="width:100%"> 
                  </div>
                  
                  <div class="col-md-6" style=" padding-right: 2px">
                        <label class="title_label_nueva_campania">Del mes de</label><br>
                        <input type="text" class="input_box_text input_border" disabled name="" value="Enero" style="width:100%"> 
                  </div>
            </div>
<!--+++++++++++++++++++++++++++++++++++fin dia del mes++++++++++++++++++++++++++++++++++++++++++-->
</div>
<!--+++++++++++++++++++++++++++++++++++fin por anio++++++++++++++++++++++++++++++++++++++++++-->            


      </div>

      <div class="col-md-6" style="padding:0px; margin:0px;">
            <div class="col-md-12" style=" padding-left: 2px;">
                  <label class="title_label_nueva_campania">Comienza</label><br>
                  <input type="text" class="input_box_text input_border" disabled name="" style="width:100%"> 

            </div>
            <div class="col-md-12" style="padding-left: 2px;">
                  <label class="title_label_nueva_campania">Finaliza</label><br>
                  <input id="intervalo_finaliza" type="text" class="input_box_text input_border" disabled value="Finaliz" name="" style="width:100%"> 
            </div>

            <div id="intervalo_repeticiones" class="col-md-12 ocultar" style=" padding-left: 2px;">
                  <label class="title_label_nueva_campania">Repeticiones</label><br>
                  <input  type="text" class="input_box_text input_border" disabled name="" style="width:100%"> 

            </div>

            <div id="intervalo_fecha" class="col-md-12 ocultar" style=" padding-left: 2px;">
                  <label class="title_label_nueva_campania">Fecha</label><br>
                  <input  type="text" class="input_box_text input_border" disabled name="" style="width:100%"> 

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
            <a href="<?php echo e(url('/listado_notificaciones')); ?>"><input style="" class="btn btn-danger btn-sm btn_genera_reporte input_btn_buscar_admin_user" type="submit" value="Descargar Reporte de Notificación"></a>                
      </div>
      <div class="col-md-12">
      <label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label>
      </div>
      <label class="col-md-12 title_label_panel_doble">Fecha y hora de envío</label>
      <div class="col-md-12">
            <input type="text" class="input_box_text input_border"  name="" style="width:40%">               
      </div>


</div>
</div>
</div>
</div>

<div class="col-md-12" style="margin:5px 0px 5px 0px; ">

      <a href="<?php echo e(url('/listado_notificaciones')); ?>"><input style="" class="btn btn-danger btn_genera_reporte btn-sm btn_footer input_btn_buscar_admin_user " type="submit" value="VOLVER"></a>        

</div>

</div>



<?php $__env->stopSection(); ?>
<script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
  
 
 <script type="text/javascript">
  $(document).ready(function(){
      $("#trazabilidad").css('background', '#0091c2');

    

      if($('#frecuencia').val()=="Anual"){
           $('#por_anio').removeClass('ocultar');
           if($('#tipo_frecuencia').val()=="Día del mes"){
                  $('#anual_dia_semana_mes_div').removeClass('ocultar');
            
           }else{
                  $('#anual_dia_mes_div').removeClass('ocultar');
           }
      }else{
            if ($('#frecuencia').val()=="Mensual") {
                  $('#por_mes').removeClass('ocultar');                  
                  if ($('#tipo_ciclo').val()=="Día del mes") {
                        $('#mensual_dia_mes_div').removeClass('ocultar');
                  }else{
                        $('#mensual_dia_semana_mes_div').removeClass('ocultar');
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

      if($('#intervalo_finaliza').val()=="Finaliza después de"){
            $('#intervalo_repeticiones').removeClass('ocultar');
      }else{
            if($('#intervalo_finaliza').val()=="Finaliza el"){
                  $('#intervalo_fecha').removeClass('ocultar');      
            }
            
      }
  });
  
</script>


</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>