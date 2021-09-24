<div class="content-wrapper">
     <?php
    include "bannerConstruccion.php";
  ?>
  <section class="content-header"> 
    <h1>     
      Ordenes de Compra   
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>   
      <li class="active">Ordenes de Compra</li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <a href="nuevaOrdendeCompras">          
          <button class="btn btn-success" data-toggle="modal">         
            Nueva Orden de Compra 
          </button>
        </a>
        <div class="btn-group pull-right">
          <button class="btn btn-success" id="btnParamDatosFAC" paramDFac="1" data-toggle="modal" data-target="#modalDatosFacturación">
            Datos Facturación
          </button>
        </div>
        <div class="btn-group pull-right" style="margin-right: 5px;">
          <button class="btn btn-success" id="btnParamIVA" paramIns="1" data-toggle="modal" data-target="#modalParametrosIVA">
            Valor Iva
          </button>
        </div>
        <button type="button" class="btn btn-success pull-right" id="btn-RangoOrdenes"  style="margin-right: 5px; "> 
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
         </button>
      </div>
      <div class="box-body">        
       <table class="table table-bordered table-striped dt-responsive tablaOrdenes" width="100%">        
        <thead>        
         <tr>         
          <th style="width:10px">#</th>
           <th>Código</th>
           <th>Proveedor</th>
           <th>Item Solicitados</th>
           <th>Total a Invertir</th>
           <th>Fecha</th>
           <th style="width:130px">Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>
  </section>
</div>
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


<?php
  $borrarOrden = new ControladorOrdenCompra();
  $borrarOrden -> ctrBorrarOrden($_SESSION["id"]);
?>