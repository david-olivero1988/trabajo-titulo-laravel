<?php $__env->startSection('titulo'); ?>
Agregar campaña
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

@parent
<link rel="stylesheet" href="<?php echo e(url('css/jquery-ui.css')); ?>">

<div class="container-fluid">

<?php if(session()->has('flash_notification.message')): ?>

    <div class="alert alert-danger" style="" >
        
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo session('flash_notification.message'); ?> 
    </div>
<?php endif; ?>

<div id="valida_descripcion" class="alert alert-danger" style="display:none"></div>

<div id="fechas" class="alert alert-danger" style="display:none">La fecha tiene un formato incorrecto
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
<div id="diaSemana" class="alert alert-danger" style="display:none">Ingresar día de la semana es obligatorio
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>

	<div class="jumbotron"> 
		Editar campaña
	</div> 
   
 <form method="post" id="universo_manual" action="<?php echo e(action('CampaniaController@editar',$campania->id)); ?>" accept-charset="UTF-8" enctype="multipart/form-data">
  
     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<div class="row">
 
 
		<div class="col-md-4" style="padding:0px 4px 0px 0px;">
    
      
      		<div class="caja_altura">
      			<div class="cajas_cabecera" style="">
      				<p>Información de Campaña</p>
      			</div>
      			<div class="cajas_cuerpo">
      				<label class="col-md-12 title_label_panel_doble" style="margin-top: 20px">Asunto</label>
              
              

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
                <div class="col-md-4" style="padding-left: 2px" id="univer">
                  <label class="title_label_nueva_campania">Universo</label><br>
        <?php if($campania->tipo_campania=='automatica'): ?>
                
      
 
              
       

<!--+++++++++++++++++++++++++++++++inicio tipo automatica++++++++++++++++++++++++++++++++++++++++++-->                  
                  <input id="input_automatica" name="universo" type="text" class="input_box_text input_border ocultar_por_tipo_automatica color_letra" value="<?php echo e($campania->nombre_universo); ?>" disabled name="" style="width:100%"> 

        <?php else: ?>
        
<!--+++++++++++++++++++++++++++++++fin tipo automatica++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++inicio tipo manual++++++++++++++++++++++++++++++++++++++++++-->

                  <input id="input_automatica" name="universo" type="text" class=" input_border ocultar_por_tipo_automatica color_letra col-md-9" value="<?php echo e($campania->nombre_universo); ?>" disabled name="" style="padding:0px 5px 0px 5px"> 

                  <div class="input-group">
                  <input type="" name="universo_id" value="<?php echo e($campania->universos_id); ?>" style="display:none">
                  <img id="elimina_manual" src="<?php echo e(url('img/BOTE-BASURA.png')); ?>" style="background-color: #FC4902; height:25px; width:25px; padding:0px; border:0px" class="input-group-addon" >
                  </div>


      <?php endif; ?>
