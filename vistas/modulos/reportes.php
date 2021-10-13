<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Reportes
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Reportes</li>  
    </ol>
  </section>
  <section class="content">
     <div class="box">

      <div class="box-header with-border">
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

            <button type="button" class="btn btn-success pull-right" id="btn-RangoReportes">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
                </span>
                <i class="fa fa-caret-down"></i>
            </button>

          
      </div>

      <div class="box-body"> 

        <div class="row">
          <div class="col-xs-12">
          <?php
            include "reportes/dgInversion.php";
          ?>
          </div>
        </div>

      </div>
    </div>
 
  </section>
</div>