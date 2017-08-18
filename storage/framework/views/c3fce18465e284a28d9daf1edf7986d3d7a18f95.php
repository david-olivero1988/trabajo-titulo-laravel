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
        <?php echo e(session('status')); ?>

         <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           
            <div class="headbox" style="">
                <img id="img_logo_index" src="img/ingresa-logo.png" alt="">
                <div id="lbl_titulo_index">ADMINISTRADOR DE NOTIFICACIONES</div>
                <form id="form_index" method="POST" action="<?php echo e(route('login')); ?>">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                                        
                        <div class="row" id="contenedor_input_index" >  
                        

                            <div class="col-xs-9 col-md-9">
                            <label class="lbl_rut_dv" >RUT:</label>
                            <input class="inputLogin input_rut" id="" name="rut" type="text" maxlength="8" style="" required >  <!--required autofocus-->
                            </div>
                           
                            <div class="col-xs-3 col-md-3">
                             <label class="lbl_rut_dv">DV:</label>
                             
                            <input class="inputLogin input_dv" id="" name="dv" type="text" maxlength="1" style="" required>
                            </div>
                        </div>
                        <div>

                        <div class="col-md-12">
                            <label class="lbl_rut_dv" >CLAVE:</label>
                            <input type="password" class="inputLogin input_password" name="password" id="" required> 
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
<script type="text/javascript" src="<?php echo e(url('js/jquery.numeric.js')); ?>"></script>
<script type="text/javascript">
    $(".input_rut").numeric();



</script>
</html>