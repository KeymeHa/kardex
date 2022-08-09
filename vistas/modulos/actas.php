<div class="content-wrapper">
  <section class="content-header">
    <h1>    
       Salida y Entrada de Equipos
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Listado de Actas</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success btnNuevaActa"><i class="fa fa-plus"></i> 
          Nueva Acta de Salida
        </button>

        <?php 
            include "anios.php";
          ?>

        <button type="button" class="btn btn-success pull-right" id="btn-RangoActas">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
      </div>
      <div class="box-body">       
        <table class="table table-bordered table-striped dt-responsive tablaActas" width="100%">      
        <thead>    
         <tr>       
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Tipo de Acta</th>
           <th>Autorizado Por</th>
           <th>Responsable</th>
           <th>Fecha</th>
           <th>Items</th>
           <th>Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>

    <?php
    if (isset($_GET["fechaInicial"]) ) 
    {
      $fechaInicial = $_GET["fechaInicial"];
      $fechaFinal = $_GET["fechaFinal"];
    }
    else
    {
      $fechaInicial = null;
      $fechaFinal = null; 
    }
    include "reportes/actaGrafica.php";
    ?>
  </section>
</div>


<?php
  $borrarActa = new ControladorActas();
  $borrarActa -> ctrBorrarActa($_SESSION["id"], $_SESSION["anioActual"]);
?>