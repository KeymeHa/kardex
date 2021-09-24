

<div class="content-wrapper">
  <section class="content-header"> 
    <h1>   
      Facturas
    </h1>
    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Generaciones</a></li>  
      <li class="active">Facturas</li> 
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <a href="nuevaFactura">          
          <button class="btn btn-success" data-toggle="modal">     
            Agregar Factura
          </button>
        </a>
        
        <button type="button" class="btn btn-success pull-right" id="btn-RangoFactura">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="btn-group pull-right" style="margin-right: 5px;">
          <button class="btn btn-success" id="btnParamIVA" paramIns="1" data-toggle="modal" data-target="#modalParametrosIVA">
            Valor Iva
          </button>
        </div>
      </div>
      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablaFacturas" width="100%">
        <thead>
         <tr>
          <th style="width:10px">#</th>
           <th>Código</th>
           <th>Código Factura</th>
           <th>Proveedor</th>
           <th>Insumos Ingresados</th>
           <th>Total Invertido</th>
           <th>Fecha</th>
           <th>Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>
  </section>
</div>

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
