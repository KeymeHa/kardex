<?php

  if ($_SESSION["perfil"] != '7') 
  {
      $idmodulo = 7;
      $verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

      if ( !isset($verModulo["modulo"]) &&  $verModulo["modulo"] != $idmodulo) 
      {
        echo'<script> window.location="noAutorizado";</script>';
      }
  }

  if(isset($_GET["idRegistro"]) )
  {
    if($_GET["idRegistro"] == null)
    {
      echo'<script> window.location="registros";</script>';
    }
    else
    {
      $item = "id";
      $registro = ControladorRadicados::ctrVerRegistroPQR( $_GET["idRegistro"] );

      if ( isset($registro["id_radicado"]) )
      {
        $radicado = ControladorRadicados::ctrMostrarRadicados($item, $registro["id_radicado"]);
      }
  
    }
  }
  else
  {
   echo'<script> window.location="registros";</script>';
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Linea de Tiempo Radicado # <?php echo $radicado["radicado"];?>
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="registros">Registros</a></li>     
      <li class="active">Rad #. <?php echo $radicado["radicado"];?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
       
      </div>
      <div class="box-body">       
      
      </div>
    </div>
  </section>
</div>