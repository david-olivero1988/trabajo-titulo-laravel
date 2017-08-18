<?php $__env->startSection('titulo'); ?>
Agregar campaña
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

@parent

<div class="container-fluid">



	<div class="jumbotron"> 
		Agregar campaña
	</div> 
	<div class="row">
		<div class="col-md-4" style="padding:0px 4px 0px 0px">
			<div class="cajas">
				<div class="col-md-12">
					<label style="font-weight: inherit; margin:10px 0px 10px 0px"> Información de campaña</label>
				</div>
				<label class="col-md-12 title_label">Asunto</label>
				<div class="col-md-12">
					<input type="text" class="input_box_text" name="" style="width:95%">
				</div>

				<label class="col-md-12 title_label">Mensaje</label>
				<div class="col-md-12">
					<textarea name="comentario" rows="10" cols="40" style="resize:none; width:95%; height:130px;border:none;">Escribe tu comentario....</textarea>
				</div>

				<div class="col-md-12">
					<label class="title_label">Tipo</label>
					<label class="title_label">Proceso</label>
				</div>
				<div class="col-md-12">
					<select class="select_box_body">
						<option value="volvo"></option>
						<option value="saab">Saab</option>
						<option value="mercedes">Mercedes</option>
						<option value="audi">Audi</option>
					</select>
					<select class="select_box_body">
						<option value="volvo"></option>
						<option value="saab">Saab</option>
						<option value="mercedes">Mercedes</option>
						<option value="audi">Audi</option>
					</select>
				</div>
				<label class="col-md-12 title_label">Universo</label>
				<div class="col-md-12">
					<select class="select_box_body_universo" >
						<option value="volvo"></option>
						<option value="saab">Saab</option>
						<option value="mercedes">Mercedes</option>
						<option value="audi">Audi</option>
					</select>
					<a href="<?php echo e(url('/nuevo_universo')); ?>"><input style="margin:0px; float:none" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="NUEVO"></a>
				</div>
				<div class="col-md-12"><label class="title_label" style="margin-bottom: 10px">Descripción del universo</label></div>
				<div class="col-md-12">
					<p style="font-size: 9px; font-weight: bold">El frondoso roble se levanta erguido y orgulloso en medio del parque en donde todas las tardes juegan los niños a su alrededor. Las madres descansan en los bancos de madera viendo  jugar a sus pequeños mientras el imponente árbol les proporciona buena sombra, lo que las ayuda a refrescarse en las tardes calurosas de primavera.
						URL del artículo: http://www.ejemplode.com/12-clases_de_espanol/2653-ejemplo_de_parrafo_descriptivo.html
						Fuente: ejemplos de Párrafo Descriptivo</p>
					</div>

				</div>
			</div>
			<div class="col-md-4" style="padding:0px 2px 0px 2px">
				<div class="cajas">

				</div>
			</div>
			<div class="col-md-4" style="padding:0px 0px 0px 4px">
				<div class="cajas">

				</div>
			</div>
		</div>


		<div class="col-md-12" style="margin:5px 0px 5px 0px; ">
			<input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">
			<a href="<?php echo e(url('/listado_campañas')); ?>"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="VOLVER"></a>
			

		</div>

</div>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>