<div id="modal-insumoStock" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Insumo: <strong id="tituloInsumo"></strong></h4>
        </div>

        <div class="modal-body" id="bodymodal-insumoStock">
          <div class="nav-tabs-custom" style="cursor: move;">
              <ul class="nav nav-tabs pull-right ui-sortable-handle">
                <li class=""><a href="#box-entradas" data-toggle="tab" aria-expanded="false">Entradas</a></li>
                <li class="active"><a href="#box-Salidas" data-toggle="tab" aria-expanded="true">Salidas</a></li>
                <li class="pull-left header"><i class="fa fa-retweet"></i> Movimientos</li>
              </ul>
              <div class="tab-content no-padding" id="tab_stock">
                
              </div>
            </div>

        </div><!--modal-body-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        </div>

    </div>
  </div>
</div>