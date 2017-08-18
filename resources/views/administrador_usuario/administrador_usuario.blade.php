@extends('layout.base')

@section('titulo')
Configuración de Usuario
@stop

@section('contenido')
@parent

<div class="container-fluid">
 @if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
  @endif
	<div class="jumbotron" style="margin-bottom: 0px; border-radius:5px 5px 0px 0px;"> 
		Configuración de Usuario
	</div> 
	<div class="row">
		<div class="cajas_cabecera_admin_usuario" style="">
			<form action="{{url('filtro_usuarios')}}" method="GET">
				<div class="row">
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">NOMBRE</label><br>
						<input type="text" value="{{$request->nombre}}" name="nombre">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">MAIL</label><br>
						<input type="text" value="{{$request->mail}}" name="mail">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">ESTADO</label><br>
						<div class="caja_select">
							<select type="" name="estado">
			                    <option value="">Todos</option>
			                    @if($request->estado=='Activo')
			                      <option value="Activo" selected>Activo</option>
			                      <option value="Inactivo">Inactivo</option>
			                    @elseif($request->estado=='Inactivo')
			                      <option value="Activo">Activo</option>
			                      <option value="Inactivo" selected>Inactivo</option>
			                    @else
			                      <option value="Activo">Activo</option>
			                      <option value="Inactivo">Inactivo</option>
			                    @endif
			                 </select>
						</div>
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">PERFIL</label><br>
						<div class="caja_select">
						<select type="" name="perfil" >
							<option value="">Todos</option>
							@if($request->perfil=='Administrador')
							<option value="Administrador" selected>Administrador</option>
							<option value="Operador" >Operador</option>
							<option value="Editor" >Editor</option>
							@elseif($request->perfil=='Operador')
							<option value="Operador" selected>Operador</option>
							<option value="Administrador">Administrador</option>
							<option value="Editor" >Editor</option>							
							@elseif($request->perfil=='Editor')
							<option value="Editor" selected>Editor</option>
							<option value="Administrador">Administrador</option>
							<option value="Operador" >Operador</option>
							@else
							<option value="Administrador">Administrador</option>
							<option value="Operador" >Operador</option>
							<option value="Editor" >Editor</option>
							@endif
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
			        
			        @foreach($usuarios as $usuario)
			            <tr>
			                
			                <td>{{$usuario->nombre}} {{$usuario->apellido_paterno}}</td>
			                <td>{{$usuario->perfil}}</td>
			                <td>{{$usuario->email}}</td>
			                <td>{{$usuario->estado}}</td>
			                <td><a href="{{route('administrador_usuarios.edit',$usuario->id,$request)}}"><img style="width:20px;" src="{{url('img/EDITAR.png')}}"></a></td>
			                
			            </tr>
			         @endforeach

			        </tbody>

    			</table>
    			@if($usuarios)
    			  {!!$usuarios->render()!!}
    			@endif
    		</div>
    
      
		</div>


		<form style="margin-bottom: 0px;" id="form_actualizar" method="POST" action="{{route('administrador_usuarios.store')}}">
			<div class="col-md-4" style="padding:0px 2px 0px 2px">
				<div class="cajas_altura_admin_usuario">

					<label class="col-md-12" style="margin:10px;padding: 0px">Editar Usuario</label>
					<label class="col-md-12 title_label">RUT (sin dígito verificador)</label>
					<div class="col-md-12">
						<input type="text" class="input_box_text_panel rut_numeric" maxlength="8" value="@if(isset($usuario_editar->nombre)){{$usuario_editar->rut}}@endif" name="rut" oninvalid="setCustomValidity('Debe ingresar rut sin dígito verificador')" oninput="setCustomValidity('')" required  style="width:48%">
					</div>
					<div class="col-md-6" style="padding-right: 0px">
						<label class="title_label">NOMBRE</label><br>				
						<input type="text" class="input_box_text_panel" value="@if(isset($usuario_editar->nombre)){{$usuario_editar->nombre}}@endif" name="nombre" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required  style="width:96%">
					</div>
					<div class="col-md-6" style="padding-left: 0px">
						<label class="title_label">APELLIDO PATERNO</label><br>				
						<input type="text" class="input_box_text_panel" value="@if(isset($usuario_editar->nombre)){{$usuario_editar->apellido_paterno}}@endif" name="apellido_paterno" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required  style="width:96%">
					</div>
					<label class="col-md-12 title_label">EMAIL</label>
					<div class="col-md-12">
						<input type="email" title="jjjjjjj" class="input_box_text_panel" value="@if(isset($usuario_editar->nombre)){{$usuario_editar->email}}@endif" required  name="email" style="width:98%"  id="maill">
					</div>
					<div class="col-md-6" style="padding-right: 0px">
						<label class="title_label_nueva_campania">PERFIL</label><br>

						<select id="select_perfil" class="select_box_body from_control" name="perfil" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:96%">
							<option value="">seleccionar...</option>
								@if(isset($usuario_editar->perfil_id))
									@if($usuario_editar->perfil_id==1)
									<option value="1" selected>Administrador</option>
									<option value="2" >Operador</option>
									<option value="3" >Editor</option>
									@elseif($usuario_editar->perfil_id==2)
									<option value="2" selected>Operador</option>
									<option value="1">Administrador</option>
									<option value="3" >Editor</option>							
									@elseif($usuario_editar->perfil_id==3)
									<option value="3" selected>Editor</option>
									<option value="1">Administrador</option>
									<option value="2" >Operador</option>
									@else
									<option value="1">Administrador</option>
									<option value="2" >Operador</option>
									<option value="3" >Editor</option>
									@endif
								@else
									<option value="1">Administrador</option>
									<option value="2" >Operador</option>
									<option value="3" >Editor</option>
								@endif

						</select>
						
					</div>
					<div class="col-md-6" style="padding-left: 0px">
						<label class="title_label_nueva_campania">ESTADO</label><br>
						<select id="select_estado" class="select_box_body" name="estado" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:96%">

			                    <option value="">seleccionar...</option>
			                    @if(isset($usuario_editar->estado))
				                    @if($usuario_editar->estado=='Activo')
				                      <option value="Activo" selected>Activo</option>
				                      <option value="Inactivo">Inactivo</option>
				                    @elseif($usuario_editar->estado=='Inactivo')
				                      <option value="Activo">Activo</option>
				                      <option value="Inactivo" selected>Inactivo</option>
				                    @else
				                      <option value="Activo">Activo</option>
				                      <option value="Inactivo">Inactivo</option>
				                    @endif
			                    @else
			                    <option value="Activo">Activo</option>
			                    <option value="Inactivo">Inactivo</option>
			                    @endif
						</select>
					</div>
					<label class="col-md-12 title_label">NOMBRE DE USUARIO</label>
					<div class="col-md-12">
						<input type="text" class="input_box_text_panel" value="@if(isset($usuario_editar->nombre)){{$usuario_editar->nombre_usuario}}@endif" name="nombre_usuario" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:48%">
						<div class="alert alert-danger" id="alerta_select" style="margin-top: 10px; visibility: collapse;">Para actualizar un usuario, debe completar todos los campos</div>
						<input type="hidden" name="id" value="@if(isset($usuario_editar->nombre)){{$usuario_editar->id}}@endif">
					</div>

					<div class="col-md-12" style="margin-top: -10px; " >
						<input id="actualizar" style="margin:0px; float:none" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="ACTUALIZAR">
					</div>
					
						
					
				</div>
			</div>
		</form>

		<form id="form_crear" method="POST" action="{{route('administrador_usuarios.store')}}">
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



@stop

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('js/jquery.numeric.js')}}"></script>
<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >

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