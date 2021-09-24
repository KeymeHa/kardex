
<div id="modalDatosFacturación" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#00A65A; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Parametros</h4>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <div class="box-body">

              <!-- UBICACION EN BODEGA -->
               <div class="form-group">
                  <p class="help-block">Razón Social</p>           
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarRazonSFAC" name="editarRazonSFAC" autocomplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <p class="help-block">Nit.</p>           
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarNitFAC" name="editarNitFAC" autocomplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <p class="help-block">Dirección</p>           
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarDicFAC" name="editarDicFAC" autocomplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <p class="help-block">Telefono</p>           
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarTelFAC" name="editarTelFAC" autocomplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <p class="help-block">Correo Electronicó     
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarCorreoFAC" name="editarCorreoFAC" autocomplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <p class="help-block">Dirección de Entrega de Insumos</p>           
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarDicEFAC" name="editarDicEFAC" autocomplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <p class="help-block">Rep. Legal</p>           
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarRepLFAC" name="editarRepLFAC" autocomplete="off">
                  </div>
               </div>
            </div><!--box-body-->
          </div><!--modal-body-->
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btnSubmitOC">Editar</button>
        </div>
        <?php
          $editarDatosFAC = new ControladorParametros();
          $editarDatosFAC -> ctrEditarDatosFac();
        ?>  
      </form>
    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modalEditarInsumo-->
