
 <?php $__env->startSection('modal'); ?>

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

<?php echo $__env->yieldSection(); ?>