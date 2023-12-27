<?php

  if(isset($_GET["idLicencia"]) )
  {
    if($_GET["idLicencia"] == null)
    {
      echo'<script> window.location="inicio";</script>';
    }
    else
    {

      if ($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 10) 
      {
     	 echo'<script> window.location="noAutorizado";</script>';
      }// if ($_SESSION["perfil"] != 3) 
      else
      {
        $licencia = ControladorEquipos::ctrMostrarLicencias("id", $_GET["idLicencia"]);

      }
    }

   }

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>    
      <?php echo $licencia["usuario"]; ?> 
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="equiposlicencias">Licencias</a></li>     
      <li class="active"><?php echo $licencia["usuario"]; ?></li>  
    </ol>
  </section>
  <section class="content">

  	<div class="box box-success">
      <div class="box-header"><a href="equiposlicencias"><button class="btn btn-success">
          <i class="fa fa-arrow-left"></i>
          Regresar
        </button></a>

        <button class="btn btn-success btn-exportPC" data-toggle="modal" data-target="#modalExportPC"><i class="fa fa-share-square-o"></i>
          Exportar Equipos
        </button></div>
    </div>

    <div class="box">
      <div class="box-header with-border">
      </div>
      <div class="box-body">       
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
  </section>
</div>

<?php include("modal/equipo.php");  include("modal/modalExportPC.php"); include("modal/modalEstadoPC.php");?>