@extends('layout.base')

@section('titulo')
Agregar campaña
@stop

@section('contenido')

@parent
<link rel="stylesheet" href="{{url('css/jquery-ui.css')}}">


<div class="container-fluid">


@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
@endif


<div id="fechas" class="alert alert-danger" style="display:none">La fecha tiene un formato incorrecto
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
<div id="diaSemana" class="alert alert-danger" style="display:none">Ingresar día de la semana es obligatorio
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
<div id="valida_descripcion" class="alert alert-danger" style="display:none"></div>

	<div class="jumbotron">
		Agregar campaña
	</div>
	<form method="POST" action="{{route('nueva_campana.store')}}" id="universo_manual" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="row">

			<div class="col-md-4" style="padding:0px 4px 0px 0px">
				<div class="cajas_altura_paneles">
					<div class="col-md-12">
						<label style="font-weight: bold; margin:10px 0px 10px 0px">Información de campaña</label>
					</div>
					<label class="col-md-12 title_label">Asunto</label>
					<div class="col-md-12">
						@if(isset($request))
						<input type="text" id="asunto" class="input_box_text_panel" name="asunto" value="{{$request->asunto}}" style="width:95%" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>
						@else
						<input type="text" id="asunto" class="input_box_text_panel" name="asunto" value="" style="width:95%" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>
						@endif
					</div>

					<label class="col-md-12 title_label">Mensaje</label>
					<div class="col-md-12">
					@if(isset($request->mensaje))
						<textarea name="comentario" id="mensaje" rows="10" cols="40" style="resize:none; width:95%; height:130px;border:none;" placeholder="Escribe tu comentario...." oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>{{$request->mensaje}}</textarea>
					@else
						<textarea name="comentario" id="mensaje" rows="10" cols="40" style="resize:none; width:95%; height:130px;border:none;" placeholder="Escribe tu comentario...." oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required></textarea>
					@endif
					</div>


					<div class="col-md-6" style="width:130px">
						<label class="title_label_nueva_campania">Tipo</label><br>
						<select id="select_tipo" name="tipo_campania" class="select_box_body" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>
							<option value="">Seleccionar...</option>
							@if(isset($request->tipo_campania))
							<option value="automatica" selected>Automática</option>
							@else
							<option value="automatica">Automática</option>
							@endif
							<option value="manual">Manual</option>

						</select>

					</div>
<!--++++++++++++++++++++++++++++++++++++inicio campania automatica++++++++++++++++++++++++++++++++++++-->
					<div id="automatica_div" class="ocultar_tipo">

						<div class="col-md-6" >

							<label class="title_label_nueva_campania">Proceso</label>	<br>

							<select id="select_proceso" name="proceso" class="select_box_body" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" >
								<option value="">seleccionar...</option>
								@if(isset($proceso_actual))
									<option id="{{$proceso_actual->id}}" value="{{$proceso_actual->proceso}}" selected>{{$proceso_actual->proceso}}</option>
								@endif
								@foreach($procesos as $proceso)
									@if($proceso->id!=1)
									<option id="{{$proceso->id}}" value="{{$proceso->proceso}}" >{{$proceso->proceso}}</option>
									@endif
								@endforeach
							</select>
						</div>

						<label class="col-md-12 title_label">Universo</label>
						<div class="col-md-12">
							<select id="select_universo" name="universo" class="select_box_body_universo" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" >
								<option value="">seleccionar...</option>
							</select>

							<a id="nuevo_universo"><input style="margin:0px; float:none; width:80px" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="" value="NUEVO"></a>
						</div>
						<div class="col-md-12"><label class="title_label" style="margin-bottom: 10px">Descripción del universo</label></div>
						<div class="col-md-12">
							<p id="descripcion_universo" style="font-size: 9px; font-weight: bold"></p>
						</div>
					</div>
<!--++++++++++++++++++++++++++++++++++++fin campania automatica++++++++++++++++++++++++++++++++++++-->

