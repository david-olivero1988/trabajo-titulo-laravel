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
                <img id="img_logo_index" src="<?php echo e(url('img/ingresa-logo.png')); ?>" alt="">
                <div id="lbl_titulo_index">ADMINISTRADOR DE NOTIFICACIONES</div>
                <!--form id="form_index" method="GET" action="<?php echo e(url('/listado_campañas')); ?>"-->
                <?php echo Form::open(['url'=>'/password/reset']); ?>

                    
                    
                        <div class="row" id="contenedor_input_index" >   
                            <div style="text-align: center; color:white">RECUPERACIÓN DE CLAVE</div>
                            <br>                  
                                <div class="col-md-12">
                                <label class="lbl_rut_dv" >NUEVA CLAVE:</label>
                                <?php echo Form::password('password',['class' => 'inputLogin input_password']); ?>

                                <!--input type="password" class="inputLogin input_password" id="" required--> 
                                </div>
                                <div class="col-md-12">
                                <label class="lbl_rut_dv" >CONFIRMA NUEVA CLAVE:</label>
                                <?php echo Form::password('password_confirmation',['class' => 'inputLogin input_password']); ?> 

                                </div>
                                <?php echo Form::hidden('token',$token,null); ?> 
                                <?php echo Form::hidden('email',$email,null); ?> 
                            </div>
                        <div>
                        
                        <div class="col-md-12">
                                <?php echo Form::submit('RECUPERAR',['id' => 'btn_entrar','class'=>'button']); ?> 
                                
                        </div>
                                                   
                            
                        </div>
                <?php echo Form::close(); ?>

                
            </div>
           
        </div>
    
</div>


</body>
<script type="text/javascript" src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/jquery.numeric.js')); ?>"></script>
<script type="text/javascript">
    $("#input_rut").numeric();



</script>
</html>