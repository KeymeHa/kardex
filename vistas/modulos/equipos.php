<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

  $linea = "";

  if (file_exists("vistas/doc/temporal.txt")) 
  {
    $fshow = fopen("vistas/doc/temporal.txt", "r");
    while (!feof($fshow)){
      $linea = fgets($fshow);
      $temporalData = json_decode($linea, true);
    }
    fclose($fshow);
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Base Datos PC <span class="tipoEquipo">(Activos)</span>
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Base de Datos PC</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        
        <button class="btn btn-success btn-newEquipo" data-toggle="modal" data-target="#modalEquipo"><i class="fa fa-desktop"></i>
          Ingresar Equipo
        </button>

        <a href="equiposDevolucion">
          <button class="btn btn-success"><i class="fa fa-chevron-down"></i>
            Devolución masiva
          </button>
        </a>

        <button class="btn btn-success btn-tipoPC" tipoPC="1"><i class="fa fa-desktop"></i>
            No Activos
        </button>

        <button class="btn btn-success btn-exportPC" data-toggle="modal" data-target="#modalExportPC"><i class="fa fa-share-square-o"></i>
          Exportar Equipos

       <!-- <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPCS"><i class="fa fa-desktop"></i>
          Ingreso Masivo
        </button>-->

        <?php


       /* $equiposjson = ControladorEquipos::ctrMostrarEquipos("id_acta", 34);

        for ($i=0; $i < count($equiposjson) ; $i++) { 

           $actjson = ControladorEquipos::ctrAgregarEquipoActa($equiposjson[$i]["id"], 34);

        }

       */


        ?>

      </div>
      <div class="box-body">  

        <div id="div-tablePC">
          <table class="table table-bordered table-striped dt-responsive tablaEquipos" width="100%">
          <thead>
           <tr>
             <th style="width:10px">#</th>
             <th>PC</th>
             <th>Serial</th>
             <th>Arquitectura</th>
             <th>Propiedad</th>
             <th>Asignado a</th>
             <th>Área</th>
             <th>Acciones</th>
           </tr> 
          </thead>
        </table> 
        </div>

        
      </div>
    </div>

     <?php
      include("reportes/equiposArea.php");
      ?>

     <?php
      include("reportes/equiposArquitectura.php");
      ?>

   

  </section>
</div>

<?php include("modal/equipo.php");  include("modal/modalExportPC.php"); include("modal/modalEstadoPC.php");?>