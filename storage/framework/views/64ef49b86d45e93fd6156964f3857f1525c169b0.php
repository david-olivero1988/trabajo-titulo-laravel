<?php $__env->startSection('titulo'); ?>
Cuenta
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent

<div class="container-fluid">



  <div class="jumbotron"> 
    Ver campaña
  </div> 
  <div class="row">

   <div class="col-md-4" style="padding:0px 4px 0px 0px;">


    <div class="caja_altura">
      <div class="cajas_cabecera" style="">
        <p>Información de Campaña</p>
      </div>
      <div class="cajas_cuerpo">
        <label class="col-md-12 title_label_panel_doble">Asunto</label>



        <div class="col-md-12">
          <input type="text" class="input_box_text input_border color_letra" name="asunto" value="<?php echo e($campania->asunto); ?>" disabled style="width:100%">               
        </div>


        <label class="col-md-12 title_label_panel_doble">Mensaje</label>
        <div class="col-md-12">
          <textarea name="comentario" rows="10" cols="40" disabled style="resize:none; width:100%; height:130px;"><?php echo e($campania->mensaje); ?></textarea>
        </div>

        <div class="col-md-4" style="padding-right: 2px">
          <label class="title_label_nueva_campania">Tipo</label><br>
          <input id="input_tipo" type="text" value="<?php echo e($campania->tipo_campania); ?>" class="input_box_text input_border color_letra" disabled name="hola" style="width:100%"> 

        </div>
        <div class="col-md-4" style="padding-left: 1px; padding-right: 1px">
          <label class="title_label_nueva_campania">Proceso</label><br>
          <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($campania->proceso); ?>" disabled style="width:100%"> 
        </div>
        <div class="col-md-4" style="padding-left: 2px">
          <label class="title_label_nueva_campania">Universo</label><br>

 <!--+++++++++++++++++++++++++++++++inicio tipo automatica++++++++++++++++++++++++++++++++++++++++++-->                  
          <input id="input_automatica" name="universo" type="text" class="input_box_text input_border ocultar_por_tipo_automatica color_letra" value="<?php echo e($campania->nombre_universo); ?>" disabled name="" style="width:100%"> 
 <!--+++++++++++++++++++++++++++++++fin tipo automatica++++++++++++++++++++++++++++++++++++++++++-->

 <!--+++++++++++++++++++++++++++++++inicio tipo manual++++++++++++++++++++++++++++++++++++++++++-->

          <input id="" type="text" class="input_box_text input_border ocultar_por_tipo_manual color_letra" disabled name="" style="width:78%"> 
          <img id="" src="" class="ocultar_por_tipo_manual" style="width:25px; height:25px; float: right;">

