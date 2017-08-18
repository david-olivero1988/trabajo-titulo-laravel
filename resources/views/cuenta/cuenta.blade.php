@extends('layout.base')

@section('titulo')
Cuenta
@stop

@section('contenido')
@parent
	
	<div class="container-fluid">
   @if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
  @endif
    

      <div class="jumbotron"> 
        Cuenta
      </div> 
      <div class="row">

      	<div class="col-md-6" style="padding:0px 5px 0px 0px;">

      		<div class="caja_altura">
      			<div class="cajas_cabecera" style="">
      				<p>Información</p>
      			</div>
      			<div class="cajas_cuerpo">
      				<label class="col-md-12 title_label">Nombre</label>
              <div class="col-md-12">
                <input type="text" class="input_box_text" name="" disabled value="{{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}" style="">                
              </div>
              <label class="col-md-12 title_label">Correo</label>
              <div class="col-md-12">
                <input type="text" class="input_box_text" name="" disabled value="{{ Auth::user()->email }}" style="">                
              </div>
      			</div>
      		</div>
      	</div>
        <form method="POST" action="{{route('cuenta.store')}}">
      	<div class="col-md-6" style="padding:0px 0px 0px 5px;">
      		<div class="caja_altura" >
      			<div class="cajas_cabecera">
      				<p>Actualizar Clave</p>
      			</div>
      			<div class="cajas_cuerpo">
      				<label class="col-md-12 title_label">Ingrese clave actual</label>
              <div class="col-md-12">
                <input type="password" class="input_box_text" name="clave_actual" oninvalid="setCustomValidity('Para actualizar tus datos, debes completar todos los campos.')" oninput="setCustomValidity('')" required style="">                
              </div>
              <label class="col-md-12 title_label">Ingrese nueva clave</label>
              <div class="col-md-12">
                <input type="password" class="input_box_text" name="nueva_clave" oninvalid="setCustomValidity('Para actualizar tus datos, debes completar todos los campos.')" oninput="setCustomValidity('')"  required style="">                
              </div>
              <label class="col-md-12 title_label">Repite nueva clave</label>
              <div class="col-md-12">
                <input type="password" class="input_box_text" name="repite_nueva_clave" oninvalid="setCustomValidity('Para actualizar tus datos, debes completar todos los campos.')" oninput="setCustomValidity('')"  required style="">                
              </div>

                

      			</div>
      		</div>
      	</div>
              <input type="hidden" name="id" value="{{ Auth::user()->id }}" >
         <div class="col-md-12" style="margin:5px 0px 5px 0px; ">
            <input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">
            <a href="{{url('listado_campanas')}}"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="VOLVER"></a>          

      </div>
      </form>
      </div>

     

      </div>



@stop
 
 <script type="text/javascript"  src="{{url('js/jquery-3.1.1.min.js')}}"></script>
  <script src="{{url('js/bootstrap.min.js')}}"></script>  
  <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >
  <script type="text/javascript">
  $(document).ready(function(){
    $("#configuracion").css('background', '#0091c2');
   
  });
    
  </script>
</body>
</html>