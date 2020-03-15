@extends('layout.base')

@section('titulo')
Configuración genereal
@stop

@section('contenido')
@parent
  <link rel="stylesheet" href="{{url('css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{url('css/jquery.timepicker.css')}}">
  <div class="container-fluid">
     @if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
  @endif


      <div class="jumbotron">
        Configuración general de campañas
      </div>
      <form action="configuracion_general/store" method="POST">
        <div class="row" >

          <div class="col-md-6" style="padding:0px 5px 0px 0px;">

            <div class="caja_altura">
              <div class="cajas_cabecera" style="">
                <p>Configuración</p>
              </div>

                <div class="cajas_cuerpo">
                      <div class="row">

                      <label class="col-md-8 title_label_panel_doble" style="padding-right: 0px">Agregar las notificaciones en un mensaje generico cuando un RUT recibe mas de:</label> <input class="col-md-1  title_label_panel_doble input_border input_numeros" value="{{$conf_campania->num_notificaciones}}" type="numeric" name="num_notificaciones" style="width:60px; color:black; margin-top: 5px; font-size: 15px; color : black" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required> <label class="col-md-2 title_label_panel_doble" > Notificaciones</label>
                      </div>

                      <label class="col-md-12 title_label_panel_doble">Mensaje genérico</label>
                      <div class="col-md-12">
                        <textarea name="mensaje_generico" rows="10" cols="40" placeholder="Mensaje Generico..." style="resize:none; width:100%; height:130px;" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>{{$conf_campania->mensaje_generico}}</textarea>
                      </div>


                      <label class="col-md-12 title_label_panel_doble">Las notificaciones serán añadidas a partir de las:</label>
                      <div class="col-md-12">
                        <input value="{{$hora}}" type="datetime" id="hora" class="timepicker" class="input_box_text input_border" name="hora" style="width:300px" oninvalid="setCustomValidity('Completar este campo es obligatorio')" oninput="setCustomValidity('')" required>
                      </div>
                      <div class="col-md-12 hora_config">

                        @if($conf_campania->mediodia=='AM')
                          <div class="col-md-12"><input class="radio_hora col-md-2 " name="mediodia" style="width: 15px; margin-top: 1px" type="radio"  value="AM" checked><div class="col-md-2 label_check_box" >AM</div></div>

                         <div class="col-md-12"><input class="radio_hora col-md-2" name="mediodia" style="width: 15px; margin-top: 1px" type="radio" value="PM"><div class="col-md-2 label_check_box" >PM</div></div>
                         @elseif($conf_campania->mediodia=='PM')
                          <div class="col-md-12"><input class="radio_hora col-md-2 " name="mediodia" style="width: 15px; margin-top: 1px" type="radio"  value="AM"><div class="col-md-2 label_check_box" >AM</div></div>

                         <div class="col-md-12"><input class="radio_hora col-md-2" name="mediodia" style="width: 15px; margin-top: 1px" type="radio" value="PM" checked><div class="col-md-2 label_check_box" >PM</div></div>
                         @else
                          <div class="col-md-12"><input class="radio_hora col-md-2 " name="mediodia" style="width: 15px; margin-top: 1px" type="radio"  value="AM"><div class="col-md-2 label_check_box" >AM</div></div>

                         <div class="col-md-12"><input class="radio_hora col-md-2" name="mediodia" style="width: 15px; margin-top: 1px" type="radio" value="PM"><div class="col-md-2 label_check_box" >PM</div></div>
                         @endif
                    </div>


                </div>


            </div>
          </div>
          <div class="col-md-6" style="padding:0px 0px 0px 5px;">
            <div class="caja_altura" >
              <div class="cajas_cabecera">
                <p>Última actualización</p>
              </div>
              <div class="cajas_cuerpo">
              <label class="col-md-12 title_label_panel_doble">Nombre de usuario</label>
              <label class="col-md-12 title_label_panel_doble" style="font-size: 12px">{{$conf_campania->usuario}}</label>

              <label class="col-md-12 title_label_panel_doble">Fecha de actualización</label>
              <label class="col-md-12 title_label_panel_doble" style="font-size: 12px">{{$fecha_hora}}</label>
              <input type="text" value="{{Auth::user()->nombre_usuario}}" name="usuario" style="display:none">

              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12" style="margin:5px 0px 5px 0px; ">
              <input id="guardar-btn" style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">

              <a href="{{url('listado_campanas')}}"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="VOLVER"></a>

        </div>
        </form>


    </div>



@stop
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>


    <script type="text/javascript"  src="{{url('js/jquery-3.1.1.min.js')}}"></script>
  <script src="{{url('js/bootstrap.min.js')}}"></script>
  <script src="{{url('js/nueva_campania.js')}}"></script>

 <script src="{{url('js/jquery.timepicker.js')}}"></script>
 <script src="{{url('js/jquery.numeric.js')}}"></script>
 <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"  >
  <script type="text/javascript">
  $(document).ready(function(){
    $("#configuracion").css('background', '#0091c2');
    $(".timepicker").timepicker({
      timeFormat: 'h:mm',
      scrollbar: true,
      maxTime: '12:59',
      dynamic: true,
      interval: 30,
      dropdown: false,
    });

    $("#hora").numeric({ decimal: false, negative: false });


  });


  </script>
</body>
</html>
