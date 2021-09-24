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

    <?php
    include "reportes/ordenGrafica.php";?>
  </section>
</div>


<?php
  include "modalDatosFac.php";
  include "modalDatosIva.php";
?>





<?php
  $borrarOrden = new ControladorOrdenCompra();
  $borrarOrden -> ctrBorrarOrden($_SESSION["id"]);
?>