<?php $__env->startSection('titulo'); ?>
Listado de Campañas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent  <!-- /Header -->


<!-- Main -->
<div class="container-fluid">
<div id="fechas" class="alert alert-success" style="display:none">La fecha tiene un formato incorrecto
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
<?php if($request->actualizacion=='si'): ?>
<div id="fechas" class="alert alert-success" style="display:block">Tu clave se actualizó exitosamente
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
<?php endif; ?>
<?php if($request->data==1): ?>
<div id="fechas" class="alert alert-success" style="display:block">Configuración exitosa
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
<?php endif; ?>

  <div class="row" style="margin-bottom:10px">
    <div class="col-md-9" style="padding:0px;">
      <div class="jumbotron-header" style=""> 
        Listado Campañas
      </div> 
      <div class="row">
        <div class="cajas_cabecera_admin_usuario" style="">
          <div class="row">
            <form method="get" action="<?php echo e(url('filtro')); ?>">
              <div class="col-md-1" style="width:16%">
                <label style="margin:0px">ID CAMPAÑA</label><br>
                <input class="" type="text" name="id_campania" id="input_page" value="<?php echo e($request->id_campania); ?>"> 
              </div>
              <div class="col-md-1" style="width:16%">
                <label style="margin:0px">ASUNTO</label><br>
                <input class="" value="<?php echo e($request->asunto); ?>" type="text" name="asunto">
              </div>
              <div class="col-md-1" style="width:16%">
                <label style="margin:0px">PROCESO</label><br>
                <div class="caja_select">
                  <select type="" name="proceso" >
                  <option value="">Todos</option>
                    <?php foreach($procesos as $proceso): ?>
                      <?php if($request->proceso==$proceso->proceso): ?>
                        <option value="<?php echo e($proceso->proceso); ?>" selected="true"><?php echo e($proceso->proceso); ?></option>
                      <?php else: ?>
                        <option value="<?php echo e($proceso->proceso); ?>"><?php echo e($proceso->proceso); ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                </div>
              </div>
              <div class="col-md-1" style="width:16%">
                <label style="margin:0px">ESTADO</label><br>
                <div class="caja_select">
                  <select type="" name="estado">
                    <option value="">Todos</option>
                    <?php if($request->estado=='activado'): ?>
                      <option value="activado" selected>Activado</option>
                      <option value="desactivado">Desactivado</option>
                    <?php elseif($request->estado=='desactivado'): ?>
                      <option value="activado">Activado</option>
                      <option value="desactivado" selected>Desactivado</option>
                    <?php else: ?>
                      <option value="activado">Activado</option>
                      <option value="desactivado">Desactivado</option>
                    <?php endif; ?>
                  </select>
                 
                </div>
              </div>

              <div>
                <input  style="" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="BUSCAR">
              </div>
            </form>
          </div>
        </div>
      </div>



    </div>
    <div class="col-md-3" style="padding-right: 0px; height:120px">
      <div class="jumbotron-button" style=""> 
      <?php if(Auth::user()->perfil_id==2): ?>
      <a>
      <?php else: ?>
       <a href="<?php echo e(route('nueva_campana.create')); ?>">
      <?php endif; ?>
         <img src="<?php echo e(url('img/AGREGAR.png')); ?>" style="width:30px; margin-right: 10px">Agregar Campaña
       </a>
     </div> 
     <div class="jumbotron-button" style=""> 
     <?php if(Auth::user()->perfil_id==2): ?>
      <a>
      <?php else: ?>
      <a id="detener_todo" style="cursor:pointer" >
      <?php endif; ?>
        <img src="<?php echo e(url('img/desactivado.png')); ?>" style="width:30px; margin-right: 10px; ">Detener todas las campañas
      </a>
    </div> 
  </div>
