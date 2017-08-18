@extends('layout.base')

@section('titulo')
Nuevo universo
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

	<div class="jumbotron"> 
		Nuevo universo de notificación
	</div> 
	<form method="POST" action="{{route('nuevo_universo.store')}}">
		  		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="caja_altura" style="">
	  		<div style="height:100%">
	  			<div class="cajas_cabecera" style="">
	  				<p>Nuevo universo</p>
	  			</div>
			  	
			  			<div class="cajas_cuerpo" >
			  				<label class="col-md-12 title_label">Nombre</label>
							<div class="col-md-12">
								<input type="text" class="input_box_text" name="nombre" style="" required>
								
							</div>
							<label class="col-md-12 title_label">Descripción</label>
							<div class="col-md-12">
								<textarea name="comentario" rows="10" cols="40" class="input_caja_texto" style="" placeholder="Escribe tu Descripcion...." required></textarea>
							</div>

							<label class="col-md-12 title_label">Proceso</label>
							<div class="col-md-12 ocultar">
								<input id="input_proceso" type="text" class="input_box_text select_box_nuevo_proceso col-md-3" name="proceso_nuevo" style="width:25%; margin-right:2px">
								<input id="btn_volver_proceso" style="margin:0px; float:none; width:90px" class="btn btn-danger btn-sm input_btn_buscar_admin_user col-md-3" type="" value="CANCELAR">
							</div>
							<div class="col-md-12 ocultar_nuevo">
								<select id="select_proceso" class="select_box_nuevo_proceso" name="proceso">
								
								@foreach($procesos as $proceso)
									<option value="{{$proceso->proceso}}">{{$proceso->proceso}}</option>
								@endforeach


								</select>
								<input id="btn_nuevo_proceso" style="margin:0px; float:none; width:80px" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="" value="NUEVO">
							</div>
							<input type="text" value="{{$request->asunto}}" name="asunto" style="display:none">
							<input type="text" value="{{$request->mensaje}}" name="mensaje" style="display:none">
							<input type="text" value="{{$request->tipo_campania}}" name="tipo_campania" style="display:none">
			  			</div>
			  		</div>
			  	</div>
			  	<div class="col-md-12" style="margin:5px 0px 5px 0px; ">
					<input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="CREAR">

			
			<a href="javascript:history.go(-1)"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="VOLVER"></a>	
			

		</div>
	</form>


</div>


@stop

 <script type="text/javascript"  src="{{url('js/jquery-3.1.1.min.js')}}"></script>
  <script src="{{url('js/bootstrap.min.js')}}"></script>  
  <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >

  	<script type="text/javascript">
		$(document).ready(function(){
			$("#campanias").css('background', '#0091c2');
			$(".ocultar").css("display","none");
			$("#btn_nuevo_proceso").click(function(){
				$("#input_proceso").attr("required","required");
				$(".ocultar_nuevo").css("display","none");
				$(".ocultar").css("display","block");
			});
			$("#btn_volver_proceso").click(function(){
				$("#input_proceso").removeAttr("required");
				
				$(".ocultar_nuevo").css("display","block");
				$(".ocultar").css("display","none");
			});
		});		
	</script>