<!--++++++++++++++++++++++++++++++++++++inicio campania manual++++++++++++++++++++++++++++++++++++-->
					<div id="manual_div" class="ocultar_tipo col-md-12" style="padding:0px">
						<label class="col-md-12 title_label">Universo</label>
						<div class="col-md-12">
							<div class="col-md-5 ajuste" >
								<input class="" value="" id="id_universo_manual"  name="" >
								<input style="display:none"  id="uni_man" value="no">
							</div>
							<div class="col-md-7 ajuste">

								<span class="">
									<input style="padding:0px; width: 48%" type="file" class="btn" id="carga_universo" name="carga_universo" multiple data-idcarga="1">
								</span>

							</div>
						</div>
						<label class="col-md-12 title_label">Descripción</label>
						<div class="col-md-12">
							<textarea id="descripcion_manual" name="descripcion_manual" rows="10" cols="40" style="resize:none; width:95%; height:60px;border:none;" placeholder="Descripción universo...."  oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')"></textarea>

						</div>

					</div>
	<!--++++++++++++++++++++++++++++++++++++fin campania manual++++++++++++++++++++++++++++++++++++-->

				</div>
			</div>
			<style>

              .espacio{
                margin-left: 5px;
              }
            </style>


			<div class="col-md-4" style="padding:0px 2px 0px 2px">
				<div class="cajas_altura_paneles">
					<div class="col-md-12">
						<label style="font-weight: bold; margin:10px 0px 10px 0px">Frecuencia</label>
					</div>
					<label class="col-md-12 title_label">Repetir</label>
					<div class="col-md-12">
						<select id="select_repetir_cada" name="frecuencia" class="select_box_body_universo" style="width:100%" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>
							<option value="">Seleccionar...</option>

							<option value="por_dia">Diario</option>
							<option value="por_semana">Semanal</option>
							<option value="por_mes">Mensual</option>
							<option value="por_anio">Anual</option>

						</select>
					</div>
					<div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
					<div id="frecuencia">

<!-- ++++++++++++++++++++++++++++++inicio por dia ++++++++++++++++++++++++++++++++++++++++++-->
						<div id="por_dia_div" class="ocultar">
							<label class="col-md-12 title_label">Repetir cada</label><br>
							<div class="col-md-12">

								<input class="input_box_text_panel col-md-12 input_numeros ciclo_dias" maxlength="4" style="width:15%" type="text" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required id="">

								<label class="title_label espacio">Días</label>
							</div>
						</div>
<!-- ++++++++++++++++++++++++++++++fin por dia ++++++++++++++++++++++++++++++++++++++++++-->

<!-- ++++++++++++++++++++++++++++++inicio por semana ++++++++++++++++++++++++++++++++++++++++++-->
						<div id="por_semana_div" class="ocultar">
							<label class="col-md-12 title_label">Repetir cada</label><br>
							<div class="col-md-12">
								<input class="input_box_text_panel input_numeros ciclo_semanas input_semanas" maxlength="4" style="width:15%" type="text" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required name="" id="">
								<label class="title_label col-md-12" style="padding:0px">Semana el</label>
							</div>
							<div class="col-md-12">
								<form action="demo_form.asp" method="get">

									<div class="col-md-12"><input class="col-md-2 ciclo_semanas check" style="width:15px; height:15px;margin-top:7px;" type="checkbox" value="lunes"><div class="col-md-2 label_check_box">Lunes</div></div>

									<div class="col-md-12"> <input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox" value="martes" > <div class="col-md-2 label_check_box" >Martes</div></div>

									<div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"  value="miercoles"><div class="col-md-2 label_check_box" >Miércoles</div></div>

									<div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"  value="jueves" ><div class="col-md-2 label_check_box" >Jueves</div></div>

									<div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox" value="viernes"><div class="col-md-2 label_check_box" >Viernes</div></div>

									<div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"  value="sabado" ><div class="col-md-2 label_check_box" >Sábado</div></div>

									<div class="col-md-12"><input class="col-md-2 ciclo_semanas check"  style="width:15px; height:15px;margin-top:7px;" type="checkbox"  value="domingo"><div class="col-md-2 label_check_box" >Domingo</div></div>

								</form>
							</div>
						</div>

<!-- ++++++++++++++++++++++++++++++fin por semana ++++++++++++++++++++++++++++++++++++++++++-->

<!-- ++++++++++++++++++++++++++++++inicio por mes ++++++++++++++++++++++++++++++++++++++++++-->
						<div id="por_mes_div" class="ocultar">
							<label class="col-md-12 title_label">Indique ciclo</label><br>
							<div class="col-md-12">
								<select class="select_box_body_universo ciclo_meses" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required id="select_mensual_dia_semana" style="width:50%" >
									<option value="">Seleccionar...</option>
									<option value="dia_del_mes">Día del mes</option>
									<option value="dia_semana_mes">Día de la semana del mes</option>
								</select>
							</div>
							<div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