<!--+++++++++++++++++++++++++++++++fin tipo manual++++++++++++++++++++++++++++++++++++++++++-->                  

        </div>
        <div class="col-md-12">
          <label class="title_label_nueva_campania" style="margin-bottom: 10px">Descripción del universo</label><br>
          <p style="font-size: 9px; font-weight: bold"><?php echo e($campania->descripcion); ?>

          </p>
        </div>
      </div>
    </div>

  </div>




  <div class="col-md-4" style="padding:0px 2px 0px 2px;">
    <div class="caja_altura" >
     <div class="cajas_cabecera">
      <p>Actualización Cuenta</p>
    </div>
    <div class="cajas_cuerpo">

      <?php if($campania->tipo_frecuencia == 0): ?>
      <label class="col-md-12 title_label_panel_doble">Repetir</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Diario" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Repetir cada</label>
      <div class="col-md-2">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($campania->ciclo_dias_0); ?>" maxlength="2" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-1 title_label_panel_doble" style="padding:0px;">Dias</label>


      <?php elseif($campania->tipo_frecuencia == 1): ?>
      <label class="col-md-12 title_label_panel_doble">Repetir</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Semanal" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Repetir cada</label>
      <div class="col-md-2">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($campania->ciclo_semanas_1); ?>" maxlength="2" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-4 title_label_panel_doble " style="padding:0px;" >Semanas</label>
      <?php foreach($dias_1 as $dias): ?>
      <label class="col-md-12 title_label_panel_doble"  ><?php echo e($dias); ?></label>
      <?php endforeach; ?>
      <?php elseif($campania->tipo_frecuencia==2): ?>
      <label class="col-md-12 title_label_panel_doble">Repetir</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Mensual" disabled name="" style="width:100%">               
      </div>
      <?php if($ciclo->tipo_ciclo_mes==0): ?>
      <label class="col-md-12 title_label_panel_doble">Ciclo</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Dia del mes" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Repetir el dia</label>
      <div class="col-md-2">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->repetir_dia_0); ?>"  disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Cada</label>
      <div class="col-md-2">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->por_meses_0); ?>" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-4 title_label_panel_doble " style="padding:0px;" >Meses</label>
      <?php elseif($ciclo->tipo_ciclo_mes==1): ?>
      <label class="col-md-12 title_label_panel_doble">Ciclo</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Dia de la semana del mes" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Repetir el</label>
      <div class="col-md-4">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->repetir_el_1); ?>"  disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Día</label>
      <div class="col-md-4">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->dia_1); ?>"  disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Cada</label>
      <div class="col-md-2">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->por_1); ?>" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-4 title_label_panel_doble " style="padding:0px;" >Meses</label>
      <?php endif; ?>  
      <?php elseif($campania->tipo_frecuencia == 3): ?>


      <label class="col-md-12 title_label_panel_doble">Repetir</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Anual" disabled name="" style="width:100%">               
      </div>

      <?php if($ciclo->tipo_ciclo_anio==0): ?>

      <label class="col-md-12 title_label">Repetir cada</label><br>
      <div class="col-md-12">
        <input class="input_box_text_panel col-md-12 input_numeros" disabled value="<?php echo e($ciclo->ciclos_anios); ?>" maxlength="4" style="width:15%" type="text" id="">
        <label class="title_label">años</label>
      </div>


      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Dia del mes" disabled name="" style="width:100%; margin-top: 10px">               
      </div>

      <label class="col-md-12 title_label_panel_doble">El</label>
      <div class="col-md-2">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->repetir_el_0); ?>"  disabled name="" style="width:100%">               
      </div>
      <label class="col-md-12 title_label_panel_doble">Del mes de</label>
      <div class="col-md-6">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->del_mes_0); ?>" disabled name="" style="width:100%">               
      </div>



      <?php elseif($ciclo->tipo_ciclo_anio==1): ?>
       <label class="col-md-12 title_label">Repetir cada</label><br>
      <div class="col-md-12">
        <input class="input_box_text_panel col-md-12 input_numeros" disabled value="<?php echo e($ciclo->ciclos_anios); ?>" maxlength="4" style="width:15%" type="text" id="">
        <label class="title_label">años</label>
      </div>

      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Dia de la semana del mes" disabled name="" style="width:100%; margin-top: 10px">               
      </div>
      <label class="col-md-12 title_label_panel_doble">El</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->repetir_el_1); ?>"  disabled name="" style="width:30%">               
      </div>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->dia_1); ?>"  disabled name="" style="width:30%;margin-top: 10px">               
      </div>
      <label class="col-md-12 title_label_panel_doble">De</label>
      <div class="col-md-3">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($ciclo->mes_1); ?>" disabled name="" style="width:100%">               
      </div>

      <?php endif; ?>  





      <?php endif; ?>


    </div>
  </div>
</div>
<div class="col-md-4" style="padding:0px 0px 0px 4px;">
  <div class="caja_altura" >
    <div class="cajas_cabecera">
      <p>Actualización Cuenta</p>
    </div>
    <div class="cajas_cuerpo">

      <label class="col-md-12 title_label_panel_doble">Comienza</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($campania->fecha_inicio); ?>" disabled name="" style="width:50%">               
      </div>
      <?php if($campania->tipo_intervalo==0): ?>
      <label class="col-md-12 title_label_panel_doble">Finaliza</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="Sin fecha de finalización" disabled name="" style="width:100%">               
      </div>
      <?php elseif($campania->tipo_intervalo==1): ?>
      <label class="col-md-12 title_label_panel_doble">Finaliza en</label>
      <div class="col-md-3">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($campania->repeticiones); ?>" disabled name="" style="width:100%">               
      </div>
      <label class="col-md-3 title_label_panel_doble" style="padding:0px">Repeticiones</label>
      <?php elseif($campania->tipo_intervalo==2): ?>
      <label class="col-md-12 title_label_panel_doble">Finaliza el</label>
      <div class="col-md-12">
        <input type="text" class="input_box_text input_border color_letra" value="<?php echo e($campania->fecha_fin); ?>" disabled name="" style="width:100%">               
      </div>


      <?php endif; ?>


    </div>
  </div>
</div>
</div>

<div class="col-md-12" style="margin:5px 0px 5px 0px; ">

  <a href="javascript:history.back()"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="VOLVER"></a> 

</div>

</div>



<?php $__env->stopSection(); ?>

<script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
<link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >


<script type="text/javascript">
  $(document).ready(function(){
    $("#campanias").css('background', '#0091c2');
    if($('#input_tipo').val()=="Manual"){
      $('.ocultar_por_tipo_automatica').css('display','none');
      
    }else{
      $('.ocultar_por_tipo_manual').css('display','none');
      
      
    }
  });
  
</script>

</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>