<?php $__env->startSection('titulo'); ?>
Configuración de Usuario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent

<div class="container-fluid">
 <?php if(session()->has('flash_notification.message')): ?>
    <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        <?php echo session('flash_notification.message'); ?>

    </div>
  <?php endif; ?>
	<div class="jumbotron" style="margin-bottom: 0px; border-radius:5px 5px 0px 0px;"> 
		Configuración de Usuario
	</div> 
	<div class="row">
		<div class="cajas_cabecera_admin_usuario" style="">
			<form action="<?php echo e(url('filtro_usuarios')); ?>" method="GET">
				<div class="row">
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">NOMBRE</label><br>
						<input type="text" value="<?php echo e($request->nombre); ?>" name="nombre">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">MAIL</label><br>
						<input type="text" value="<?php echo e($request->mail); ?>" name="mail">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">ESTADO</label><br>
						<div class="caja_select">
							<select type="" name="estado">
			                    <option value="">Todos</option>
			                    <?php if($request->estado=='Activo'): ?>
			                      <option value="Activo" selected>Activo</option>
			                      <option value="Inactivo">Inactivo</option>
			                    <?php elseif($request->estado=='Inactivo'): ?>
			                      <option value="Activo">Activo</option>
			                      <option value="Inactivo" selected>Inactivo</option>
			                    <?php else: ?>
			                      <option value="Activo">Activo</option>
			                      <option value="Inactivo">Inactivo</option>
			                    <?php endif; ?>
			                 </select>
						</div>
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">PERFIL</label><br>
						<div class="caja_select">
						<select type="" name="perfil" >
							<option value="">Todos</option>
							<?php if($request->perfil=='Administrador'): ?>
							<option value="Administrador" selected>Administrador</option>
							<option value="Operador" >Operador</option>
							<option value="Editor" >Editor</option>
							<?php elseif($request->perfil=='Operador'): ?>
							<option value="Operador" selected>Operador</option>
							<option value="Administrador">Administrador</option>
							<option value="Editor" >Editor</option>							
							<?php elseif($request->perfil=='Editor'): ?>
							<option value="Editor" selected>Editor</option>
							<option value="Administrador">Administrador</option>
							<option value="Operador" >Operador</option>
							<?php else: ?>
							<option value="Administrador">Administrador</option>
							<option value="Operador" >Operador</option>
							<option value="Editor" >Editor</option>
							<?php endif; ?>
						</select>
						</div>
					</div>
					
					<div>
						<input style="width:80px" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="BUSCAR">
					</div>
				</div>
			</form>
		</div>
	</div>
	




	<div class="row" style="margin-top:10px;" >
		<div class="col-md-4" style="padding:0px 4px 0px 0px">
			<div class="tabla_altura_admin_usuario">
				
				<table id="example" class="tabla_listado_campanias tablas" >
          
			      <thead class="tabla_cabecera_listado_campanias" style="height: 30px; "> 
			                <tr>
			                    <th>USUARIO</th>
			                    <th>PERFIL</th>
			                    <th>MAIL</th>
			                    <th>ESTADO</th>
			                    <th style="padding-right: 5px">EDITAR</th>
	
			                </tr>
			            </thead>

			        <tbody >
			        
			        <?php foreach($usuarios as $usuario): ?>
			            <tr>
			                
			                <td><?php echo e($usuario->nombre); ?> <?php echo e($usuario->apellido_paterno); ?></td>
			                <td><?php echo e($usuario->perfil); ?></td>
			                <td><?php echo e($usuario->email); ?></td>
			                <td><?php echo e($usuario->estado); ?></td>
			                <td><a href="<?php echo e(route('administrador_usuarios.edit',$usuario->id,$request)); ?>"><img style="width:20px;" src="<?php echo e(url('img/EDITAR.png')); ?>"></a></td>
			                
			            </tr>
			         <?php endforeach; ?>

			        </tbody>

    			</table>
    			<?php if($usuarios): ?>
    			  <?php echo $usuarios->render(); ?>

    			<?php endif; ?>
    		</div>
    
      
		</div>


		<form style="margin-bottom: 0px;" id="form_actualizar" method="POST" action="<?php echo e(route('administrador_usuarios.store')); ?>">
			<div class="col-md-4" style="padding:0px 2px 0px 2px">
				<div class="cajas_altura_admin_usuario">

					<label class="col-md-12" style="margin:10px;padding: 0px">Editar Usuario</label>
					<label class="col-md-12 title_label">RUT (sin dígito verificador)</label>
					<div class="col-md-12">
						<input type="text" class="input_box_text_panel rut_numeric" maxlength="8" value="<?php if(isset($usuario_editar->nombre)): ?><?php echo e($usuario_editar->rut); ?><?php endif; ?>" name="rut" oninvalid="setCustomValidity('Debe ingresar rut sin dígito verificador')" oninput="setCustomValidity('')" required  style="width:48%">
					</div>
					<div class="col-md-6" style="padding-right: 0px">
						<label class="title_label">NOMBRE</label><br>				
						<input type="text" class="input_box_text_panel" value="<?php if(isset($usuario_editar->nombre)): ?><?php echo e($usuario_editar->nombre); ?><?php endif; ?>" name="nombre" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required  style="width:96%">
					</div>
					<div class="col-md-6" style="padding-left: 0px">
						<label class="title_label">APELLIDO PATERNO</label><br>				
						<input type="text" class="input_box_text_panel" value="<?php if(isset($usuario_editar->nombre)): ?><?php echo e($usuario_editar->apellido_paterno); ?><?php endif; ?>" name="apellido_paterno" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required  style="width:96%">
					</div>
					<label class="col-md-12 title_label">EMAIL</label>
					<div class="col-md-12">
						<input type="email" title="jjjjjjj" class="input_box_text_panel" value="<?php if(isset($usuario_editar->nombre)): ?><?php echo e($usuario_editar->email); ?><?php endif; ?>" required  name="email" style="width:98%"  id="maill">
					</div>
					<div class="col-md-6" style="padding-right: 0px">
						<label class="title_label_nueva_campania">PERFIL</label><br>

						<select id="select_perfil" class="select_box_body from_control" name="perfil" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:96%">
							<option value="">seleccionar...</option>
								<?php if(isset($usuario_editar->perfil_id)): ?>
									<?php if($usuario_editar->perfil_id==1): ?>
									<option value="1" selected>Administrador</option>
									<option value="2" >Operador</option>
									<option value="3" >Editor</option>
									<?php elseif($usuario_editar->perfil_id==2): ?>
									<option value="2" selected>Operador</option>
									<option value="1">Administrador</option>
									<option value="3" >Editor</option>							
									<?php elseif($usuario_editar->perfil_id==3): ?>
									<option value="3" selected>Editor</option>
									<option value="1">Administrador</option>
									<option value="2" >Operador</option>
									<?php else: ?>
									<option value="1">Administrador</option>
									<option value="2" >Operador</option>
									<option value="3" >Editor</option>
									<?php endif; ?>
								<?php else: ?>
									<option value="1">Administrador</option>
									<option value="2" >Operador</option>
									<option value="3" >Editor</option>
								<?php endif; ?>

						</select>
						
					</div>
					<div class="col-md-6" style="padding-left: 0px">
						<label class="title_label_nueva_campania">ESTADO</label><br>
						<select id="select_estado" class="select_box_body" name="estado" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:96%">

			                    <option value="">seleccionar...</option>
			                    <?php if(isset($usuario_editar->estado)): ?>
				                    <?php if($usuario_editar->estado=='Activo'): ?>
				                      <option value="Activo" selected>Activo</option>
				                      <option value="Inactivo">Inactivo</option>
				                    <?php elseif($usuario_editar->estado=='Inactivo'): ?>
				                      <option value="Activo">Activo</option>
				                      <option value="Inactivo" selected>Inactivo</option>
				                    <?php else: ?>
				                      <option value="Activo">Activo</option>
				                      <option value="Inactivo">Inactivo</option>
				                    <?php endif; ?>
			                    <?php else: ?>
			                    <option value="Activo">Activo</option>
			                    <option value="Inactivo">Inactivo</option>
			                    <?php endif; ?>
						</select>
					</div>
					<label class="col-md-12 title_label">NOMBRE DE USUARIO</label>
					<div class="col-md-12">
						<input type="text" class="input_box_text_panel" value="<?php if(isset($usuario_editar->nombre)): ?><?php echo e($usuario_editar->nombre_usuario); ?><?php endif; ?>" name="nombre_usuario" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:48%">
						<div class="alert alert-danger" id="alerta_select" style="margin-top: 10px; visibility: collapse;">Para actualizar un usuario, debe completar todos los campos</div>
						<input type="hidden" name="id" value="<?php if(isset($usuario_editar->nombre)): ?><?php echo e($usuario_editar->id); ?><?php endif; ?>">
					</div>

					<div class="col-md-12" style="margin-top: -10px; " >
						<input id="actualizar" style="margin:0px; float:none" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="ACTUALIZAR">
					</div>
					
						
					
				</div>
			</div>
		</form>

		<form id="form_crear" method="POST" action="<?php echo e(route('administrador_usuarios.store')); ?>">
			<div class="col-md-4" style="padding:0px 0px 0px 4px">
				<div class="cajas_altura_admin_usuario">
					<label class="col-md-12" style="margin:10px; padding: 0px">Crear Usuario</label>
					<label class="col-md-12 title_label">RUT (sin dígito verificador)</label>
					<div class="col-md-12">
						<input type="text" class="input_box_text_panel rut_numeric" maxlength="8" name="rut" oninvalid="setCustomValidity('Debe ingresar rut sin dígito verificador')" oninput="setCustomValidity('')" required style="width:48%">
					</div>
					<div class="col-md-6" style="padding-right: 0px">
						<label class="title_label">NOMBRE</label><br>				
						<input type="text" class="input_box_text_panel" name="nombre" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')"  required  style="width:96%">
					</div>
					<div class="col-md-6" style="padding-left: 0px">
						<label class="title_label">APELLIDO PATERNO</label><br>				
						<input type="text" class="input_box_text_panel" name="apellido_paterno" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required  style="width:96%">
					</div>
					<label class="col-md-12 title_label">EMAIL</label>
					<div class="col-md-12">
						<input type="email" class="input_box_text_panel" name="email"  required  style="width:98%">
					</div>
					<div class="col-md-6" style="padding-right: 0px">
						<label class="title_label_nueva_campania">PERFIL</label><br>
						<select class="select_box_body form_control" id="select_perfil_crear" name="perfil" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:96%">
							<option value="">seleccionar...</option>
							<option value="1">Administrador</option>
							<option value="2">Operador</option>
							<option value="3">Editor</option>
						</select>
						
					</div>
					<div class="col-md-6" style="padding-left: 0px">
						<label class="title_label_nueva_campania">ESTADO</label><br>
						<select class="select_box_body" id="select_estado_crear" name="estado" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:96%">
							<option value="">seleccionar...</option>
							<option value="Activo">Activo</option>
							<option value="Inactivo">Inactivo</option>
						</select>
					</div>
					<label class="col-md-12 title_label">NOMBRE DE USUARIO</label>
					<div class="col-md-12">
						<input type="text" class="input_box_text_panel" name="nombre_usuario" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:48%">
						<div class="alert alert-danger" id="alerta_select_crear" style="margin-top: 10px; visibility: collapse;">Para crear un usuario, debe completar todos los campos </div>
						<input type="hidden" name="id" value="0">
					
					</div>


					<div class="col-md-12" style="margin-top: 10px">
						<input style="margin:0px; float:none" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="CREAR">
					</div>
				</div>
			</div>
		</form>
	</div>
	



</div>



<?php $__env->stopSection(); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo e(url('js/jquery.numeric.js')); ?>"></script>
<link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >

<script type="text/javascript">
	$(document).ready(function(){

	

		$(".rut_numeric").numeric();
		$("#configuracion").css('background', '#0091c2');
		 
		 //$("#maill").on("invalid",function(event) {
    //event.target.setCustomValidity('Username should only contain lowercase letters. e.g. john');
      //    }

		$("#form_actualizar").submit(function(){

			if($("#maill").val()=="")
			{	
				
				$("#maill").attr("required",true);
				return false;
			}
			
			if($('#select_estado').val()=="" || $('#select_perfil').val()==""){
				
				$('#alerta_select').css("visibility","visible");
				return false;

			}else
			{
				$('#alerta_select').css("visibility","collapse");
				return true;
			}
			
		});
		$("#form_crear").submit(function(){
			if($('#select_estado_crear').val()=="" || $('#select_perfil_crear').val()==""){
				
				$('#alerta_select_crear').css("visibility","visible");
				return false;

			}else
			{
				$('#alerta_select_crear').css("visibility","collapse");
				return true;
			}
			
		});

	
	});
	
</script>

</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>