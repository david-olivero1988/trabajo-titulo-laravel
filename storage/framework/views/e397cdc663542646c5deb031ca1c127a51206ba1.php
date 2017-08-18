<!DOCTYPE html>
<html>
<head>
	<title>Administrador de Notificaciones</title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
	

</head>
<body >
<div class="back">

<div class="container" id="contenedor_index">
    
        <div id="contenedor_caja_index">
           
            <div class="headbox" style="">
                <img id="img_logo_index" src="img/ingresa-logo.png" alt="">
                <div id="lbl_titulo_index">ADMINISTRADOR DE NOTIFICACIONES</div>
                <form id="form_index" method="GET" action="<?php echo e(url('/listado_campañas')); ?>">
                    <div style="">
                    
                        <div class="row" id="contenedor_input_index" >   
                            <div style="text-align: center; color:white">RECUPERACIÓN DE CLAVE</div>
                            <br>                  
                                <div class="col-md-12">
                                <label class="lbl_rut_dv" >NUEVA CLAVE:</label>
                                <input type="password" class="inputLogin" id="input_password" required> 
                                </div>
                                <div class="col-md-12">
                                <label class="lbl_rut_dv" >CONFIRMA NUEVA CLAVE:</label>
                                <input type="password" class="inputLogin" id="input_password" required> 
                                </div>
                            </div>
                        <div>
                        
                        <div class="col-md-12">
                            
                                <button type="submit" class="button" id="btn_entrar" style="">RECUPERAR</button>
                            
                        </div>
                                                   
                            
                        </div>
                    </div>
                </form>
            </div>
           
        </div>
    
</div>


</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.numeric.js"></script>
<script type="text/javascript">
    $("#input_rut").numeric();



</script>
</html>