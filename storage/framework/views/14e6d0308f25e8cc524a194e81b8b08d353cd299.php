<?php $__env->startSection('titulo'); ?>
Listado de Campañas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
  <!-- /Header -->
<?php $__env->stopSection(); ?>
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
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>