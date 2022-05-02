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
        <?php

         $canProveedores = ControladorProveedores::ctrContarProveedores(null, null);

         if ($canProveedores == 0) 
         {
            echo '         
          <button class="btn btn-success" disabled data-toggle="modal" title="Debe existir al menos 1 (un) Proveedor"><i class="fa fa-plus"></i>  
            Agregar Factura
          </button>';
         }
         else
         {
            echo '<a href="nuevaFactura">          
          <button class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i>  
            Agregar Factura
          </button>
        </a>';

        

         }

        ?>

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

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Inversiones por insumos</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      </div>
      <div class="box-body">
        <a href="inversionInsumos">
          <button type="button" class="btn btn-success">    
              <span>
                <i class="fa  fa-area-chart"></i> Ver Informe
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

    include "reportes/facturaGrafica.php";
    include "reportes/facturaCantidad.php";
    include "reportes/inversionAnual.php";

    ?>

  </section>
</div>

<?php
include "modalDatosIva.php";
?>