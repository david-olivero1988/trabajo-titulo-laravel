<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">

  <title>Listado</title>


  <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

</head>
<body>
  <!-- Header -->
  <div class="navbar navbar_sesion navbar-static-top">

    <div class="container-fluid">
      <img id="img_logo_home_listado" src="img/ingresa-logo.png" alt="">    
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right ul_hover_nav"> 
          <li style="padding:15px; color:white;">nombre de usuario</a></li>
          <li><div style="border-left: groove 1px white;margin-top: 10px; padding-bottom:4px"><a href="" style="padding: 7px 10px; border-left-width: 1px; margin-top: 3px; margin-bottom: 3px;"><img src="<?php echo e(asset('img/GUARDAR.png')); ?>" style="height:30px; width:30px"></a></div></li>       
          <li><div style="border-left: groove 1px white; margin-top: 10px"><a  role="button" style="padding: 7px 20px 0px 20px; border-left-width: 1px; margin-top: 3px; margin-bottom: 0px;" href="#"> <img src="<?php echo e(asset('img/SALIR.png')); ?>" style="height:20px; width:20px"></a><p style="font-size:9px; margin: 0px 0px 0px 18px; color:white; ">SALIR</p></div></li>
        </ul>
      </div>    
    </div><!-- /container-fluid -->

  </div>

  <div class="navbar_navegacion navbar-static-top">
    <ul class="nav nav_ul_navegacion ul_hover_navegacion navbar-nav navbar-left ">
      <li class="dropdown">
        <a href="">Configuración</a>
        <ul class="dropdown-menu ul_hover_dropdown">

          <li class="dropdown-item"><a href="" class="" style="height:21px;padding:0px;text-align: center;" >Configuración de Cuenta</a></li>
          <li class="dropdown-item"><a href="" style="height:21px; padding:0px;text-align: center;">Administrador de Usuarios</a></li>
          <li class="dropdown-item"><a href="" style="height:21px; padding:0px;text-align: center;">Configuración de Campañas</a></li>
        </ul>

      </li>
      <li><a href="">Campañas</a></li>
      <li class="dropdown">
        <a href="">Trazabilidad</a>
        <ul class="dropdown-menu ul_hover_dropdown">
          <li class="dropdown-item"><a href="" style="height:21px; padding:0px;text-align: center;" >Estado de Notificaciones</a></li>
          <li class="dropdown-item"><a href="" style="height:21px; padding:0px;text-align: center;">Comportamiento Individual</a></li>
          
        </ul>
      </li>
    </ul>
  </div>

  <!-- /Header -->

  <!-- Main -->
  <div class="container-fluid">

    

      <div class="jumbotron"> 
        Listado Campañas
      </div> 
      <div class="row">
        <div class="col-md-4">
          <div class="cajas">
            
          </div>
        </div>
        <div class="col-md-4">
          <div class="cajas">
            
          </div>
        </div>
        <div class="col-md-4">
         <div class="cajas">
            
          </div>
        </div>
      </div>
      <div class="col-md-12">
        botones
      </div>
      
    
  </div>

  
  <!-- script references -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>