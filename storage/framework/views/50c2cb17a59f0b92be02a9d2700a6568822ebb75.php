<?php $__env->startSection('titulo'); ?>
Listado de Campañas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
 @parent  <!-- /Header -->


  <!-- Main -->
<div class="container-fluid">
<div class="row">
<div class="col-md-9" style="padding:0px;">
  <div class="jumbotron-header" style=""> 
    Listado Campañas
  </div> 
  <div class="col-md-12" style="padding: 0px">
    <div class="cajas_cabecera_admin_usuario" style="">
      <div class="row">
      <div class="col-input-listado_campanias">
          <label style="margin-bottom:0px;padding-top:0px;">Información</label><br>
          <input type="text" name="">
        </div>
        <div class="col-input-listado_campanias">
          <label style="margin:0px">Información</label><br>
          <input type="text" name="">
        </div>
        <div class="col-input-listado_campanias">
          <label style="margin:0px">Información</label><br>
          <div class="caja_select">
          <select type="" name="" style="width:70%">
          </select>
          </div>
        </div>
        <div class="col-input-listado_campanias">
          <label style="margin:0px">Información</label><br>
          <div class="caja_select">
          <select type="" name="" style="width:70%">
          </select>
          </div>
        </div>
        <div>
          <input style="" class="btn btn-danger btn-sm input_btn_buscar_admin_user" type="submit" value="BUSCAR">
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="col-md-3" style="padding-right: 0px">
    <div class="jumbotron-button" style=""> 
   <a href="<?php echo e(url('nueva_campaña')); ?>">
   <img src="<?php echo e(url('img/AGREGAR.png')); ?>" style="width:30; margin-right: 10px">Agregar Campaña
    </a>
  </div> 
  <div class="jumbotron-button" style=""> 
    <img src="<?php echo e(url('img/DETENER.png')); ?>" style="width:30; margin-right: 10px">Detener todas las notificaciones
  </div> 
  </div>
</div>
<div class="row">



<table id="example" class="tabla_listado_campanias" >
          
      <thead class="tabla_cabecera_listado_campanias"> 
                <tr>
                    <th>id de <br> Campaña</th>
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
        <?php for ($i=0; $i <17 ; $i++) { ?>
            <tr>
                <td><?=$i+1?></td>
                <td>Próximo mes se inicia el cobro de tu crédito</td>
                <td>Próximo mes se inicia el cobro de tu crédito</td>
                <td>Renovante</td>
                <td>Desactivada</td>
                <td><img style="width:20px;" src="<?php echo e(url('img/PLAY.png')); ?>"></td>
                <td><img style="width:20px;" src="<?php echo e(url('img/LUPA.png')); ?>"></td>
                <td><img style="width:20px;" src="<?php echo e(url('img/EDITAR.png')); ?>"></td>
            </tr>
          <?php }?>
        </tbody>

    </table>
    <!--table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            </tbody>
    </table-->
  

</div>

</div>
<div style="margin-top: 10px;width:100%; border-top:1px solid #AB9A9A;  ">
  
</div>
<?php $__env->stopSection(); ?>
  
  <!-- script references -->
  
  <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
  <script type="text/javascript"  src="<?php echo e(url('js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/jquery.dataTables.min.js')); ?>"></script>
  

  
</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>