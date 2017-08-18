
<!DOCTYPE html>
<html>
<head>
    <title>Administrador de Notificaciones</title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >

</head>
<body >

<div class="back">

<div class="container" id="contenedor_index">
    
        <div id="contenedor_caja_index">
        <?php echo e(session('status')); ?>

         <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           
            <div class="headbox" style="">
                <img id="img_logo_index" src="img/ingresa-logo.png" alt="">
                <div id="lbl_titulo_index">ADMINISTRADOR DE NOTIFICACIONES</div>
                <form id="form_index" method="POST" action="<?php echo e(url('/login')); ?>">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                                        
                        <div class="row" id="contenedor_input_index" >  
                        

                            <div class="col-xs-9 col-md-9">
                            <label class="lbl_rut_dv" >RUT:</label>
                            <input class="inputLogin input_rut vaciar" id="rut" oninvalid="setCustomValidity('Para ingresar debes completar todos lo campos')" oninput="setCustomValidity('')"  name="rut" type="text" maxlength="8" value="<?php echo e(old('rut')); ?>" style="" required >  <!--required autofocus-->
                            

                            </div>
                           
                            <div class="col-xs-3 col-md-3">
                             <label class="lbl_rut_dv">DV:</label>
                             
                            <input class="inputLogin input_dv ver_rut vaciar" pattern="[K-Kk-k0-9]" id="dv" name="dv" type="text" maxlength="1" style="" oninvalid="setCustomValidity('Para ingresar debes completar todos lo campos')" oninput="setCustomValidity('')" required onkeypress="return soloLetras(event)">
                            </div>
                        </div>
                        <div>

                        <div class="col-md-12">
                            <div id="valida_rut" class="alert alert-danger" style="background: white; color:black; border-color:white; position:relative; display:none; font-size: 12px">El RUT ingresado es incorrecto</div>
                            <label class="lbl_rut_dv" >CLAVE:</label>
                            <input type="password"  class="inputLogin input_password ver_rut vaciar" name="password" id="password" oninvalid="setCustomValidity('Para ingresar debes completar todos lo campos')" oninput="setCustomValidity('')" required> 
                                 <?php if($errors->has('rut')): ?>
                                    <span class="help-block">
                                        <div id="rut_invalido" class="alert alert-danger" style="background: white; color:black; border-color:white; font-size: 12px"><?php echo e($errors->first('rut')); ?></div>
                                    </span>
                                <?php endif; ?>
                            
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            
                                <button type="submit" class="button" id="btn_entrar" style="">ENTRAR</button>
                            
                        </div>                   
                            
                        </div>
                    
                </form>
                <div class="col-xs-12 col-md-12" >
                            <div class="col-xs-12 col-md-12"><a class="col-xs-12 col-md-12" href="<?php echo e(url('password')); ?>" id="lbl_recuperar_contrasenia">Recuperar Clave</a></div>
                        </div>
            </div>
       
           
        </div>
    
</div>


</body>
<script type="text/javascript" src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo e(url('js/jquery.numeric.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    
        $(".vaciar").val("");


});


    

//([k-kK-K0-9])
    $(".input_rut").numeric({negative : false });

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

 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890k";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


//$(".ver_rut").on("click change",function()
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
$("#password").click(function()
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

$("#rut").click(function()
{
  if($("#rut").val().length<2)
  {
    $("#rut_invalido").css("display","none");
  }
});



</script>
</html>


