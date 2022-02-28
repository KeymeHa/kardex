<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Panel de Requisiciones
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Requisiciones</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">

      <div class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="requisicion">          
              <button class="btn btn-success"><i class="fa fa-plus"></i>
                Nueva Requisición
              </button>
            </a>

            <button class="btn btn-success" data-toggle="modal" data-target="#modalimportarRq">
            <i class="fa fa-download"></i> Subir Requisición
            </button>
            <a href="vistas/doc/plantillaImportRq.xlsx">
              <button class="btn btn-success">
                <i class="fa fa-download"></i> Plantilla Importar Rq
              </button> 
            </a>
              <?php 
              include "anios.php";
            ?>
            <button type="button" class="btn btn-success pull-right" id="btn-RangoRequisicion">    
                <span>
                  <i class="fa fa-calendar"></i> Rango de fecha
                </span>
                <i class="fa fa-caret-down"></i>
            </button>
          </div>
          <div class="box-body">
            <p class="statusMsg"></p>
           <table class="table table-bordered table-striped dt-responsive tablaRqs" width="100%">
            <thead>
             <tr>
               <th style="width:10px">#</th>
               <th>Codigo</th>
               <th>Persona</th>
               <th>Area</th>
               <th>Insumos</th>
               <th>Fecha</th>
               <th style="width:150px">Acciones</th>
             </tr> 
            </thead>
           </table>
          </div>
        </div>
      </div>
     
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Solicitudes</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaRqsAppr" width="100%">
            <thead>
             <tr>
               <th style="width:10px">#</th>
               <th>Codigo</th>
               <th>Persona</th>
               <th>Area</th>
               <th>Insumos</th>
               <th>Fecha</th>
               <th style="width:150px">Acciones</th>
             </tr> 
            </thead>
           </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Resumen Requisiciones</h3>
          </div>
          <div class="box-body">
              
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">Requisiciones realizadas</h5><br>
                  <span class="description-text">Anual: <b><?php echo ControladorRequisiciones::ctrContarRequisicionesFecha(0)[0];?>
                    
                  </b></span><br>
                  <span class="description-text"> <b><?php if (isset(ControladorRequisiciones::ctrContarRequisicionesFecha(1)[0])) {
                    echo "Mes:".ControladorRequisiciones::ctrContarRequisicionesFecha(1)[0];
                  } ?></b></span>
                </div>
              </div>

              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">Requisición por Área</h5><br>
                  <?php 

                  if (isset($_GET["fechaInicial"])) 
                  {
                    $countAreas = ControladorRequisiciones::ctrContarRqArea(1, $_GET["fechaInicial"], $_GET["fechaFinal"]);
                  }
                  else
                  {
                    $countAreas = ControladorRequisiciones::ctrContarRqArea(1, null, null);
                  }
                    if($countAreas != null)
                    {
                      foreach ($countAreas as $key => $value) 
                      {
                          echo' <span class="description-text">'.$value[0].': <b>'.$value[1].'</b></span><br>';
                      }
                    }
                    else
                    {
                      echo' <span class="description-text">Sin Información.</span><br>';
                    }

                    

                  ?>
                 
                </div>
              </div>

              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">Stock Entregados</h5><br>
                  <span class="description-text">Anual: <b><?php echo ControladorRequisiciones::ctrTraerInsumosRq(3);?></b></span><br>
                  <span class="description-text">Mes: <b><?php echo ControladorRequisiciones::ctrTraerInsumosRq(4);?></b></span>
                </div>
              </div>

              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">Insumos Requeridos</h5><br>
                  <span class="description-text">Anual: <b><?php echo ControladorRequisiciones::ctrTraerInsumosRq(0);?></b></span><br>
                  <span class="description-text">Mes: <b><?php echo ControladorRequisiciones::ctrTraerInsumosRq(1);?></b></span>
                </div>
              </div>

          </div>
          <div class="box-footer">
             <a href="reportesRq">
                <button class="btn btn-success" id="btn-modalAreaRq"><i class="fa fa-info-circle"></i>&nbsp;Ver Reportes</button>
            </a>
          </div>
        </div>
      </div>
    </div>
    
  </section>
</div>


<div id="modalimportarRq" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" id="formImportarRq" enctype="multipart/form-data">
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importar Requisición</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="importacionGenerada" val="1">
              <input type="file" name="nuevaImpRq">
              <p class="help-block">Archivo formato .xlsx .xls .odt</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" id="btn-ImportarRq">Importar</button>
          </div>
        </div>
        <?php
            $importarRq = new ControladorRequisiciones();
            $importarRq -> ctrImportarRq();
        ?>
      </form>
    </div>
</div>


<div id="modalDescargarPlanRq" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Descargar Plantilla de Requisicion</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">  
            <div class="input-group">  
              <a href="vistas/doc/REQUICICIONESGRAL.xlsx">   
                <button class="btn btn-success">
                  <i class="fa fa-download"></i> Plantilla General
                </button>
              </a>  
            </div>
          </div>
        </div><!--modal-body-->
          <div class="modal-footer">
          </div>
        </div>
      </form>
    </div>
</div>


<?php

  $borrarRq = new ControladorRequisiciones();
  $borrarRq -> ctrBorrarRq($_SESSION["id"]);
?>