<!-- ++++++++++++++++++++++++++++++inicio dia del mes ++++++++++++++++++++++++++++++++++++++++++-->
							<div id="dia_del_mes_div" class="ocultar_mensual" >
								<label class="col-md-12 title_label">Repetir el día</label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo mes_borrar_0 ciclo_meses" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:20%" >
										<option value="">0</option>
										<?php for($i=1;$i<31;$i++){?>
										<option  value="<?= $i?>"><?= $i ?></option>
										<?php }?>
									</select>

								</div>
								<label class="col-md-12 title_label">Cada</label><br>
								<div class="col-md-12">
									<input class="input_box_text_panel col-md-12 input_numeros mes_borrar_0 ciclo_meses"  maxlength="4" style="width:15%" type="text" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required id="">
									<label class="title_label espacio">Meses</label>
								</div>
							</div>

<!-- ++++++++++++++++++++++++++++++fin dia del mes ++++++++++++++++++++++++++++++++++++++++++-->

<!-- ++++++++++++++++++++++++++++++inicio semana del mes ++++++++++++++++++++++++++++++++++++++++++-->


							<div id="dia_semana_mes_div" class="ocultar_mensual" >
								<label class="col-md-12 title_label">Repetir el</label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo mes_borrar_1 ciclo_meses" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required style="width:20%" >

										<option value="primer">Primer</option>
										<option value="segundo">Segundo</option>
										<option value="tercer">Tercer</option>
										<option value="cuarto">Cuarto</option>
										<option value="ultimo">Último</option>

									</select>
								</div>
								<label class="col-md-12 title_label">Día</label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo mes_borrar_1 ciclo_meses"  style="width:30%" >

										<option value="lunes">Lunes</option>
										<option value="martes">Martes</option>
										<option value="miercoles">Miércoles</option>
										<option value="jueves">Jueves</option>
										<option value="viernes">Viernes</option>
										<option value="sabado">Sábado</option>
										<option value="domingo">Domingo</option>
									</select>
								</div>
								<label class="col-md-12 title_label">Cada</label><br>
								<div class="col-md-12">
									<input class="input_box_text_panel col-md-12 input_numeros mes_borrar_1 ciclo_meses" maxlength="4" style="width:15%" type="text" id="">
									<label class="title_label espacio">Meses</label>
								</div>
							</div>

<!-- ++++++++++++++++++++++++++++++fin semana del mes ++++++++++++++++++++++++++++++++++++++++++-->

						</div>

<!-- ++++++++++++++++++++++++++++++fin por mes ++++++++++++++++++++++++++++++++++++++++++-->


<!-- ++++++++++++++++++++++++++++++inicio por anio ++++++++++++++++++++++++++++++++++++++++++-->

						<div id="por_anio_div" class="ocultar">
							<label class="col-md-12 title_label">Repetir cada</label><br>
							<div class="col-md-12">
								<input class="input_box_text_panel col-md-12 input_numeros ciclo_anios"  maxlength="4" style="width:15%" type="text" id="">
								<label class="title_label espacio">años</label>
							</div>

							<div class="col-md-12">
								<select class="select_box_body_universo ciclo_anios"  id="select_anual_dia_mes" style="width:50%; margin-top: 10px" >
									<option value="">Seleccionar...</option>
									<option value="por_anio_dia_mes">Día del mes</option>
									<option value="por_anio_dia_semana_mes">Día de la semana del mes</option>

								</select>
							</div>
							<div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
<!-- ++++++++++++++++++++++++++++++inicio por dia del mes ++++++++++++++++++++++++++++++++++++++++++-->
							<div id="por_anio_dia_mes_div" class="ocultar_anual">
								<label class="col-md-12 title_label">El</label><br>
								<div class="col-md-12">
									<select id="dia_mes_mes" class="select_box_body_universo anio_borrar_0 ciclo_anios" style="width:20%" >
										<option value="">0</option>
										<?php for($i=1;$i<31;$i++){?>
										<option value="<?= $i?>"><?= $i ?></option>
										<?php }?>
									</select>

								</div>
								<label class="col-md-12 title_label">Del mes de</label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo anio_borrar_0 ciclo_anios" id="select_meses"  style="width:30%" >

										<option value="enero">Enero</option>
										<option value="febrero">Febrero</option>
										<option value="marzo">Marzo</option>
										<option value="abril">Abril</option>
										<option value="mayo">Mayo</option>
										<option value="junio">Junio</option>
										<option value="julio">Julio</option>
										<option value="agosto">Agosto</option>
										<option value="septiembre">Septiembre</option>
										<option value="octubre">Octubre</option>
										<option value="noviembre">Noviembre</option>
										<option value="diciembre">Diciembre</option>

									</select>
								</div>

							</div>
