@extends('layout.base')

@section('titulo')
Notificaciones por RUT
@stop

@section('contenido')
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
						<input type="text" value="{{$request->rut}}" name="rut">
					</div>
					<div class="col-md-1" style="width:7%; padding:0px 0px 0px 5px">
						<label style="margin:0px">ID NOTIFICACIÓN</label><br>
						<input type="text" value="{{$request->notificacion_id}}" style="width:100%" name="notificacion_id">
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
								hola
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
						<label style="margin:0px">FECHA ENVIO DESDE</label><br>
						<input class="datepicker" type="text" value="{{$request->fecha_desde}}" name="fecha_desde" style="width:100%">
					</div>
					<div class="col-md-1" style="width:12%">
						<label style="margin:0px">HASTA</label><br>
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
       
        @foreach($notificaciones_por_rut as $notificacion)
            <tr>
                <td>{{$notificacion->rut_beneficiario}}</td>
                <td>{{$notificacion->nombres}}</td>
                <td>{{$notificacion->apellidos}}</td>
                <td>{{$notificacion->campania_id}}</td>
                <td>{{$notificacion->notificacion_id}}</td>
                <td>{{$notificacion->asunto}}</td>
                <td>{{$notificacion->nombre_universo}}</td>
                <td>{{$notificacion->proceso}}</td>
                <td>{{$notificacion->enviado}}</td>
                <td>{{$notificacion->notificaciones_fecha_envio}}</td>
                <td>{{$notificacion->leido}}</td>
                @if(!$notificacion->fecha_leido)
               <center> <td id="fecha_leido">-</td> </center>
                @else
                <td>{{$notificacion->fecha_leido}}</td>
                @endif
            </tr>
          @endforeach
       
        </tbody>

    </table>
    
    <div>
        @if($notificaciones_por_rut->render())
	    	{!!$notificaciones_por_rut->render()!!}
	    @endif
        
        <a href="{{url('exportar_listado_individual'.$filtros)}}"><input style="width:380px" class="btn btn-danger btn-sm  input_btn_buscar_admin_user exportar" type="submit" value="DESCARGAR REPORTE INDIVIDUAL DE NOTIFICACIONES"></a>

    </div>
</div>

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