<!--+++++++++++++++++++++++++++++++fin tipo manual++++++++++++++++++++++++++++++++++++++++++-->                  
                  
                </div>
                <div class="col-md-12" id="ocul_nuev_uni_manual">
                <label class="title_label_nueva_campania" style="margin-bottom: 10px">Descripción del universo</label><br>
                  <p style="font-size: 9px; font-weight: bold"><?php echo e($campania->descripcion); ?>

                    </p>
                </div>


                <div class="col-md-12" id="mostrar_nuevo_uni_manual" style="display:none; padding:0px">

                 
                      <div id="manual_div" class="" style="padding:0px">
                      <label class="col-md-12 title_label">Universo</label>
                      <div class="col-md-12">
                        <div class="col-md-5 ajuste" >            
                          <input class="" value="" id="id_universo_manual"  name="" disabled>
                          <input style="display:none"  id="universo_manual_valor" value="no">
                        </div>
                        <div class="col-md-7 ajuste">

                          <span class="">
                            <input style="padding:0px; width: 48%" type="file" class="btn" id="carga_universo" name="carga_universo" multiple data-idcarga="1">
                          </span>

                        </div>
                      </div>
                      <label class="col-md-12 title_label">Descripción</label>
                      <div class="col-md-12">
                        <textarea id="descripcion_manual" name="descripcion_manual" rows="10" cols="40" style="resize:none; width:95%; height:60px;" placeholder="Descripción universo...."  oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')"></textarea>
                        
                      </div>

                      </div>
                     
                </div>
      			</div>
      		</div>

      	</div>

     
   




      <div class="col-md-4" style="padding:0px 2px 0px 2px">
        <div class="cajas_altura_paneles">
          <div class="col-md-12">
            <label style="font-weight: bold; margin:10px 0px 10px 0px">Frecuencia</label>
          </div>
          <label class="col-md-12 title_label">Repetir</label>
          <div class="col-md-12">
            <select id="select_repetir_cada" name="frecuencia" class="select_box_body_universo" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')"  style="width:100%" >
              <option value="">Seleccionar...</option>
              <?php if($campania->tipo_frecuencia==0): ?>
                <option value="por_dia" selected>Diario</option>
                <option value="por_semana">Semanal</option>
                <option value="por_mes">Mensual</option>
                <option value="por_anio">Anual</option>
              <?php elseif($campania->tipo_frecuencia==1): ?>
                <option value="por_dia" >Diario</option>
                <option value="por_semana" selected>Semanal</option>
                <option value="por_mes">Mensual</option>
                <option value="por_anio">Anual</option>
              <?php elseif($campania->tipo_frecuencia==2): ?>
                <option value="por_dia" >Diario</option>
                <option value="por_semana">Semanal</option>
                <option value="por_mes" selected>Mensual</option>
                <option value="por_anio">Anual</option>
              <?php elseif($campania->tipo_frecuencia==3): ?>
                <option value="por_dia" >Diario</option>
                <option value="por_semana">Semanal</option>
                <option value="por_mes" >Mensual</option>
                <option value="por_anio" selected>Anual</option>
              <?php else: ?>
                <option value="por_dia" >Diario</option>
                <option value="por_semana">Semanal</option>
                <option value="por_mes" >Mensual</option>
                <option value="por_anio" >Anual</option>
              <?php endif; ?>

            </select>
          </div>
          <div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
          <div id="frecuencia">

<!-- ++++++++++++++++++++++++++++++inicio por dia ++++++++++++++++++++++++++++++++++++++++++-->         
            <div id="por_dia_div" class="ocultar">
              <label class="col-md-12 title_label">Repetir cada</label><br>
              <div class="col-md-12">
                
                  <input class="input_box_text_panel col-md-12 input_numeros ciclo_dias" maxlength="4" value="<?php echo e($campania->ciclo_dias_0); ?>" style="width:15%" type="text" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')"  id="">
                
                <label class="title_label espacio">Días</label>
              </div>
            </div>
            <style>
              
              .espacio{
                margin-left: 5px;
              }
            </style>
<!-- ++++++++++++++++++++++++++++++fin por dia ++++++++++++++++++++++++++++++++++++++++++-->    

<!-- ++++++++++++++++++++++++++++++inicio por semana ++++++++++++++++++++++++++++++++++++++++++-->      
            <div id="por_semana_div" class="ocultar">
              <label class="col-md-12 title_label">Repetir cada</label><br>
              <div class="col-md-12">
                <input class="input_box_text_panel input_numeros ciclo_semanas input_semanas" value="<?php echo e($campania->ciclo_semanas_1); ?>" maxlength="4" style="width:15%" type="text" name="" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')"  id="">
                <label class="title_label col-md-12" style="padding:0px">Semana el</label>
              </div>
              <div class="col-md-12">
                <form action="demo_form.asp" method="get">
                   <div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"
                   <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='lunes'): ?>
                       checked
                     <?php endif; ?>
                   <?php endforeach; ?> 
                   value="lunes"><div class="col-md-2 label_check_box">Lunes</div></div>

                    <div class="col-md-12"> <input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox" 
                    <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='martes'): ?>
                       checked
                     <?php endif; ?>
                    <?php endforeach; ?> 
                     value="martes" ><div class="col-md-2 label_check_box" >Martes</div></div>
                    
                   <div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"
                    <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='miercoles'): ?>
                       checked
                     <?php endif; ?>
                    <?php endforeach; ?>
                   value="miercoles"><div class="col-md-2 label_check_box" >Miércoles</div></div>

                   <div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox" 
                   <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='jueves'): ?>
                       checked
                     <?php endif; ?>
                    <?php endforeach; ?>
                   value="jueves" ><div class="col-md-2 label_check_box" >Jueves</div></div>  

                   <div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"
                   <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='viernes'): ?>
                       checked
                     <?php endif; ?>
                    <?php endforeach; ?>
                   value="viernes"><div class="col-md-2 label_check_box" >Viernes</div></div>

                   <div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox" 
                   <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='sabado'): ?>
                       checked
                     <?php endif; ?>
                    <?php endforeach; ?>
                   value="sabado" ><div class="col-md-2 label_check_box" >Sábado</div></div>  

                   <div class="col-md-12"><input class="col-md-2 ciclo_semanas check" style="width:15px; height:15px;margin-top:7px;" type="checkbox"
                   <?php foreach($dias as $key => $value): ?> 
                     <?php if($value=='domingo'): ?>
                       checked
                     <?php endif; ?>
                    <?php endforeach; ?>
                   value="domingo"><div class="col-md-2 label_check_box check" >Domingo</div></div>
                  
                </form>
              </div>
            </div>

