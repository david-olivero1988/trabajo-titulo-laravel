<?php $__env->startSection('titulo'); ?>
Configuración genereal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent
  
  <div class="container-fluid">

    

      <div class="jumbotron"> 
        Configuración general
      </div> 
      <div class="row">
      
        <div class="col-md-6" style="padding:0px 5px 0px 0px;">

          <div class="caja_altura_cuenta">
            <div class="cajas_cabecera_cuenta" style="">
              <p>Configiración</p>
            </div>
            <div class="cajas_cuerpo_cuenta">
              que tal
            </div>
          </div>
        </div>
        <div class="col-md-6" style="padding:0px 0px 0px 5px;">
          <div class="caja_altura_cuenta" >
            <div class="cajas_cabecera_cuenta">
              <p>Última acualización</p>
            </div>
            <div class="cajas_cuerpo_cuenta">
              que tal
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12" style="margin:5px 0px 5px 0px; ">
            <input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">
            <a href="<?php echo e(url('/listado_campañas')); ?>"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="VOLVER"></a>        

      </div>

      </div>



<?php $__env->stopSection(); ?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>