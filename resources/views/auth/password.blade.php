<!DOCTYPE html>
<html>
<head>
	<title>Administrador de Notificaciones</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	<meta name="_token" content="{!! csrf_token() !!}" />  
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >

</head>
<body >

<div class="back">

<div class="container" id="contenedor_index">
    
        <div id="contenedor_caja_index">
           
            <div class="headbox" style="">
                <img id="img_logo_index" src="img/ingresa-logo.png" alt="">
                <div id="lbl_titulo_index">ADMINISTRADOR DE NOTIFICACIONES</div>
                <form id="form_index" method="POST" action="{{url('/password_email')}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  
                    <div style="">
                    
                        <div class="row" id="contenedor_input_index" >   
                        <div style="text-align: center; color:white">RECUPERACIÓN DE CLAVE</div>

                        <br>                  
                            <div class="col-xs-9 col-md-9">
                            <label class="lbl_rut_dv" >RUT:</label>
                            <input class="inputLogin input_rut" name="rut" oninvalid="setCustomValidity('Para recuperar la clave, debes ingresar tu RUT')" oninput="setCustomValidity('')"  id="rut" type="text" maxlength="8" required >  <!--required autofocus-->
                            </div>
                            <div class="col-xs-3 col-md-3">
                             <label class="lbl_rut_dv">DV:</label>
                             
                            <input class="inputLogin input_dv ver_rut" name="dv" id="dv"  type="text" maxlength="1"  required>
                            </div>
                            
        
                            
                        </div>
                            
                                                           
                        <div class="col-md-12">
                            <div id="valida_rut" class="alert alert-danger" style="background: white; color:black; border-color:white; position:relative; display:none; font-size: 12px">El RUT ingresado es incorrecto
                                
                            </div>
                             
                                <div style="margin-bottom: 10px">
                                <button type="submit" class="button" id="btn_entrar" style="font-size: 12px">ENVIAR MAIL DE RECUPERACIÓN</button>
                            </div>
                            @if (session()->has('flash_notification.message'))

                                <div class="alert alert-danger" style="background: white; color:black; border-color:white; position:relative; font-size: 12px" >
                                    
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!! session('flash_notification.message') !!} 
                                </div>
                            @endif

                            
                        </div>
                            
                            
                                                   
                            
                            
                    </div>
                </form>
            </div>
           
        </div>
     
   
</div>
 

</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

<script type="text/javascript" src="{{url('js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.numeric.js')}}"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(".input_rut").numeric();

    $('#flash-overlay-modal').modal();
    var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
            return false;
        var tmp     = rutCompleto.split('-');
        var digv    = tmp[1]; 
        var rut     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;
        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
}

$("#form_index").submit(function()
{
   
  var rut=$("#rut").val()+"-"+$("#dv").val();

  if( !Fn.validaRut(rut))
  

{
  
   $("#valida_rut").css("display","block");
  // $("#btn_entrar").attr("disabled","disabled");
  return false;


}  
else
{
    $("#valida_rut").css("display","none");
    //$("#btn_entrar").removeAttr("disabled");
    return true;
         
}
});
$(".ver_rut").change(function()
{
   
  var rut=$("#rut").val()+"-"+$("#dv").val();

  if( !Fn.validaRut(rut) && $("#rut").val()!="")
  

{
  
   $("#valida_rut").css("display","block");
   //$("#btn_entrar").attr("disabled","disabled");
  //return false;


}  
else
{
    $("#valida_rut").css("display","none");
    $("#btn_entrar").removeAttr("disabled");
    //return true;
         
}
});


$("#rut").keypress(function()
{
  if($("#rut").val().length<2)
  {
    $("#valida_rut").css("display","none");
  }
});



</script>
</html>