<div id="modalParametrosIVA" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#00A65A; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Valor IVA</h4>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <div class="box-body">

              <!-- VALOR PORCENTAJE IVA -->
               <div class="form-group row">
                  <div class="col-xs-4"> 
                    <p class="help-block">IVA</p>               
                    <div class="input-group">                 
                      <input type="number" class="form-control input-lg" id="evalorIVA" name="evalorIVA" min="0" autocomplete="off">
                      <input type="hidden" value="1" name="paginaRedirigida">
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span> 
                    </div>
                  </div>
               </div>
            </div><!--box-body-->
          </div><!--modal-body-->
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Editar</button>
        </div>
        <?php
          $editarParIVA = new ControladorParametros();
          $editarParIVA -> ctrEditarValorIVA();
        ?>  
      </form>
    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modalEditarValor-->
