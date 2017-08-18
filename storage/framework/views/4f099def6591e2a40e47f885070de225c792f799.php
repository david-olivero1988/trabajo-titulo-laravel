<?php $__env->startSection('titulo'); ?>
Cuenta
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
@parent
	
	<div class="container-fluid">
   <?php if(session()->has('flash_notification.message')): ?>
    <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        <?php echo session('flash_notification.message'); ?>

    </div>
  <?php endif; ?>
    

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
                <input type="text" class="input_box_text" name="" disabled value="<?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido_paterno); ?>" style="">                
              </div>
              <label class="col-md-12 title_label">Correo</label>
              <div class="col-md-12">
                <input type="text" class="input_box_text" name="" disabled value="<?php echo e(Auth::user()->email); ?>" style="">                
              </div>
      			</div>
      		</div>
      	</div>
        <form method="POST" action="<?php echo e(route('cuenta.store')); ?>">
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
              <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>" >
         <div class="col-md-12" style="margin:5px 0px 5px 0px; ">
            <input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="submit" value="GUARDAR">
            <a href="<?php echo e(url('listado_campanas')); ?>"><input style="" class="btn btn-danger btn-sm btn_footer input_btn_buscar_admin_user" type="" value="VOLVER"></a>          

      </div>
      </form>
      </div>

     

      </div>



<?php $__env->stopSection(); ?>
 
 <script type="text/javascript"  src="<?php echo e(url('js/jquery-3.1.1.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>  
  <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>"  >
  <script type="text/javascript">
  $(document).ready(function(){
    $("#configuracion").css('background', '#0091c2');
   
  });
    
  </script>
</body>
</html>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>