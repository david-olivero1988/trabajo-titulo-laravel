<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">

  <title> @yield('titulo') </title>

    <!--link rel="shortcut icon" href="{{url('img/favicon.ico')}}"-->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  
</head>
<body>

  <!-- Header -->
  @section('contenido')


  <div class="navbar navbar_sesion navbar-static-top">

    <div class="container-fluid back_header">
      <img id="img_logo_home_listado" src="{{url('img/ingresa-logo.png')}}" alt="">    
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right ul_hover_nav"> 
          <li class="nombre_usuario"><div>{{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}</div>
          @if(Auth::user()->perfil_id==1)<div class="perfil">Administrador</div>
          @elseif(Auth::user()->perfil_id==2)<div class="perfil">Operador</div>
          @elseif(Auth::user()->perfil_id==3)<div class="perfil">Editor</div>
          @endif
          </li>
          
          <li><div style="" class="img_usuario"><a style=""><img src="{{asset('img/usuario.png')}}" style="height:30px; width:30px"></a></div></li> 

          <li><div style="border-left: groove 1px white; margin-top: 10px"><a  role="button" style="padding: 7px 20px 0px 20px; border-left-width: 1px; margin-top: 3px; margin-bottom: 0px;" href="{{ url('/logout') }}"> <img src="{{asset('img/SALIR.png')}}" style="height:20px; width:20px"></a><p style="font-size:9px; margin: 0px 0px 0px 18px; color:white; ">SALIR</p></div></li>
        </ul>
      </div>    
    </div><!-- /container-fluid -->

  </div>
 

  <div class="navbar_navegacion navbar-static-top">
    <ul class="nav nav_ul_navegacion ul_hover_navegacion navbar-nav navbar-left ">
      <li class="dropdown">
        <a href="" id="configuracion">Configuración</a>
        <ul class="dropdown-menu ul_hover_dropdown">

          <li class="dropdown-item"><a href="{{route('cuenta.index')}}" class="" style="height:21px;padding:0px;text-align: center;" >Configuración de Cuenta</a></li>
          @if(Auth::user()->perfil_id==1)
          <li class="dropdown-item"><a href="{{route('administrador_usuarios.index')}}" style="height:21px; padding:0px;text-align: center;">Administrador de Usuarios</a></li>
          @endif
          @if(Auth::user()->perfil_id==1||Auth::user()->perfil_id==3)
          <li class="dropdown-item"><a href="{{ url('configuracion_general') }}" style="height:21px; padding:0px;text-align: center;">Configuración de Campañas</a></li>
          @endif
        </ul>

      </li>
      <li><a href="{{url('listado_campanas') }}" id="campanias">Campañas</a></li>
      <li class="dropdown">
        <a href="" id="trazabilidad">Trazabilidad</a>
        <ul class="dropdown-menu ul_hover_dropdown">
          <li class="dropdown-item"><a href="{{url('listado_notificaciones')}}" style="height:21px; padding:0px;text-align: center;" >Listado de Notificaciones</a></li>
          <li class="dropdown-item"><a href="{{url('listado_individual')}}" style="height:21px; padding:0px;text-align: center;">Comportamiento Individual</a></li>
          
        </ul>
      </li>
    </ul>
  </div>

 
   @show

  <!-- /Header -->

  <!-- Main -->

  
  <!-- script references -->
  
</body>
</html>