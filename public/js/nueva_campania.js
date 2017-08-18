$(document).ready(function(){

 		

	$( "#select_repetir_cada" ).change(function() {


 		$(".ocultar").css("display","none");

 		$("#"+$(this).val()+'_div').css("display","block");

 		if($( "#select_repetir_cada" ).val()=="por_dia"){
 			$('.ciclo_semanas').removeAttr("name");
 			$('.ciclo_meses').removeAttr("name");
 			$('.ciclo_anios').removeAttr("name");
 			$( ".ciclo_dias" ).attr('name',$("#select_repetir_cada").val()+"[]");

 			$('.ciclo_meses').removeAttr("required");
 			$('.ciclo_anios').removeAttr("required");
 			$( ".input_semanas" ).removeAttr("required");
 			$( ".ciclo_dias" ).attr("required","true");

		}else{
			if($( "#select_repetir_cada" ).val()=="por_semana"){
				$('.ciclo_dias').removeAttr("name");
				$('.ciclo_meses').removeAttr("name");
				$('.ciclo_anios').removeAttr("name");
				$( ".ciclo_semanas" ).attr('name',$("#select_repetir_cada").val()+"[]");

				$('.ciclo_dias').removeAttr("required");
	 			$('.ciclo_meses').removeAttr("required");
	 			$('.ciclo_anios').removeAttr("required");
	 			$( ".input_semanas" ).attr("required","true");

	 			$(".ocultar_mensual").css("display","none");
	


			}else{
				if($( "#select_repetir_cada" ).val()=="por_mes"){

					$('.ciclo_dias').removeAttr("name");
					$('.ciclo_semanas').removeAttr("name");
					$('.ciclo_anios').removeAttr("name");
					$( ".ciclo_meses" ).attr('name',$("#select_repetir_cada").val()+"[]");

					$('.ciclo_dias').removeAttr('required');
		 			$('.ciclo_anios').removeAttr('required');
		 			$( ".input_semanas" ).removeAttr('required');
		 			$('.ciclo_meses').attr("required","true");

		 			$("#"+$( "#select_mensual_dia_semana" ).val()+"_div").css("display","block");

					if($( "#select_mensual_dia_semana" ).val()=="dia_del_mes"){
				 			$('.mes_borrar_1').removeAttr("name");
				 			$( ".mes_borrar_0" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

				 			$('.mes_borrar_1').removeAttr("required");
				 			$( ".mes_borrar_0" ).attr('required',"true");

						}else{
							$('.mes_borrar_0').removeAttr("name");
							$( ".mes_borrar_1" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

							$('.mes_borrar_0').removeAttr("required");
				 			$( ".mes_borrar_1" ).attr('required',"true");
						}
				}else{

					$('.ciclo_dias').removeAttr("name");
					$('.ciclo_semanas').removeAttr("name");
					$('.ciclo_meses').removeAttr("name");
					$( ".ciclo_anios" ).attr('name',$("#select_repetir_cada").val()+"[]");

					$('.ciclo_dias').removeAttr('required');
		 			$('.ciclo_meses').removeAttr('required');
		 			$( ".input_semanas" ).removeAttr('required');
		 			$('.ciclo_anios').attr("required","true");

		 			$("#"+$(this).val()+"_div").css("display","block");


			 		if($( "#select_anual_dia_mes" ).val()=="por_anio_dia_mes"){
			 			$('.anio_borrar_1').removeAttr("name");
			 			$( ".anio_borrar_0" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

			 			$('.anio_borrar_1').removeAttr("required");
			 			$( ".anio_borrar_0" ).attr('required',"true");

					}else{
						$('.anio_borrar_0').removeAttr("name");
						$( ".anio_borrar_1" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

						$('.anio_borrar_0').removeAttr("required");
			 			$( ".anio_borrar_1" ).attr('required',"true");
					}


					
				}

			}
		}
	});

	$(".ocultar").css("display","none");
	$("#"+$( "#select_repetir_cada" ).val()+'_div').css("display","block");
	if($( "#select_repetir_cada" ).val()=="por_dia"){

 			$('.ciclo_semanas').removeAttr("name");
 			$('.ciclo_meses').removeAttr("name");
 			$('.ciclo_anios').removeAttr("name");
 			$( ".ciclo_dias" ).attr('name',$("#select_repetir_cada").val()+"[]");

 			$('.ciclo_meses').removeAttr("required");
 			$('.ciclo_anios').removeAttr("required");
 			$( ".input_semanas" ).removeAttr("required");
 			$( ".ciclo_dias" ).attr("required","true");
 			//alert();

		}else{
			if($( "#select_repetir_cada" ).val()=="por_semana"){
				$('.ciclo_dias').removeAttr("name");
				$('.ciclo_meses').removeAttr("name");
				$('.ciclo_anios').removeAttr("name");
				$( ".ciclo_semanas" ).attr('name',$("#select_repetir_cada").val()+"[]");

				$('.ciclo_dias').removeAttr("required");
	 			$('.ciclo_meses').removeAttr("required");
	 			$('.ciclo_anios').removeAttr("required");
	 			$( ".input_semanas" ).attr("required","true");
	 			

		
			}else{
				if($( "#select_repetir_cada" ).val()=="por_mes"){
					$('.ciclo_dias').removeAttr("name");
					$('.ciclo_semanas').removeAttr("name");
					$('.ciclo_anios').removeAttr("name");
					$( ".ciclo_meses" ).attr('name',$("#select_repetir_cada").val()+"[]");

					$('.ciclo_dias').removeAttr('required');
		 			$('.ciclo_anios').removeAttr('required');
		 			$( ".input_semanas" ).removeAttr('required');
		 			$('.ciclo_meses').attr("required","true");

		 			if($( "#select_mensual_dia_semana" ).val()=="dia_del_mes"){
				 			$('.mes_borrar_1').removeAttr("name");
				 			$( ".mes_borrar_0" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

				 			$('.mes_borrar_1').removeAttr("required");
				 			$( ".mes_borrar_0" ).attr('required',"true");

						}else{
							$('.mes_borrar_0').removeAttr("name");
							$( ".mes_borrar_1" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

							$('.mes_borrar_0').removeAttr("required");
				 			$( ".mes_borrar_1" ).attr('required',"true");
						}

				}else{
					
					$('.ciclo_dias').removeAttr("name");
					$('.ciclo_semanas').removeAttr("name");
					$('.ciclo_meses').removeAttr("name");
					$( ".ciclo_anios" ).attr('name',$("#select_repetir_cada").val()+"[]");

					$('.ciclo_dias').removeAttr('required');
		 			$('.ciclo_meses').removeAttr('required');
		 			$( ".input_semanas" ).removeAttr('required');
		 			$('.ciclo_anios').attr("required","true");

		 			if($( "#select_anual_dia_mes" ).val()=="por_anio_dia_mes"){
			 			$('.anio_borrar_1').removeAttr("name");
			 			$( ".anio_borrar_0" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

			 			$('.anio_borrar_1').removeAttr("required");
			 			$( ".anio_borrar_0" ).attr('required',"true");

					}else{
						$('.anio_borrar_0').removeAttr("name");
						$( ".anio_borrar_1" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

						$('.anio_borrar_0').removeAttr("required");
			 			$( ".anio_borrar_1" ).attr('required',"true");
					}
					
				}

			}
		}




	

	$(".ocultar_intervalo").css("display","none");	
	$("#"+$( "#select_intervalo" ).val()+"_div").css("display","block");

	if($( "#select_intervalo" ).val()=="finaliza_el"){
 			$('.intervalo_borrar_0').removeAttr("name");
 			$( ".intervalo_borrar_1" ).attr('name',$("#select_intervalo").val());

 			$('.intervalo_borrar_0').removeAttr("required");
 			$( ".intervalo_borrar_1" ).attr("required","true");

		}else{
			if($( "#select_intervalo" ).val()=="finaliza_despues_de"){
				$('.intervalo_borrar_1').removeAttr("name");
				$( ".intervalo_borrar_0" ).attr('name',$("#select_intervalo").val());

				$('.intervalo_borrar_1').removeAttr("required");
 				$( ".intervalo_borrar_0" ).attr("required","true");
			}else{
				$('.intervalo_borrar_1').removeAttr("name");
				$('.intervalo_borrar_0').removeAttr("name");

				$('.intervalo_borrar_0').removeAttr("required");
 				$('.intervalo_borrar_1').removeAttr("required");
			}
		}


	$( "#select_intervalo" ).change(function() {

 		$(".ocultar_intervalo").css("display","none");

 		$("#"+$(this).val()+"_div").css("display","block");

 		if($( "#select_intervalo" ).val()=="finaliza_el"){
 			$('.intervalo_borrar_0').removeAttr("name");
 			$( ".intervalo_borrar_1" ).attr('name',$("#select_intervalo").val());

 			
 			console.log("ggkgkgkgk");

 			$('.intervalo_borrar_0').removeAttr("required","false");
 			$( ".intervalo_borrar_1" ).attr("required","true");

		}else{
			if($( "#select_intervalo" ).val()=="finaliza_despues_de"){
				$('.intervalo_borrar_1').removeAttr("name");
				$( ".intervalo_borrar_0" ).attr('name',$("#select_intervalo").val());

				$('.intervalo_borrar_1').removeAttr("required","false");
 				$( ".intervalo_borrar_0" ).attr("required","true");
			}else{
				$('.intervalo_borrar_1').removeAttr("name");
				$('.intervalo_borrar_0').removeAttr("name");
				$('.intervalo_borrar_0').removeAttr("required","false");
 				$('.intervalo_borrar_1').removeAttr("required","false");
			}
		}


	});



	$(".ocultar_mensual").css("display","none");
	$("#"+$( "#select_mensual_dia_semana" ).val()+"_div").css("display","block");

	if($( "#select_mensual_dia_semana" ).val()=="dia_del_mes"){
 			$('.mes_borrar_1').removeAttr("name");
 			$( ".mes_borrar_0" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

 			$('.mes_borrar_1').removeAttr("required");
 			$( ".mes_borrar_0" ).attr('required',"true");

		}else{
			$('.mes_borrar_0').removeAttr("name");
			$( ".mes_borrar_1" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

			$('.mes_borrar_0').removeAttr("required");
 			$( ".mes_borrar_1" ).attr('required',"true");
		}



	$( "#select_mensual_dia_semana" ).change(function() {

 		$(".ocultar_mensual").css("display","none");

 		$("#"+$(this).val()+"_div").css("display","block");

 		if($( "#select_mensual_dia_semana" ).val()=="dia_del_mes"){
 			$('.mes_borrar_1').removeAttr("name");
 			$( ".mes_borrar_0" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

 			$('.mes_borrar_1').removeAttr("required");
 			$( ".mes_borrar_0" ).attr('required',"true");

		}else{
			$('.mes_borrar_0').removeAttr("name");
			$( ".mes_borrar_1" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

			$('.mes_borrar_0').removeAttr("required");
 			$( ".mes_borrar_1" ).attr('required',"true");
		}
	});

	

	$(".ocultar_anual").css("display","none");
	$( "#select_anual_dia_mes" ).change(function() {

 		$(".ocultar_anual").css("display","none");

 		$("#"+$(this).val()+"_div").css("display","block");


 		if($( "#select_anual_dia_mes" ).val()=="por_anio_dia_mes"){
 			$('.anio_borrar_1').removeAttr("name");
 			$( ".anio_borrar_0" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

 			$('.anio_borrar_1').removeAttr("required");
 			$( ".anio_borrar_0" ).attr('required',"true");

		}else{
			$('.anio_borrar_0').removeAttr("name");
			$( ".anio_borrar_1" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

			$('.anio_borrar_0').removeAttr("required");
 			$( ".anio_borrar_1" ).attr('required',"true");
		}

	});
	//$( "#select_anual_dia_mes" ).attr('name',$("#select_anual_dia_mes").val()+"[]");
	if($( "#select_anual_dia_mes" ).val()=="por_anio_dia_mes"){
 			$('.anio_borrar_1').removeAttr("name");
 			$( ".anio_borrar_0" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

			$('.anio_borrar_1').removeAttr("required");
 			$( ".anio_borrar_0" ).attr('required',"true");

		}else{
			$('.anio_borrar_0').removeAttr("name");
			$( ".anio_borrar_1" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

			$('.anio_borrar_0').removeAttr("required");
 			$( ".anio_borrar_1" ).attr('required',"true");
		}
	


	$(".ocultar_tipo").css("display","none");
	$("#"+$( "#select_tipo" ).val()+"_div").css("display","block");
	
	$( "#select_tipo" ).change(function() {

 		$(".ocultar_tipo").css("display","none");

 		$("#"+$(this).val()+"_div").css("display","block");
	});

	$( function() {
    $( ".datepicker" ).datepicker({
    	 monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
    	 dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
    	 dateFormat: "dd-mm-yy",
    	 firstDay: 1,
    });

   
  } );


	$(".ocultar").css("display","none");
	$("#"+$( "#select_repetir_cada" ).val()+'_div').css("display","block");
	if($( "#select_repetir_cada" ).val()=="por_dia"){

 			$('.ciclo_semanas').removeAttr("name");
 			$('.ciclo_meses').removeAttr("name");
 			$('.ciclo_anios').removeAttr("name");
 			$( ".ciclo_dias" ).attr('name',$("#select_repetir_cada").val()+"[]");

 			$('.ciclo_meses').removeAttr("required");
 			$('.ciclo_anios').removeAttr("required");
 			$( ".input_semanas" ).removeAttr("required");
 			$( ".ciclo_dias" ).attr("required","true");
 			//alert();

		}else{
			if($( "#select_repetir_cada" ).val()=="por_semana"){
				$('.ciclo_dias').removeAttr("name");
				$('.ciclo_meses').removeAttr("name");
				$('.ciclo_anios').removeAttr("name");
				$( ".ciclo_semanas" ).attr('name',$("#select_repetir_cada").val()+"[]");

				$('.ciclo_dias').removeAttr("required");
	 			$('.ciclo_meses').removeAttr("required");
	 			$('.ciclo_anios').removeAttr("required");
	 			$( ".input_semanas" ).attr("required","true");
	 			

		
			}else{
				if($( "#select_repetir_cada" ).val()=="por_mes"){
					$('.ciclo_dias').removeAttr("name");
					$('.ciclo_semanas').removeAttr("name");
					$('.ciclo_anios').removeAttr("name");
					$( ".ciclo_meses" ).attr('name',$("#select_repetir_cada").val()+"[]");

					$('.ciclo_dias').removeAttr('required');
		 			$('.ciclo_anios').removeAttr('required');
		 			$( ".input_semanas" ).removeAttr('required');
		 			$('.ciclo_meses').attr("required","true");

		 			if($( "#select_mensual_dia_semana" ).val()=="dia_del_mes"){
				 			$('.mes_borrar_1').removeAttr("name");
				 			$( ".mes_borrar_0" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

				 			$('.mes_borrar_1').removeAttr("required");
				 			$( ".mes_borrar_0" ).attr('required',"true");

						}else{
							$('.mes_borrar_0').removeAttr("name");
							$( ".mes_borrar_1" ).attr('name',$("#select_mensual_dia_semana").val()+"[]");

							$('.mes_borrar_0').removeAttr("required");
				 			$( ".mes_borrar_1" ).attr('required',"true");
						}

				}else{
					if($( "#select_repetir_cada" ).val()=="por_anio"){
					$('.ciclo_dias').removeAttr("name");
					$('.ciclo_semanas').removeAttr("name");
					$('.ciclo_meses').removeAttr("name");
					$( ".ciclo_anios" ).attr('name',$("#select_repetir_cada").val()+"[]");

					$('.ciclo_dias').removeAttr('required');
		 			$('.ciclo_meses').removeAttr('required');
		 			$( ".input_semanas" ).removeAttr('required');
		 			$('.ciclo_anios').attr("required","true");

		 			if($( "#select_anual_dia_mes" ).val()=="por_anio_dia_mes"){
			 			$('.anio_borrar_1').removeAttr("name");
			 			$( ".anio_borrar_0" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

			 			$('.anio_borrar_1').removeAttr("required");
			 			$( ".anio_borrar_0" ).attr('required',"true");

					}else{
						$('.anio_borrar_0').removeAttr("name");
						$( ".anio_borrar_1" ).attr('name',$("#select_anual_dia_mes").val()+"[]");

						$('.anio_borrar_0').removeAttr("required");
			 			$( ".anio_borrar_1" ).attr('required',"true");
					}
					
				}
			}

			}
		}


});

