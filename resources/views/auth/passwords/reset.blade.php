<!DOCTYPE html>
<html>
<head>
	<title>Administrador de Notificaciones</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	

</head>
<body >
<div class="back">

<div class="container" id="contenedor_index">
    
        <div id="contenedor_caja_index">
           
            <div class="headbox" style="">
                <img id="img_logo_index" src="{{url('img/ingresa-logo.png')}}" alt="">
                <div id="lbl_titulo_index">ADMINISTRADOR DE NOTIFICACIONES</div>
                <!--form id="form_index" method="GET" action="{{url('/listado_campañas')}}"-->
                {!!Form::open(['url'=>'/password/reset', 'id' => 'form_cambio_clave'])!!}
                    
                    
                        <div class="row" id="contenedor_input_index" >   
                            <div style="text-align: center; color:white">RECUPERACIÓN DE CLAVE</div>
                            <br>                  
                                <div class="col-md-12">
                                <label class="lbl_rut_dv" >NUEVA CLAVE:</label>
                                {!!Form::password('password',['class' => 'inputLogin input_password confirma', 'id' => 'nueva_clave','oninvalid' => "setCustomValidity('Para recuperar tu clave debes completar todos los campos')",'oninput'=> "setCustomValidity('')",'required'=> 'required'])!!}
                                <!--input type="password" class="inputLogin input_password" id="" required--> 
                                </div>
                                <div class="col-md-12">
                                <label class="lbl_rut_dv" >CONFIRMA NUEVA CLAVE:</label>
                                {!!Form::password('password_confirmation',['class' => 'inputLogin input_password confirma','id' => 'confirma_clave','oninvalid' => "setCustomValidity('Para recuperar tu clave debes completar todos los campos')",'oninput'=> "setCustomValidity('')", 'required' => 'required'])!!} 
                                 <div id="valida_rut" class="alert alert-danger" style="background: white; color:black; border-color:white; position:relative; display:none">La clave no coincide con la ingresada anteriormente
                           
                                </div>

                                </div>

                                {!!Form::hidden('token',$token,null)!!} 
                                {!!Form::hidden('email',$email,null)!!} 
                            </div>
                        <div>
                        
                        <div class="col-md-12">
                                {!!Form::submit('RECUPERAR',['id' => 'btn_entrar','class'=>'button'])!!} 
                                
                        </div>
                                                   
                            
                        </div>
                {!!Form::close()!!}
                
            </div>
           
        </div>
    
</div>


</body>
<script type="text/javascript" src="{{url('js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.numeric.js')}}"></script>
<script type="text/javascript">

    $("#form_cambio_clave").submit(function(){

     

      if( $("#nueva_clave").val()!=$("#confirma_clave").val())
      

    {
      console.log("incorrecto");
       $("#valida_rut").css("display","block");
      // $("#btn_entrar").attr("disabled","disabled");
      return false;


    }  
    else
    {
        console.log("correcto");
        $("#valida_rut").css("display","none");
        //$("#btn_entrar").removeAttr("disabled");
       
        return true;
             
    }

   

   
 });

     $(".confirma").click(function()
    {
        console.log("nueva  clave");
        $("#valida_rut").css("display","none");
    });


</script>
</html>