<?php

  if (isset($_GET["iduser"])) 
  {
    if (is_null($_GET["iduser"])) 
    {
      echo'<script> window.location="index.php?ruta=hisRequisicion&iduser='.$_SESSION["id"].'";</script>';
    }
    else
    {
      if (empty($_GET["iduser"])) 
      {
        echo'<script> window.location="index.php?ruta=hisRequisicion&iduser='.$_SESSION["id"].'";</script>';
      }
      elseif ($_GET["iduser"] != $_SESSION["id"]) 
      {
        echo'<script> window.location="index.php?ruta=hisRequisicion&iduser='.$_SESSION["id"].'";</script>';
      }
    }
  }
  else
  {
    echo'<script>window.location="index.php?ruta=hisRequisicion&iduser='.$_SESSION["id"].'";</script>';
  }

   

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Historial de Requisiciones
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
            <a href="genRequisicion">          
              <button class="btn btn-success"><i class="fa fa-plus"></i>
                Nueva Requisición
              </button>
            </a>

              <?php 
              include "anios.php";
              ?>
            <button type="button" class="btn btn-success pull-right" id="btn-RangoRequisicionS">    
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
               <th>Proyecto</th>
               <th>Area</th>
               <th>Insumos</th>
               <th>Fecha</th>
               <th>Estado</th>
               <th style="width:150px">Acciones</th>
             </tr> 
            </thead>
           </table>
          </div>
        </div>
      </div>
     
    </div>   
  </section>
</div>