<!-- ++++++++++++++++++++++++++++++fin por dia del mes ++++++++++++++++++++++++++++++++++++++++++-->

<!-- +++++++++++++++++++++++inicio por dia la semana del mes ++++++++++++++++++++++++++++++++++++++++++-->
							<div id="por_anio_dia_semana_mes_div" class="ocultar_anual">
								<label class="col-md-12 title_label">El</label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo anio_borrar_1 ciclo_anios"  style="width:30%" >

										<option value="primer">Primer</option>
										<option value="segundo">Segundo</option>
										<option value="tercer">Tercer</option>
										<option value="cuarto">Cuarto</option>
										<option value="ultimo">Último</option>

									</select>
								</div>
								<label class="col-md-12 title_label"></label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo anio_borrar_1 ciclo_anios" style="width:30%" >

										<option value="lunes">Lunes</option>
										<option value="martes">Martes</option>
										<option value="miercoles">Miércoles</option>
										<option value="jueves">Jueves</option>
										<option value="viernes">Viernes</option>
										<option value="sabado">Sábado</option>
										<option value="domingo">Domingo</option>

									</select>
								</div>
								<label class="col-md-12 title_label">De</label><br>
								<div class="col-md-12">
									<select class="select_box_body_universo anio_borrar_1 ciclo_anios"  style="width:30%" >

										<option value="enero">Enero</option>
										<option value="febrero">Febrero</option>
										<option value="marzo">Marzo</option>
										<option value="abril">Abril</option>
										<option value="mayo">Mayo</option>
										<option value="junio">Junio</option>
										<option value="julio">Julio</option>
										<option value="agosto">Agosto</option>
										<option value="septiembre">Septiembre</option>
										<option value="octubre">Octubre</option>
										<option value="noviembre">Noviembre</option>
										<option value="diciembre">Diciembre</option>

									</select>
								</div>

							</div>
<!-- ++++++++++++++++++++++++++++++fin por dia de la semana del mes ++++++++++++++++++++++++++++++++++++-->


						</div>


<!-- ++++++++++++++++++++++++++++++fin por anio ++++++++++++++++++++++++++++++++++++++++++-->

					</div>
				</div>

			</div>


			<div class="col-md-4" style="padding:0px 0px 0px 4px">
				<div class="cajas_altura_paneles">
					<div class="col-md-12">
						<label style="font-weight: bold; margin:10px 0px 10px 0px">Intervalo de repetición</label>
					</div>
					<label class="col-md-12 title_label">Comienza</label><br>
					<div class="col-md-12">
						<input class="input_box_text_panel col-md-12 datepicker"  name="fecha_inicio" type="text" id="selector" required>
					</div>
					<label class="col-md-12 title_label">Finaliza</label><br>
					<div class="col-md-12">
						<select id="select_intervalo" class="select_box_body_universo " name="tipo_intervalo" style="width:100%" >
							<option value="sin_fecha">Sin fecha de finalización</option>
							<option value="finaliza_despues_de">Finaliza después de</option>
							<option value="finaliza_el">Finaliza el</option>

						</select>

					</div>
					<div class="col-md-12"><label class="col-md-12 " style="border-bottom: solid 1px #8e9091; margin-top: 10px"></label></div>
<!-- +++++++++++++++++++++++inicio intervalo finaliza despues de++++++++++++++++++++++++++++++++++++++-->
					<div id="finaliza_despues_de_div" class="ocultar_intervalo ">
						<div class="col-md-12">

							<input class="input_box_text_panel col-md-12 input_numeros intervalo_borrar_0"  maxlength="4" style="width:15%" type="text" id="">

							<label class="title_label espacio">Repeticiones</label>
						</div>
					</div>
<!-- +++++++++++++++++++++++++fin intervalo finaliza despues de+++++++++++++++++++++++++++++++++++++-->