<!-- ++++++++++++++++++++++++++++++fin por semana ++++++++++++++++++++++++++++++++++++++++++-->

<!-- ++++++++++++++++++++++++++++++inicio por mes ++++++++++++++++++++++++++++++++++++++++++-->     
            <div id="por_mes_div" class="ocultar">
              <label class="col-md-12 title_label">Indique ciclo</label><br>
              <div class="col-md-12">
                <select class="select_box_body_universo ciclo_meses"  id="select_mensual_dia_semana" style="width:50%" >
                  <option value="">Seleccionar...</option>
                  <?php if($campania->tipo_ciclo_mes==0): ?>
                  <option value="dia_del_mes" selected>Día del mes</option>
                  <option value="dia_semana_mes">Día de la semana del mes</option>    
                  <?php elseif($campania->tipo_ciclo_mes==1): ?>
                  <option value="dia_del_mes" >Día del mes</option>
                  <option value="dia_semana_mes" selected>Día de la semana del mes</option>    
                  <?php else: ?>
                  <option value="dia_del_mes" >Día del mes</option>
                  <option value="dia_semana_mes">Día de la semana del mes</option> 
                  <?php endif; ?>          
                </select>
              </div>
              <div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
<!-- ++++++++++++++++++++++++++++++inicio dia del mes ++++++++++++++++++++++++++++++++++++++++++-->               
              <div id="dia_del_mes_div" class="ocultar_mensual" >
                <label class="col-md-12 title_label">Repetir el día</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo mes_borrar_0 ciclo_meses" style="width:20%" >
                    <option value="">0</option>
                    <?php if($campania->repetir_dia_0): ?>
                    <option  value="<?php echo e($campania->repetir_dia_0); ?>" selected><?php echo e($campania->repetir_dia_0); ?></option>
                    <?php endif; ?>
                  <?php for($i=1;$i<31;$i++){?>
                    <option  value="<?= $i?>"><?= $i ?></option>
                  <?php }?>       
                  </select>
                  
                </div>
                <label class="col-md-12 title_label">Cada</label><br>
                <div class="col-md-12">
                  <input class="input_box_text_panel col-md-12 input_numeros mes_borrar_0 ciclo_meses" value="<?php echo e($campania->por_meses_0); ?>"  maxlength="4" style="width:15%" type="text"  oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" id="">
                  <label class="title_label espacio">Meses</label>
                </div>
              </div>

<!-- ++++++++++++++++++++++++++++++fin dia del mes ++++++++++++++++++++++++++++++++++++++++++-->  

