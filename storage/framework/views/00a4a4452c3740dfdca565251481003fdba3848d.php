<?php $__env->startSection('titulo'); ?>
Notificaciones por RUT
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent
<link rel="stylesheet" href="css/jquery-ui.css">
<div class="container-fluid">
<div class="row" style="margin-bottom:10px">
	<div class="jumbotron" style="margin-bottom: 0px; border-radius:5px 5px 0px 0px;"> 
		Notificaciones por RUT
	</div> 
	<div class="col_md-12">
		<div class="cajas_cabecera_admin_usuario" style="">
			<form action="filtro_listado_individual" method="GET">
				<div class="row">				
					
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">RUT</label><br>
						<input type="text" value="<?php echo e($request->rut); ?>" name="rut">
					</div>
					<div class="col-md-1" style="width:7%; padding:0px 0px 0px 5px">
						<label style="margin:0px">ID NOTIFICACIÓN</label><br>
						<input type="text" value="<?php echo e($request->notificacion_id); ?>" style="width:100%" name="notificacion_id">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">ASUNTO</label><br>
						<input type="text" value="<?php echo e($request->asunto); ?>" name="asunto">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">PROCESO</label><br>
						<div class="caja_select">
						<select type="" name="proceso" >
							<option value="">Todos</option>
							<?php foreach($procesos as $proceso): ?>
								<?php if($request->proceso==$proceso->proceso): ?>
								<option value="<?php echo e($proceso->proceso); ?>" selected="true"><?php echo e($proceso->proceso); ?></option>
								<?php else: ?>
			                    <option value="<?php echo e($proceso->proceso); ?>"><?php echo e($proceso->proceso); ?></option>
			                    <?php endif; ?>
			                <?php endforeach; ?>
						</select>
						</div>
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">UNIVERSO</label><br>
						<div class="caja_select">
							<select type="" name="universo" >
								<option value="">Todos</option>								
								<?php foreach($universos as $universo): ?>
									<?php if($request->universo==$universo->nombre_universo): ?>
										<option value="<?php echo e($universo->nombre_universo); ?>" selected="true"><?php echo e($universo->nombre_universo); ?></option>
									<?php else: ?> 
				                    	<option value="<?php echo e($universo->nombre_universo); ?>"><?php echo e($universo->nombre_universo); ?></option>
				                    <?php endif; ?>

				                <?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">TIPO</label><br>
						<div class="caja_select">
							<select type="" name="tipo_campania">
								<option value="">Todos</option>
								<?php if($request->tipo_campania=='automatica'): ?>
								hola
									<option value="automatica" selected>Automatica</option>
									<option value="manual">Manual</option>
								<?php elseif($request->tipo_campania=='manual'): ?>
									<option value="automatica">Automatica</option>
									<option value="manual" selected>Manual</option>
								<?php else: ?>
									<option value="automatica">Automatica</option>
									<option value="manual">Manual</option>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="col-md-1 filtros_fechas" style="">
						<label style="margin:0px">FECHA ENVIO DESDE</label><br>
						<input class="datepicker" type="text" value="<?php echo e($request->fecha_desde); ?>" name="fecha_desde" style="width:100%">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">HASTA</label><br>
						<input class="datepicker" type="text" value="<?php echo e($request->fecha_hasta); ?>" name="fecha_hasta" style="width:100%">
					</div>
					<div>
						<input style="width:80px" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="BUSCAR">
					</div>

				</div>
			</form>

		</div>
	</div>
	</div>
	<div class="row">

<table id="listado_individual" class="tabla_listado_campanias tablas" >
          
      <thead class="tabla_cabecera_listado_campanias"> 
                <tr>
                    <th>RUT</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>ID CAMPAÑA</th>
                    <th>ID NOTIFICACIÓN</th>
                    <th>ASUNTO</th>
                    <th>UNIVERSO</th>
                    <th>PROCESOS</th>
                    <th>ENVIADO</th>
                    <th>FECHA DE ENVÍO</th>
                    <th>APERTURA</th>
                    <th>FECHA APERTURA</th>
                </tr>
            </thead>

        <tbody >
       
        <?php foreach($notificaciones_por_rut as $notificacion): ?>
            <tr>
                <td><?php echo e($notificacion->rut_beneficiario); ?></td>
                <td><?php echo e($notificacion->nombres); ?></td>
                <td><?php echo e($notificacion->apellidos); ?></td>
                <td><?php echo e($notificacion->campania_id); ?></td>
                <td><?php echo e($notificacion->notificacion_id); ?></td>
                <td><?php echo e($notificacion->asunto); ?></td>
                <td><?php echo e($notificacion->nombre_universo); ?></td>
                <td><?php echo e($notificacion->proceso); ?></td>
                <td><?php echo e($notificacion->enviado); ?></td>
                <td><?php echo e($notificacion->notificaciones_fecha_envio); ?></td>
                <td><?php echo e($notificacion->leido); ?></td>
                <?php if(!$notificacion->fecha_leido): ?>
               <center> <td id="fecha_leido">-</td> </center>
                <?php else: ?>
                <td><?php echo e($notificacion->fecha_leido); ?></td>
                <?php endif; ?>
            </tr>
          <?php endforeach; ?>
       
        </tbody>

    </table>
    
    <div>
        <?php if($notificaciones_por_rut->render()): ?>
	    	<?php echo $notificaciones_por_rut->render(); ?>

	    <?php endif; ?>
        
        <a href="<?php echo e(url('exportar_listado_individual'.$filtros)); ?>"><input style="width:380px" class="btn btn-danger btn-sm  input_btn_buscar_admin_user exportar" type="submit" value="DESCARGAR REPORTE INDIVIDUAL DE NOTIFICACIONES"></a>

    </div>
</div>

</div>

<?php $__env->stopSection(); ?>

 <script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/nueva_campania.js')); ?>"></script>  
  

  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >

  <script type="text/javascript">


   $(document).ready(function(){
    $("#trazabilidad").css('background', '#0091c2');
  });
    
  </script>
</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>