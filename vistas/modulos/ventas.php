<div class="content-wrapper">
  <section class="content-header"> 
    <h1>   
      Ventas
    </h1>
    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>  
      <li class="active">Ventas</li> 
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <a href="nuevaVenta">          
          <button class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i>  
            Nueva Venta
          </button>
        </a>

        <?php
            if ( isset($_GET["fechaInicial"]) ) 
            {
              echo'<a href="vistas/modulos/reportes/excelReport.php?r=r&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
            }
            else
            {
              echo'<a href="vistas/modulos/reportes/excelReport.php?r=r">';
            }
          ?>
          <button type="button" class="btn btn-success" id="excelReport">
              <span>
                <i class="fa fa-file-excel-o"></i>&nbsp;Reporte en Excel
              </span>
            </button>
          </a>
        
          <?php 
            include "anios.php";
          ?>
        
        <button type="button" class="btn btn-success pull-right" id="btn-RangoVenta">    
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
       <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
        <thead>
         <tr>
          <th style="width:10px">#</th>
           <th>Código</th>
           <th>Código Venta</th>
           <th>Insumos Vendidos</th>
           <th>Total Venta</th>
           <th>Fecha</th>
           <th>Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Ventas Por Insumos</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      </div>
      <div class="box-body">
        <a href="inversionInsumosV">
          <button type="button" class="btn btn-success">    
              <span>
                <i class="fa fa-area-chart"></i> Ver Informe
              </span>
          </button>
        </a>
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

    //include "reportes/facturaGrafica.php";
    //include "reportes/facturaCantidad.php";
    //include "reportes/inversionAnual.php";

    ?>

  </section>
</div>

<?php
  include "modalDatosIva.php";
?>