<!-- ++++++++++++++++++++++++++++++inicio semana del mes ++++++++++++++++++++++++++++++++++++++++++-->  


              <div id="dia_semana_mes_div" class="ocultar_mensual" >
                <label class="col-md-12 title_label">Repetir el</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo mes_borrar_1 ciclo_meses"  style="width:20%" >
                    <?php if($campania->repetir_el_1=='primer'): ?>
                      <option value="primer" selected>Primer</option>
                      <option value="segundo">Segundo</option>              
                      <option value="tercer">Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                    <?php elseif($campania->repetir_el_1=='segundo'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" selected>Segundo</option>              
                      <option value="tercer">Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                    <?php elseif($campania->repetir_el_1=='tercer'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" selected>Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                    <?php elseif($campania->repetir_el_1=='cuarto'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" >Tercer</option>
                      <option value="cuarto" selected>Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                     <?php elseif($campania->repetir_el_1=='ultimo'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" >Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo" selected>Ultimo</option>
                    <?php else: ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" >Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo" >Ultimo</option>
                    <?php endif; ?>
                    
                                                
                  </select>
                </div>
                <label class="col-md-12 title_label">Día</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo mes_borrar_1 ciclo_meses"  style="width:30%" >
                    <?php if($campania->dia_1=='lunes'): ?>
                      <option value="lunes" selected>Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php elseif($campania->dia_1=='martes'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes" selected>Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php elseif($campania->dia_1=='miercoles'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles" selected>Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php elseif($campania->dia_1=='jueves'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves" selected>Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                     <?php elseif($campania->dia_1=='viernes'): ?>
                      
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes" selected>Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option>
                     <?php elseif($campania->dia_1=='sabado'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado" selected>Sábado</option>
                      <option value="domingo">Domingo</option> 
                     <?php elseif($campania->dia_1=='domingo'): ?>
                      
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo" selected>Domingo</option> 
                    <?php else: ?>
                    <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo" >Domingo</option> 
                    <?php endif; ?>               
                  </select>
                </div>
                <label class="col-md-12 title_label">Cada</label><br>
                <div class="col-md-12">
                  <input class="input_box_text_panel col-md-12 input_numeros mes_borrar_1 ciclo_meses" value="<?php echo e($campania->por_1); ?>" maxlength="4" style="width:15%" type="text"  oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" id="">
                  <label class="title_label espacio">Meses</label>
                </div>
              </div>

<!-- ++++++++++++++++++++++++++++++fin semana del mes ++++++++++++++++++++++++++++++++++++++++++--> 

            </div>

<!-- ++++++++++++++++++++++++++++++fin por mes ++++++++++++++++++++++++++++++++++++++++++-->


<!-- ++++++++++++++++++++++++++++++inicio por anio ++++++++++++++++++++++++++++++++++++++++++-->

            <div id="por_anio_div" class="ocultar">
              <label class="col-md-12 title_label">Repetir cada</label><br>
              <div class="col-md-12">
                <input class="input_box_text_panel col-md-12 input_numeros ciclo_anios" value="<?php echo e($campania->ciclos_anios); ?>" maxlength="4" style="width:15%" type="text"  oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" id="">
                <label class="title_label espacio">años</label>
              </div>

              <div class="col-md-12">
                  <select class="select_box_body_universo ciclo_anios"  id="select_anual_dia_mes" style="width:50%; margin-top: 10px" > 

                  <option value="">Seleccionar...</option>  
                   <?php if($campania->tipo_ciclo_anio==0): ?>
                    <option value="por_anio_dia_mes" selected >Día del mes</option>
                    <option value="por_anio_dia_semana_mes" >Día de la semana del mes</option>    
                    <?php elseif($campania->tipo_ciclo_anio==1): ?>
                    <option value="por_anio_dia_mes">Día del mes</option>
                    <option value="por_anio_dia_semana_mes" selected>Día de la semana del mes</option>    
                    <?php else: ?>
                    <option value="por_anio_dia_mes">Día del mes</option>
                    <option value="por_anio_dia_semana_mes">Día de la semana del mes</option> 
                    <?php endif; ?> 
                                    
                    
                                    
                  </select>
                </div>
                <div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
<!-- ++++++++++++++++++++++++++++++inicio por dia del mes ++++++++++++++++++++++++++++++++++++++++++-->
              <div id="por_anio_dia_mes_div" class="ocultar_anual">
                <label class="col-md-12 title_label">El</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo anio_borrar_0 ciclo_anios"  id="dia_mes_mes" style="width:20%" >
                    <option value="">0</option>
                    <?php if($campania->repetir_el_0): ?>
                    <option  value="<?php echo e($campania->repetir_el_0); ?>"  selected><?php echo e($campania->repetir_el_0); ?></option>
                    <?php endif; ?>
                  <?php for($i=1;$i<31;$i++){?>
                    <option value="<?= $i?>"><?= $i ?></option>
                  <?php }?>
                  </select>
                  
                </div>
                <label class="col-md-12 title_label">Del mes de</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo anio_borrar_0 ciclo_anios"  id="select_meses"  style="width:30%" >
                    
                     <?php if($campania->del_mes_0=='enero'): ?>
                      <option value="enero" selected>Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='febrero'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" selected>Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='marzo'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" selected>Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='abril'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril" selected>Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='mayo'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" >Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo" selected>Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='junio'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" selected>Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='julio'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" >Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio" selected>Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='agosto'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto" selected>Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='septiembre'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril" >Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre" selected>Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='octubre'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" >Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo" >Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre" selected>Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='noviembre'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" >Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre" selected>Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->del_mes_0=='diciembre'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" >Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre" >Noviembre</option>            
                      <option value="diciembre" selected>Diciembre</option>

                    <?php else: ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" >Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre" >Noviembre</option>            
                      <option value="diciembre" >Diciembre</option>
                      <?php endif; ?> 
                      
                  </select>
                </div>

              </div>
<!-- ++++++++++++++++++++++++++++++fin por dia del mes ++++++++++++++++++++++++++++++++++++++++++-->

<!-- +++++++++++++++++++++++inicio por dia la semana del mes ++++++++++++++++++++++++++++++++++++++++++-->
              <div id="por_anio_dia_semana_mes_div" class="ocultar_anual">
                <label class="col-md-12 title_label">El</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo anio_borrar_1 ciclo_anios"  style="width:30%" >
                    
                    <?php if($campania->repetir_el_1=='primer'): ?>
                      <option value="primer" selected>Primer</option>
                      <option value="segundo">Segundo</option>              
                      <option value="tercer">Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                    <?php elseif($campania->repetir_el_1=='segundo'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" selected>Segundo</option>              
                      <option value="tercer">Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                    <?php elseif($campania->repetir_el_1=='tercer'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" selected>Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                    <?php elseif($campania->repetir_el_1=='cuarto'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" >Tercer</option>
                      <option value="cuarto" selected>Cuarto</option>
                      <option value="ultimo">Ultimo</option>
                     <?php elseif($campania->repetir_el_1=='ultimo'): ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" >Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo" selected>Ultimo</option>
                    <?php else: ?>
                      <option value="primer" >Primer</option>
                      <option value="segundo" >Segundo</option>              
                      <option value="tercer" >Tercer</option>
                      <option value="cuarto">Cuarto</option>
                      <option value="ultimo" >Ultimo</option>
                    <?php endif; ?>
                                          
                  </select>
                </div>
                <label class="col-md-12 title_label"></label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo anio_borrar_1 ciclo_anios" style="width:30%" >
                    
                    <?php if($campania->dia_1=='lunes'): ?>
                      <option value="lunes" selected>Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php elseif($campania->dia_1=='martes'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes" selected>Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php elseif($campania->dia_1=='miercoles'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles" selected>Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php elseif($campania->dia_1=='jueves'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves" selected>Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                     <?php elseif($campania->dia_1=='viernes'): ?>
                      
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes" selected>Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option>
                     <?php elseif($campania->dia_1=='sabado'): ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado" selected>Sábado</option>
                      <option value="domingo">Domingo</option> 
                     <?php elseif($campania->dia_1=='domingo'): ?>
                      
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo" selected>Domingo</option> 
                    <?php else: ?>
                      <option value="lunes">Lunes</option>
                      <option value="martes">Martes</option>              
                      <option value="miercoles">Miércoles</option>
                      <option value="jueves">Jueves</option>
                      <option value="viernes">Viernes</option>              
                      <option value="sabado">Sábado</option>
                      <option value="domingo">Domingo</option> 
                    <?php endif; ?>   
                                        
                  </select>
                </div>
                <label class="col-md-12 title_label">De</label><br>
                <div class="col-md-12">
                  <select class="select_box_body_universo anio_borrar_1 ciclo_anios"  style="width:30%" >
                    
                    <?php if($campania->mes_1=='enero'): ?>
                      <option value="enero" selected>Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='febrero'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" selected>Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='marzo'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" selected>Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='abril'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril" selected>Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='mayo'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" >Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo" selected>Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='junio'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" selected>Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='julio'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" >Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio" selected>Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='agosto'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto" selected>Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='septiembre'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril" >Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre" selected>Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='octubre'): ?>
                      <option value="enero" >Enero</option>
                      <option value="febrero" >Febrero</option>              
                      <option value="marzo">Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo" >Mayo</option>              
                      <option value="junio">Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre" selected>Octubre</option>
                      <option value="noviembre">Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='noviembre'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" >Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre" selected>Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                    <?php elseif($campania->mes_1=='diciembre'): ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" >Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre" >Noviembre</option>            
                      <option value="diciembre" selected>Diciembre</option>
                    <?php else: ?>
                      <option value="enero">Enero</option>
                      <option value="febrero">Febrero</option>              
                      <option value="marzo" >Marzo</option>
                      <option value="abril">Abril</option>
                      <option value="mayo">Mayo</option>              
                      <option value="junio" >Junio</option>
                      <option value="julio">Julio</option>  
                      <option value="agosto">Agosto</option>            
                      <option value="septiembre">Septiembre</option>
                      <option value="octubre">Octubre</option>
                      <option value="noviembre" >Noviembre</option>            
                      <option value="diciembre">Diciembre</option>
                      <?php endif; ?> 
                      
                  </select>
                </div>

              </div>
<!-- ++++++++++++++++++++++++++++++fin por dia de la semana del mes ++++++++++++++++++++++++++++++++++++-->


            </div>


<!-- ++++++++++++++++++++++++++++++fin por anio ++++++++++++++++++++++++++++++++++++++++++-->

           </div>
        </div>

      </div>
      <!--style>
.up-arrow {
    display: inline-block;
    position: absolute;
    border: 1px solid rgba(119, 119, 119, 0.58);
    text-decoration: none;
    border-radius: 2px;
    padding: 20px;
    margin-top: 50px;
    border-radius: 2px;
    box-shadow: 0px 2px 3px 0px #999999;
    background-image: url(img/logo_tooltip.png);
    background-repeat: no-repeat;
    background-position-x: 7px;
    background-position-y: 19px;
    text-align: center;
    padding-left: 36px;
    color: #666;
    font-family: sans-serif;
    background-color: white;
    z-index:1000;
    font:sans-serif;
}
.up-arrow:before {
    content: '';
    display: block;
    position: absolute;
    left: 58px;
    bottom: 100%;
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-bottom-color: rgba(119, 119, 119, 0.87);
    /* border-radius: 38px; */
    /* border-radius: 25px; */
}
.up-arrow:after {
    content: '';
    display: block;
    position: absolute;
    left: 59px;
    bottom: 100%;
    width: 0;
    height: 0;
    border: 9px solid transparent;
    border-bottom-color: white;
    /* border-radius: 25px; */
}
</style-->
      

      <div class="col-md-4" style="padding:0px 0px 0px 4px">
        <div class="cajas_altura_paneles">
          <div class="col-md-12">
            <label style="font-weight: bold; margin:10px 0px 10px 0px">Intervalo de repetición</label>
          </div>
          <label class="col-md-12 title_label">Comienza</label><br>
          <div class="col-md-12">
            <input class="input_box_text_panel col-md-12 datepicker" value="<?php echo e($campania->fecha_inicio); ?>" name="fecha_inicio" type="text" required id="selector">
          </div>
          <label class="col-md-12 title_label">Finaliza</label><br>
          <div class="col-md-12">
            <select id="select_intervalo" class="select_box_body_universo " name="tipo_intervalo" style="width:100%" >

            <?php if($campania->tipo_intervalo==0): ?>
              <option value="sin_fecha" selected>Sin fecha de finalización</option>
              <option value="finaliza_despues_de">Finaliza después de</option>
              <option value="finaliza_el">Finaliza el</option>
            <?php elseif($campania->tipo_intervalo==1): ?>
              <option value="sin_fecha" >Sin fecha de finalización</option>
              <option value="finaliza_despues_de" selected>Finaliza después de</option>
              <option value="finaliza_el">Finaliza el</option>
            <?php elseif($campania->tipo_intervalo==2): ?>
              <option value="sin_fecha" >Sin fecha de finalización</option>
              <option value="finaliza_despues_de" >Finaliza después de</option>
              <option value="finaliza_el" selected>Finaliza el</option>
            <?php else: ?>
              <option value="sin_fecha" >Sin fecha de finalización</option>
              <option value="finaliza_despues_de" >Finaliza después de</option>
              <option value="finaliza_el">Finaliza el</option>

            <?php endif; ?>
              
            </select>
            
          </div>
          <div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
<!-- +++++++++++++++++++++++inicio intervalo finaliza despues de++++++++++++++++++++++++++++++++++++++-->     
            <div id="finaliza_despues_de_div" class="ocultar_intervalo ">
              <div class="col-md-12">      
              
                <input class="input_box_text_panel col-md-12 input_numeros intervalo_borrar_0" value="<?php echo e($campania->repeticiones); ?>" maxlength="4" style="width:15%" type="text" id="">

                <label class="title_label espacio">Repeticiones</label>
              </div>
            </div>    
<!-- +++++++++++++++++++++++++fin intervalo finaliza despues de+++++++++++++++++++++++++++++++++++++++++-->

<!-- ++++++++++++++++++++++++++++++inicio intervalo finaliza el++++++++++++++++++++++++++++++++++++++-->                  
            <div id="finaliza_el_div" class="ocultar_intervalo">
              <div class="col-md-12">
                <input class="input_box_text_panel col-md-12 datepicker intervalo_borrar_1" value="<?php echo e($campania->fecha_fin); ?>" type="text" id="fecha_fin"   >
              </div>
            </div>
<!-- ++++++++++++++++++++++++++++++fin intervalo finaliza el+++++++++++++++++++++++++++++++++++++++++-->  



			</div>

		</div>

    

		<div class="col-md-12" style="margin:5px 0px 5px 0px; ">
			<input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">
			<a href="javascript:history.back()"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="VOLVER"></a>
      <?php if($campania->estado=="activado"): ?>
			<a  id="desactivado" class="activa_desactiva" ><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="DESACTIVAR"></a>
      <a  id="activado" class="activa_desactiva" style="display:none" ><input style="" class="btn btn-success btn-sm btn_footer input_btn_buscar_admin_user" type="" value="ACTIVAR"></a>
      <?php else: ?>
      <a  id="desactivado" class="activa_desactiva" style="display:none" ><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="DESACTIVAR"></a>
      <a  id="activado" class="activa_desactiva"  ><input style="" class="btn btn-success btn-sm btn_footer input_btn_buscar_admin_user" type="" value="ACTIVAR"></a>
      
      <?php endif; ?>
			<a id="eliminar"><input  style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="ELIMINAR"></a>	
      <!--a id="probar" href="<?php echo e(url('/probar')); ?>"><input  style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="probar"></a-->							

		</div>
   </form>

</div>
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
    <div class="alerta ama-nar b_1" style="margin-top:10%">
      <div class="header_alerta">
        <a  class="detener" data-dismiss="modal" id="close-modal" aria-label="Close"></a>
      </div>         
        <div class="body_alerta">    
              
              <div class="mensaje_alerta" id="mensaje_alerta_modal">¿DETENER TODO?</div>
        </div>
       
        <div class="footer_alerta">
          <button class="btn green" id="activar" type="submit" onclick="">SI</button>
          <button class="btn red" id="noActivar" >NO</button>
        </div>  
        

    </div>  
</div> 
<div style="display:none" id="universo_id"><?php echo e($campania->universos_id); ?></div>

		<?php $__env->stopSection(); ?>
     <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >

<div id="guardo_url" style="display: none"></div>
<div id="guardo_estado" style="display: none"></div>

<div id="estado_campania" style="display:none"><?php echo e($campania->estado); ?></div>


 <script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
  
  <script src="<?php echo e(url('js/nueva_campania.js')); ?>"></script> 

  <script src="<?php echo e(url('js/jquery-1.12.4.js')); ?>"></script>
  <script src="<?php echo e(url('js/jquery-ui.js')); ?>"></script>
  <script src="<?php echo e(url('js/jquery.numeric.js')); ?>"></script>



  <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>  
  <script src="<?php echo e(url('js/formato_fechas.js')); ?>"></script> 
    <script src="<?php echo e(url('js/elimina_universo_manual.js')); ?>"></script>


<script type="text/javascript">
  $(document).ready(function(){





    $('#campanias').css('background', '#0091c2');
    var cambia=false;
    if($("#select_meses").val()=="febrero")
        {
          
          $("#dia_mes_mes option[value='30']").remove();
          $("#dia_mes_mes option[value='29']").remove();
          cambia=true;
        }
      $("#select_meses").change(function()
      {
        
        if($("#select_meses").val()=="febrero")
        {
          
          $("#dia_mes_mes option[value='30']").remove();
          $("#dia_mes_mes option[value='29']").remove();
          cambia=true;
        }else
        {
          if(cambia)

          {
            $("#dia_mes_mes").append("<option value='29'>29</option>");
          $("#dia_mes_mes").append("<option value='30'>30</option>");

          }
          

        }
      });

    $('.activa_desactiva').click(function(){
      $("#guardo_url").text("estado");
      $("#guardo_evento").text($(this).attr("id"));



      if($("#estado_campania").text()=="activado"){   

        $('#mensaje_alerta_modal').text('Al detener la campaña, el mensaje no será enviado a los usuarios. ¿Deseas continuar?');
        $("#close-modal").removeClass("play");
        $("#close-modal").addClass("detener");
        $("#guardo_estado").text("activado");  
      }else{
        $('#mensaje_alerta_modal').text('Al activar la campaña, reanudarás el envío de este mensaje a los usuarios. ¿Deseas continuar?');
        $("#close-modal").removeClass("detener");
        $("#close-modal").addClass("play");
        $("#guardo_estado").text("desactivado");  
              
      }
      $("#guardo_url").text("<?php echo e(url('estado')); ?>");
      $('#Modal1').modal('show');
      
    });

    $('#eliminar').click(function(){
      $("#guardo_url").text("<?php echo e(url('eliminar')); ?>");
      $("#close-modal").removeClass("play");
      $("#close-modal").addClass("detener");
      $("#mensaje_alerta_modal").text('Al eliminar la campaña, ya no estará disponible en el Administrador. ¿Deseas continuar?');
      $('#Modal1').modal('show');

    });
    

    $('#activar').click(function(){
        
           
            
            var url=$("#guardo_url").text();
            var estado=$("#guardo_estado").text();

            $.ajax({
                url:url,
                data:{
                      id:<?php echo e($campania->id); ?>,
                      estado:estado
                      
                     },
                success: function(estado){
                  // alert(estado);
                  if(estado=="activado")
                  {
                    $("#activado").css("display","none");
                    $("#desactivado").css("display","block");
                    $("#estado_campania").text("activado");
                  }
                  if(estado=="desactivado")
                  {
                    $("#desactivado").css("display","none");
                    $("#activado").css("display","block");
                    $("#estado_campania").text("desactivado");
                  }
                  if(estado=="eliminado")
                  {
                    window.location.href = "<?php echo e(url('/listado_campanas')); ?>";
                  }

                   $('#Modal1').modal('toggle');
                }
              });
            });

    $('#noActivar').click(function(){
          $('#Modal1').modal('toggle');
        });

    if($('#input_tipo').val()=="Manual"){
      $('.ocultar_por_tipo_automatica').css('display','none');
      
    }else{
      $('.ocultar_por_tipo_manual').css('display','none');
      
      
    }

$("#selector").click(function(){
    $("#selector").next().remove();
});
$("#fecha_fin").click(function(){
    $("#fecha_fin").next().remove();
});



$("#universo_manual").submit(function()
{ 
  /*
  if(!$("#selector").val())
    {
     $("#selector").next().remove();
    $("#selector").after("<div class='up-arrow'>Completar este campo es obligatorio</div>" ); 
    setTimeout(function(){
      $("#selector").next().remove();
    },5000);
    return false;
    }
if($("#select_intervalo").val()=="finaliza el")
{
  
    if(!$("#fecha_fin").val())
    {
     $("#fecha_fin").next().remove();
    $("#fecha_fin").after("<div class='up-arrow'>Completar este campo es obligatorio</div>" ); 
    setTimeout(function(){
      $("#fecha_fin").next().remove();
    },5000);
    return false;
    } 
}*/

if($("#universo_manual_valor").val()=="dentro")
    {
        $("#valida_descripcion").text("Debe cargar un archivo");
        $("#valida_descripcion").css("display","block");
        setTimeout(function(){$("#valida_descripcion").css("display","none")},3000);
        return false;
    }

if($("#select_repetir_cada").val()=="por_semana")
  {
    if(!$(".check").is(":checked"))
    {
      $("#diaSemana").css("display","block");
      return false;
    }
      
    
  }
  

  if(validaFechaDDMMAAAA($("#selector").val()))
  { 
    
    if($("#fecha_fin").attr("name")=="finaliza_el")
    {
      if(validaFechaDDMMAAAA($("#fecha_fin").val()))
        return true;
      else
      {
        $("#fechas").css("display","block");
        return false;
      }
    }
    return true;
  }
  else
    $("#fechas").css("display","block");

  return false;

})
  });
  
</script>

  
</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>