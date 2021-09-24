
<div class="content-wrapper">
  <section class="content-header">
    <a href="requisiciones">
      <button class="btn btn-success pull-left">
        <i class="fa  fa-chevron-left"></i>&nbsp;Regresar 
      </button>
    </a>
    <h1>    
     &nbsp;&nbsp; Reporte de Requisiciones  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="requisiciones">Requisiciones</a></li>     
      <li class="active">Reportes</li>  
    </ol>
  </section>
  <section class="content">

    <div class="box">
      <div class="box-header">
        <button type="button" class="btn btn-success pull-right" id="btn-RangoReporteRq">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
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

    include "reportes/rqArea.php";

    include "reportes/rqCantidad.php";

    include "reportes/rqInsumos.php";

  ?>
  </section>
</div>