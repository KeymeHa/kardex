<?php

  if(isset($_GET["idActa"]) )
  {
    if($_GET["idActa"] == null)
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
      	$acta = ControladorEquipos::ctrMostrarActas("id", $_GET["idActa"]);
      	$fecha = new DateTime($acta["fecha"]);

      }
    }

   }

?>

<div class="content-wrapper">
   <?php
    include "bannerConstruccion.php";
  ?>
  <section class="content-header">
    <h1>    
      <?php echo $acta["codigo"]; ?> 
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="actasIngreso">Actas</a></li>     
      <li class="active"><?php echo $acta["codigo"]; ?></li>  
    </ol>
  </section>
  <section class="content">

  	<div class="box box-success">
      <div class="box-header"><button class="btn btn-success" onclick="history.back()">
          <i class="fa fa-arrow-left"></i>
          Regresar
        </button></div>
      <div class="box-body">

        <div class="col-sm-4 col-xs-4">
          <div class="description-block border-right">
            <h5 class="description-header">Fecha</h5>
            <span class="description-text"><?php echo $fecha->format('m-d-Y')?></span>
          </div>
        </div><!--col-sm-4 col-xs-4-->

        <div class="col-sm-4 col-xs-4">
          <div class="description-block border-right">
            <h5 class="description-header">Tipo</h5>
            <span class="description-text"><?php echo ($acta["tipo"] == 0 )? "Ingreso" : "Salida" ; ?></span>
          </div>
        </div><!--col-sm-4 col-xs-4-->

        <div class="col-sm-4 col-xs-4">
          <div class="description-block border-right">
            <h5 class="description-header">Cantidad</h5>
            <span class="description-text"><?php echo $acta["cantidad"]?></span>
          </div>
        </div><!--col-sm-4 col-xs-4-->
        
      </div>
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


    <div class="box box-success">
    	<div class="box-body">
    		<embed src="vistas/actas<?php echo $acta['file']; ?>" width="100%" height="700px"  type="application/pdf">
    	</div>
    </div>

  </section>
</div>