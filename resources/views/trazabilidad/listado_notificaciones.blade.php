@extends('layout.base')

@section('titulo')
Control Individual
@stop

@section('contenido')
@parent
<link rel="stylesheet" href="css/jquery-ui.css">

<div class="container-fluid">
	<div class="row" style="margin-bottom:10px">
	<div class="jumbotron" style="margin-bottom: 0px; border-radius:5px 5px 0px 0px;"> 
		Listado de Notificaciones
	</div> 
	<div class="col_md-12">
		<div class="cajas_cabecera_admin_usuario" style="">
			<form action="filtro_listado_notificaciones" method="GET">
				<div class="row">
				
					<div class="col-md-1" style="width:7%; padding:0px 0px 0px 5px">
							<label style="margin:0px">ID NOTIFICACIÓN</label><br>
							<input type="text" value="{{$request->notificacion_id}}" name="notificacion_id" style="width:100%">
						</div>
						<div class="col-md-1" style="width:12%">
							<label style="margin:0px">RUT</label><br>
							<input type="text" id="rut" value="{{$request->rut_beneficiario}}" name="rut_beneficiario">
						</div>
						<div class="col-md-1" style="width:12%">
							<label style="margin:0px">ASUNTO</label><br>
							<input type="text" value="{{$request->asunto}}" name="asunto">
						</div>
						<div class="col-md-1" style="width:12%">
							<label style="margin:0px">PROCESO</label><br>
							<div class="caja_select">
								<select type="" name="proceso" >
									<option value="">Todos</option>
									@foreach($procesos as $proceso)
										@if($request->proceso==$proceso->proceso)
										<option value="{{$proceso->proceso}}" selected="true">{{$proceso->proceso}}</option>
										@else
					                    <option value="{{$proceso->proceso}}">{{$proceso->proceso}}</option>
					                    @endif
					                @endforeach
								</select>
							</div>
							</div>
						<div class="col-md-1" style="width:12%">
							<label style="margin:0px">UNIVERSO</label><br>
							<div class="caja_select">
								
								<select type="" name="universo" >
									<option value="">Todos</option>								
									@foreach($universos as $universo)
										@if($request->universo==$universo->nombre_universo)
											<option value="{{$universo->nombre_universo}}" selected="true">{{$universo->nombre_universo}}</option>
										@else 
					                    	<option value="{{$universo->nombre_universo}}">{{$universo->nombre_universo}}</option>
					                    @endif

					                @endforeach
								</select>
							</div>
						</div>
						<div class="col-md-1" style="width:12%">
							<label style="margin:0px">TIPO</label><br>
							<div class="caja_select">
								<select type="" name="tipo_campania">
									<option value="">Todos</option>
									@if($request->tipo_campania=='automatica')
										<option value="automatica" selected>Automatica</option>
										<option value="manual">Manual</option>
									@elseif($request->tipo_campania=='manual')
										<option value="automatica">Automatica</option>
										<option value="manual" selected>Manual</option>
									@else
										<option value="automatica">Automatica</option>
										<option value="manual">Manual</option>
									@endif
								</select>
							</div>
						</div>
						<div class="col-md-1 filtros_fechas" style="">
							<label style="margin:0px">FECHA ENVÍO DESDE</label><br>
							<input class="datepicker" type="text" value="{{$request->fecha_desde}}" name="fecha_desde" style="width:100%">
						</div>
						<div class="col-md-1" style="width:12%">
							<label style="margin:0px">FECHA HASTA</label><br>
							<input class="datepicker" type="text" value="{{$request->fecha_hasta}}" name="fecha_hasta" style="width:100%">
						</div>
						<div>
							<input style="width:80px" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="BUSCAR">
						</div>
					</div>
				</form>
		</div>
	</div>
	</div>
<form action="exportar_notificaciones" method="GET">
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
	        @foreach($notificaciones as $key => $notificacion)
	            <tr>
	            <center>
	                <td>{{$notificacion->notificaciones_id}}</td>
	                <td>{{$notificacion->asunto}}</td>
	                <td>{{$notificacion->proceso}}</td>
	                <td>{{$notificacion->nombre_universo}}</td>
	                <td>{{$totales[$key]}}</td>
	                <td>{{$reales[$key]}}</td>
	                <td>{{$lecturas[$key]}}</td>
	                <td>{{$notificacion->fecha_envio}}</td>
	                <td><a href="{{url('detalle',$notificacion->notificaciones_id)}}"><img style="width:20px;" src="{{url('img/LUPA.png')}}"></a></td>
	                <td><input class="" type="checkbox" name="check_notificaciones_id[]" value="{{$notificacion->notificaciones_id}}" style="margin:0px; height:12px; width:12px" ></td>
	                </center>
	                
	            </tr>
	          @endforeach
	        </tbody>

	    </table>
	    
	    <div>
	        @if($notificaciones->render())
	    	{!!$notificaciones->render()!!}
	    @endif
	        
	        <input style="width:340px" class="btn btn-danger btn-sm  input_btn_buscar_admin_user exportar" type="submit" value="DESCARGAR REPORTE GENERAL DE NOTIFICACIONES">
	    </div>

	</div>
</form>


</div>

@stop

  <script type="text/javascript"  src="{{url('js/jquery-3.1.1.min.js')}}"></script>
    
  <script src="{{url('js/bootstrap.min.js')}}"></script> 
 
  <script src="{{url('js/nueva_campania.js')}}"></script>  

  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >

  <script type="text/javascript">
   $(document).ready(function(){
    $("#trazabilidad").css('background', '#0091c2');

 	
    
  });

  
    
  </script>
</body>
</html>