<!-- ++++++++++++++++++++++++++++++inicio intervalo finaliza el++++++++++++++++++++++++++++++++++++++-->
					<div id="finaliza_el_div" class="ocultar_intervalo">
						<div class="col-md-12">
							<input id="fecha_fin" class="input_box_text_panel col-md-12 datepicker intervalo_borrar_1" type="text" name="fecha_fin">
						</div>
					</div>
<!-- ++++++++++++++++++++++++++++++fin intervalo finaliza el+++++++++++++++++++++++++++++++++++++++++-->


				</div>
			</div>

			<input type="text" id="id_universo_manual_construir" style="display:none">

			<div class="col-md-12" style="margin:5px 0px 5px 0px; ">
				<input style="" id="guardar" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">
				<a href="{{url('listado_campanas')}}"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="VOLVER"></a>

			</div>
		</form>







	</div>

	@stop





	<script type="text/javascript"  src="{{url('js/jquery-3.1.1.min.js')}}"></script>
	<script src="{{url('js/nueva_campania.js')}}"></script>

	<script src="{{url('js/bootstrap.min.js')}}"></script>
	<script src="{{url('js/jquery-1.12.4.js')}}"></script>
	<script src="{{url('js/jquery-ui.js')}}"></script>
	<script src="{{url('js/jquery.numeric.js')}}"></script>
	<script src="{{url('js/formato_fechas.js')}}"></script>
	<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >



	<script type="text/javascript">
		$(document).ready(function(){
		var cambia=false;

		if($("#select_meses").val()=="febrero")
				{

					$("#dia_mes_mes option[value='30']").remove();
					$("#dia_mes_mes option[value='29']").remove();
					cambia=true;
				}
			$("#select_meses").change(function()
			{

				if($("#select_meses").val()=="febrero")
				{

					$("#dia_mes_mes option[value='30']").remove();
					$("#dia_mes_mes option[value='29']").remove();
					cambia=true;
				}else
				{
					if(cambia)

					{
						$("#dia_mes_mes").append("<option value='29'>29</option>");
					$("#dia_mes_mes").append("<option value='30'>30</option>");

					}


				}
			});


			/*$('#carga_universo').click(function() {
			if(!$("#descripcion_manual").val())
				{

					$("#valida_descripcion").text("Debe ingresar descripción del universo para guardar en base de datos");
					$("#valida_descripcion").css("display","block");
					setTimeout(function(){$("#valida_descripcion").css("display","none")},3000);
					return false;

				}
			});*/
			$('#carga_universo').change(function() {

					var formData = new FormData(document.getElementById("universo_manual"));
					var valor=$("#carga_universo").val();
					var url = "{{url('/universo_manual')}}";
					$.ajax({
						url : url,
						type : "post",
						data : formData,
						dataType: 'json',
						cache: false,
						contentType: false,
						processData: false,
					}).done(function(data) {

						if(data.extension=="xls" && data.formato=="correcto"){

							$("#id_universo_manual_construir").attr("name","universo_id");
							$("#id_universo_manual_construir").val(data.universo_id);
							$("#id_universo_manual").val(data.universo);
								$("#uni_man").val("si");


							//$("#id_universo_manual").attr("disabled","disabled");
		            		//alert(data.universo);
		            		/*
		            		$("#valida_descripcion").css("display","none");
			            	$("#select_universo_manual").append("<option value='"+data.universo_id+"'>"+data.universo+"</option>");

							$("#select_universo_manual option[value= "+data.universo_id+"]").attr("selected",true);

			            	console.log($("#select_universo_manual option[value="+data.universo_id+"]").text());
			            	*/
			            }else
			            {
			            	$("#valida_descripcion").text("El formato del archivo es incorrecto, debe ser xls y poseer una cabecera rut");
			            	$("#valida_descripcion").css("display","block");
			            	$("#carga_universo").val("");
			            	setTimeout(function(){$("#valida_descripcion").css("display","none")},10000);
			            }
			        });


			});

			$("#nuevo_universo").click(function()
			{
				//alert($("#mensaje").val());
				window.location.href = "{{route('nuevo_universo.create')}}?asunto="+$("#asunto").val()+"&mensaje="+$("#mensaje").val()+"&tipo_campania=automatica";

			});


			if($("#select_tipo").val()=="manual")
				{
					$("#select_proceso").removeAttr("required");
					$("#descripcion_manual").attr('required', 'required');
					$("#uni_man").attr("name","universo_manual");
					$("#uni_man").val("dentro");

				}else
				{
					$("#select_proceso").attr("required",true);
					$("#descripcion_manual").removeAttr('required');
					$("#uni_man").removeAttr("name");
					$("#uni_man").val("fuera");

				}

			$("#select_tipo").change(function(){
				if($("#select_tipo").val()=="manual")
				{

					$("#select_proceso").removeAttr("required");
					$("#descripcion_manual").attr('required', 'required');
					$("#uni_man").attr("name","universo_manual");
					$("#uni_man").val("dentro");


				}else
				{
					$("#select_proceso").attr("required",true);
					$("#descripcion_manual").removeAttr('required');
					$("#uni_man").removeAttr("name");
					$("#uni_man").val("fuera");
				}
			});



			$(".input_numeros").numeric({ decimal: false, negative: false });

			$("#campanias").css('background', '#0091c2');
			var dato= $('#select_proceso option:selected').attr('id');

			$.ajax({
				url:"{{route('nueva_campana.index')}}",
				data:{dato:dato},
				success: function(result){
					//console.log(result.universos[0].id);
					console.log(result);
					$.each( result.universos, function( key, value ) {
						  //alert( key + ": " + value.nombre );

						  if(value.tipo_universo!="manual")
						  {
						  	$('#select_universo').append('<option id="'+value.descripcion+'" value="'+value.id+'" selected="selected">'+value.nombre_universo+'</option>');
						  	$('#descripcion_universo').text($('#select_universo option:selected').attr('id'));

						  }

						});


				}
			});
			$('#select_proceso').change(function(){

				var dato= $('#select_proceso option:selected').attr('id');
				$('#select_universo option').each(function() {
					$(this).remove();
				});

				$.ajax({
					url:"{{route('nueva_campana.index')}}",
					data:{dato:dato},
					success: function(result){
						//console.log(result.universos[0].id);


						$.each( result.universos, function( key, value ) {
							 // alert( key + ": " + value.nombre );

							 if(value.tipo_universo!="manual")
							 {

							 	$('#select_universo').append('<option id="'+value.descripcion+'" value="'+value.id+'" selected="selected">'+value.id+' | '+value.nombre_universo+'</option>');
							 	$('#descripcion_universo').text($('#select_universo option:selected').attr('id'));

							 }

							});


					}
				});
			});

			var dato= $('#select_proceso option:selected').attr('id');
				$('#select_universo option').each(function() {
					$(this).remove();
				});

				$.ajax({
					url:"{{route('nueva_campana.index')}}",
					data:{dato:dato},
					success: function(result){
						//console.log(result.universos[0].id);


						$.each( result.universos, function( key, value ) {
							 // alert( key + ": " + value.nombre );

							 if(value.tipo_universo!="manual")
							 {

							 	$('#select_universo').append('<option id="'+value.descripcion+'" value="'+value.id+'" selected="selected">'+value.id+' | '+value.nombre_universo+'</option>');
							 	$('#descripcion_universo').text($('#select_universo option:selected').attr('id'));

							 }

							});


					}
				});


			$('#descripcion_universo').text($('#select_universo option:selected').attr('id'));
			$('#select_universo').change(function(){
				$('#descripcion_universo').text($('#select_universo option:selected').attr('id'));
			});

//alert("carga d ready");

$("#universo_manual").submit(function()
{

	if($("#uni_man").val()=="dentro")
        {
            $("#valida_descripcion").text("Debe cargar un archivo");
			$("#valida_descripcion").css("display","block");
			setTimeout(function(){$("#valida_descripcion").css("display","none")},3000);
			return false;
        }


	if($("#select_repetir_cada").val()=="por_semana")
	{
		if(!$(".check").is(":checked"))
		{
			$("#diaSemana").css("display","block");
			return false;
		}


	}

	if(validaFechaDDMMAAAA($("#selector").val()))
	{

		if($("#fecha_fin").attr("name")=="finaliza_el")
		{
			if(validaFechaDDMMAAAA($("#fecha_fin").val()))
			{

				return true;
			}
			else
			{
				$("#fechas").css("display","block");
				return false;
			}
		}
		return true;
	}
	else
		$("#fechas").css("display","block");

	return false;

})


		});

	</script>


</body>
</html>
