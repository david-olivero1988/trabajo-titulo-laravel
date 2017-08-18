<?php $__env->startSection('titulo'); ?>
Nuevo universo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

@parent

<div class="container-fluid">



	<div class="jumbotron"> 
		Nuevo Universo de notificación
	</div> 
	<div class="" style="padding:0px; height: 68vh">
  		<div style="height:100%">
  			<div class="cajas_cabecera_cuenta" style="">
  				<p>Nuevo universo</p>
  			</div>
  			<div class="cajas_cuerpo_cuenta" >
  				<label class="col-md-12 title_label">Nombre</label>
				<div class="col-md-12">
					<input type="text" class="input_box_text" name="" style="width:50%; border:1px solid #999;opacity: 0.7;">
					
				</div>
				<label class="col-md-12 title_label">Descripción</label>
				<div class="col-md-12">
					<textarea name="comentario" rows="10" cols="40" style="resize:none; width:50%; height:130px;">Escribe tu Descripcion....</textarea>
				</div>

				<label class="col-md-12 title_label">Proceso</label>
				<div class="col-md-12">
					<input type="text" class="input_box_text" name="" style="width:30%; border:1px solid #999;opacity: 0.7;">
					
				</div>
  			</div>
  		</div>
  	</div>
  	<div class="col-md-12" style="margin:5px 0px 5px 0px; ">
		<input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="CREAR">
		<a href="<?php echo e(url('/nueva_campaña')); ?>"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="VOLVER"></a>		

	</div>


</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>