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
			<div class="row">
			
				
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">Información</label><br>
					<input type="text" name="">
				</div>
				<div class="col-md-1" style="width:5%">
					<label style="margin:0px">Información</label><br>
					<input type="text" style="width:100%">
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">Información</label><br>
					<input type="text" name="">
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">Información</label><br>
					<div class="caja_select">
					<select type="" name="" >
					</select>
					</div>
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">Información</label><br>
					<div class="caja_select">
					<select type="" name="" >
					</select>
					</div>
				</div>
				<div class="col-md-1" style="width:12%">
					<label style="margin:0px">Información</label><br>
					<div class="caja_select">
					<select type="" name="" >
					</select>
					</div>
				</div>
				<div class="col-md-1" style="width:10%">
					<label style="margin:0px">Información</label><br>
					<input class="datepicker" type="text" name="" style="width:100%">
				</div>
				<div class="col-md-1" style="width:10%">
					<label style="margin:0px">Información</label><br>
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
        <?php for ($i=0; $i <17 ; $i++) { ?>
            <tr>
                <td><?=$i+1 . 234567?></td>
                <td>Mauricio Andrés</td>
                <td>Jofré Muñoz</td>
                <td><?= $i+1?></td>
                <td><?= $i+1?></td>
                <td>Apertura de cuadro de pago</td>
                <td>Apertura de cuadro de pago</td>
                <td>Renovantes</td>
                <td>SI</td>
                <td>10/10/2016</td>
                <td>SI</td>
                <td>10/10/2016</td>
                
            </tr>
          <?php }?>
        </tbody>

    </table>
    
    <div>
        
        
        <a href="<?php echo e(url('/nueva_campaña')); ?>"><input style="width:350px" class="btn btn-danger btn-sm  input_btn_buscar_admin_user exportar" type="submit" value="DESCARGAR REPORTE INDIVIDUAL DE NOTIFICACIONES"></a>
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