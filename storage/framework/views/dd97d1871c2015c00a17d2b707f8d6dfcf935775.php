<?php $__env->startSection('titulo'); ?>
Control Individual
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent
<link rel="stylesheet" href="css/jquery-ui.css">

<div class="container-fluid">
	<div class="row" style="margin-bottom:10px">
	<div class="jumbotron" style="margin-bottom: 0px; border-radius:5px 5px 0px 0px;"> 
		Listado de notificaciones
	</div> 
	<div class="col_md-12">
		<div class="cajas_cabecera_admin_usuario" style="">
			<div class="row">
			
			<div class="col-md-1" style="width:7%; padding:0px 0px 0px 5px">
					<label style="margin:0px">ID NOTIFICACIÓN</label><br>
					<input type="text" style="width:100%">
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">RUT</label><br>
					<input type="text" name="">
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">ASUNTO</label><br>
					<input type="text" name="">
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">PROCESO</label><br>
					<div class="caja_select">
					<select type="" name="" >
					</select>
					</div>
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">UNIVERSO</label><br>
					<div class="caja_select">
					<select type="" name="" >
					</select>
					</div>
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">TIPO</label><br>
					<div class="caja_select">
					<select type="" name="" >
					</select>
					</div>
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">FECHA ENVÍO DESDE</label><br>
					<input class="datepicker" type="text" name="" style="width:100%">
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">FECHA HASTA</label><br>
					<input class="datepicker" type="text" name="" style="width:100%">
				</div>
				<div>
					<input style="width:80px" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="BUSCAR">
				</div>
			</div>
		</div>
	</div>
	</div>

	<div class="row">



<table id="example" class="tabla_listado_campanias tablas" >
          
      <thead class="tabla_cabecera_listado_campanias"> 
                <tr>
                    <th>ID DE <br> NOTIFICACIÓN</th>
                    <th>ASUNTO</th>
                    <th>PROCESO</th>
                    <th>UNIVERSO</th>
                    <th>DESTINATARIOS <br> TOTALES</th>
                    <th>DESTINATARIOS <br> REALES</th>
                    <th>LECTURAS</th>
                    <th>FECHA <br> ÚLTIMO ENVÍO</th>
                    <th>VER</th>
                    <th> </th>
                    
                </tr>
            </thead>

        <tbody >
        <?php foreach($notificaciones as $key => $notificacion): ?>
            <tr>
            <center>
                <td><?php echo e($notificacion->notificaciones_id); ?></td>
                <td><?php echo e($notificacion->asunto); ?></td>
                <td><?php echo e($notificacion->proceso); ?></td>
                <td><?php echo e($notificacion->nombre_universo); ?></td>
                <td><?php echo e($totales[$key]); ?></td>
                <td><?php echo e($reales[$key]); ?></td>
                <td><?php echo e($lecturas[$key]); ?></td>
                <td><?php echo e($notificacion->fecha_envio); ?></td>
                <td><a href="<?php echo e(url('detalle',$notificacion->campania_id)); ?>"><img style="width:20px;" src="<?php echo e(url('img/LUPA.png')); ?>"></a></td>
                <td><input class="" type="checkbox"  value="" style="margin:0px; height:20px; width:40px" ></td>
                </center>
                
            </tr>
          <?php endforeach; ?>
        </tbody>

    </table>
    <div>
        
        
        <a href="<?php echo e(url('/nueva_campaña')); ?>"><input style="" class="btn btn-danger btn-sm  input_btn_buscar_admin_user exportar" type="submit" value="DESCARGAR LISTADO DE CAMPAÑAS"></a>
    </div>

</div>


</div>

<?php $__env->stopSection(); ?>

  <script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>  
  <script src="<?php echo e(url('js/nueva_campania.js')); ?>"></script>  

  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>

  <script type="text/javascript">
   $(document).ready(function(){
    $("#trazabilidad").css('background', '#0091c2');
  });
    
  </script>
</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>