</div>
<div class="row">

  <div>

    <table id="example" class="tabla_listado_campanias tablas" >

      <thead class="tabla_cabecera_listado_campanias"> 
        <tr>
          <th>ID DE <br> CAMPAÑA</th>
          <th>ASUNTO</th>
          <th>PROCESO</th>
          <th>UNIVERSO</th>
          <th>ESTADO</th>
          <th>ACCION</th>
          <th>VER</th>
          <th>EDITAR</th>
        </tr>
      </thead>

      <tbody >
        <?php foreach($campanias as $campania): ?>
        <tr>
          <td id="campania_<?php echo e($campania->id); ?>"><?php echo e($campania->id); ?></td>
          <td><?php echo e($campania->asunto); ?></td>
          <td><?php echo e($campania->proceso); ?></td>
          <td><?php echo e($campania->nombre_universo); ?></td>

          <td id="estado_campania_<?php echo e($campania->id); ?>" class="desactiva_nombre" style="width: 80px;"><?php echo e($campania->estado); ?></td>

          <td style="width: 60px; cursor:pointer"><a id="<?php echo e($campania->id); ?>" class="activar_desactivar"><img id="img_<?php echo e($campania->id); ?>" class="desactiva_todo" style="width:20px;" src="img/<?php echo e($campania->estado); ?>.png"></a></td>
          <td style="width: 60px;"><a href="<?php echo e(route('nueva_campana.show',$campania->id)); ?>"><img style="width:20px;" src="<?php echo e(url('img/LUPA.png')); ?>"></a></td>

          <td style="width: 60px;">
          <?php if(Auth::user()->perfil_id==2): ?>
           <a><img style="width:20px;" src="<?php echo e(url('img/EDITAR.png')); ?>">
          <?php else: ?>
          <a href="<?php echo e(route('nueva_campana.edit',$campania->id)); ?>"><img style="width:20px;" src="<?php echo e(url('img/EDITAR.png')); ?>">
          <?php endif; ?>
          </a>

          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div>
      <?php if($campanias): ?>
      <?php echo $campanias->render(); ?>

      <?php endif; ?>


      <a id="exportar_excel" href="<?php echo e(url('/exportar'.$filtros)); ?>"><input style="" class="btn btn-danger btn-sm  input_btn_buscar_admin_user exportar" type="submit" value="DESCARGAR LISTADO DE CAMPAÑAS"></a>


    </div>
  </div>
  

</div>

</div>
<div>

</div>

<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="alerta ama-nar b_1" style="margin-top:10%">
    <div class="header_alerta">
      <a  class="detener" data-dismiss="modal" id="close-modal" aria-label="Close"></a>
    </div>         
    <div class="body_alerta">    

      <div class="mensaje_alerta" id="mensaje_alerta_modal">¿DETENER TODO?</div>
    </div>
    <div class="footer_alerta">
      <button class="btn green" id="activar" type="submit" onclick="">SI</button>
      <button class="btn red" id="noActivar" type="submit" onclick="">NO</button>
    </div>  
  </div>  
</div> 

<div id="guardo_id" style="display:none"></div>
<div id="guardo_estado" style="display:none"></div>

<?php $__env->stopSection(); ?>


<!-- script references -->
<script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>  
<script src="js/bootstrap.min.js"></script>
<link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >


<script type="text/javascript">
  $(document).ready(function(){
    $("#campanias").css('background', '#0091c2');
    //console.log(<?php echo e($campanias); ?>);
    $("#detener_todo").click(function(){
      $('#guardo_estado').text("detener_todo");
      $("#close-modal").removeClass("play");
      $("#close-modal").addClass("detener");
      $("#mensaje_alerta_modal").text("¿Deseas detener el envío de todas las notificaciones?");
      $("#Modal1").modal("show");
    });

    $(".activar_desactivar").click(function(){

      var campania_id=$(this).attr("id");
      var id=$('#campania_'+campania_id).text();
      $('#guardo_id').text(id);
      var estado=$('#estado_campania_'+id).text();
      $('#guardo_estado').text(estado);
      //alert(estado);
      if (estado=="desactivado") {
        $("#close-modal").removeClass("detener");
        $("#close-modal").addClass("play");
        $("#mensaje_alerta_modal").text("Al activar la campaña, reanudarás el envío de este mensaje a los usuarios. ¿Deseas continuar?");      
        $("#Modal1").modal("show");

        
        
      }else{
        $("#close-modal").removeClass("play");
        $("#close-modal").addClass("detener");
        $("#mensaje_alerta_modal").text("Al detener la campaña, el mensaje no será enviado a los usuarios. ¿Deseas continuar?");
        $("#Modal1").modal("show");
      }
        //alert("");
        //alert();      
        



      });
    $('#noActivar').click(function(){
      $('#Modal1').modal('toggle');
    })

    $('#activar').click(function(){


      var url='estado';
      var id=$('#guardo_id').text();
      var estado=$('#guardo_estado').text();


      $.ajax({
        url:url,
        data:{id:id,
          estado:estado},
          success: function(estado){
            if(estado!=0){
              $('#img_'+id).attr("src","img/"+estado+".png");

              $('#estado_campania_'+id).text(estado);
              $('#Modal1').modal('toggle');

            }else{
              $('.desactiva_todo').attr("src","img/desactivado.png");
              $('.desactiva_nombre').text('desactivado');
              $('#Modal1').modal('toggle');
            }
          }
        });
    });
    $('#flash-overlay-modal').modal();

       /*$("#exportar_excel").click(function(){
    
          var  variables_get = $("#carga_variables_get").text(); 

          $("input[type=checkbox]").each(function () { 

            var elemento = $(this).attr('id');

            if($(this).is(':checked')){
              variables_get += '&'+elemento+'=si';
            }
            
          });

          if(variables_get){
            $("#exportar_pdf").attr('href','pdf?'+variables_get); /*concateno el href por el valor mas variables_get para crear el pdf */
           /* $("#exportar_excel").attr('href','excel?'+variables_get);
          }
        });*/

      });

  

  

  
    </script>


  </body>
  </html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>