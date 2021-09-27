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

    <?php

    if (isset($_GET["fechaInicial"])) 
    {
      $fechaInicial = $_GET["fechaInicial"];
      $fechaFinal = $_GET["fechaFinal"];
    }
    else
    {
      $fechaInicial = null;
      $fechaFinal = null;
    }

    include "reportes/facturaGrafica.php";

    ?>

  </section>
</div>

<?php
include "modalDatosIva.php";
?>