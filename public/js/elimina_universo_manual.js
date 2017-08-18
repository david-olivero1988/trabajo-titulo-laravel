

$(document).ready(function(){
$("#elimina_manual").click(function()
{

	$("#descripcion_manual").attr('required', 'required');
	$("#mostrar_nuevo_uni_manual").css("display","block");
	$("#ocul_nuev_uni_manual").css("display","none");
	$("#univer").css("display","none");
	$("#universo_manual_valor").attr("name","universo_manual");
	$("#universo_manual_valor").val("dentro");



  /*$.ajax({
    url:"../../elimina_universo_manual",
    data:{
      id:$("#universo_id").text()
    },
    success: function(resp){
      alert(resp);
    }
  });*/




  
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
				
				
				//$("#valida_descripcion").css("display","none");
					var formData = new FormData(document.getElementById("universo_manual"));
					var valor=$("#carga_universo").val();
					var url = "../../elimina_universo_manual";
					$.ajax({
						url : url,
						type : "post",
						data : formData,
						dataType: 'json',   
						cache: false,
						contentType: false,
						processData: false,
					}).done(function(data) {
					
						//console.log(data.universo);
						
						if(data.extension=="xls" && data.formato=="correcto"){

							$("#id_universo_manual_construir").attr("name","universo_id");
							$("#id_universo_manual_construir").val(data.universo_id);
							$("#id_universo_manual").val(data.universo);

							$("#universo_manual_valor").val("si");

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
			            	setTimeout(function(){$("#valida_descripcion").css("display","none")},3000);
			            }
			        });
				
			
			});

});