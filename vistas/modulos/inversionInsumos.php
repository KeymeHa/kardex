<div class="content-wrapper">
  <section class="content-header"> 
    <h1>   
      Inversion por Insumos
    </h1>
    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
      <li><a href="facturas">Facturas</a></li>  
      <li class="active">Insumos</li> 
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">        
        <?php
        /*
            if ( isset($_GET["fechaInicial"]) ) 
            {
              echo'<a href="vistas/modulos/reportes/excelReport.php?r=r&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
            }
            else
            {
              echo'<a href="vistas/modulos/reportes/excelReport.php?r=r">';
            }

            lo de abajo va a fuera del ?> 

            <button type="button" class="btn btn-success" id="excelReport">
              <span>
                <i class="fa fa-file-excel-o"></i>&nbsp;Reporte en Excel
              </span>
            </button>
          </a>

            */
          ?>

        <a href="facturas">
           <button type="button" class="btn btn-success">    
              <span>
                <i class="fa fa-arrow-left"></i> Regresar
              </span>
          </button>
        </a>

        <button type="button" class="btn btn-success pull-right" id="btn-RangoInversionInsu">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
      </div>
      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablaFacturas" width="100%">
        <thead>
         <tr>
          <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Cantidad</th>
           <th>Total</th>
           <th>Acción</th>
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

    include "reportes/inversionInsumo.php";
    include "modal/modalInverInsu.php";


    ?>


  </section>
</div>
