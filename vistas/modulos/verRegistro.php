<?php
  if(isset($_GET["idRegistro"]) )
  {
    if($_GET["idRegistro"] == null)
    {
      echo'<script> window.location="registros";</script>';
    }
    else
    {
      $valor = $_GET["idRegistro"];
      $registro = ControladorRadicados::ctrAccesoRapidoRegistros($valor, 0);
    }
  }
  else
  {
   echo'<script> window.location="registros";</script>';
  }
?>
<div class="content-wrapper">
  <section class="content-header">
    <a href="registros">
      <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>
    <br><br>
    <h1>    
      Radicado: <?php echo $registro["radicado"]; ?><b></b>  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="registros"> Registros PQR</a></li>    
      <li class="active">Radicado</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Información Registro</h3> 
      </div>    
      <div class="box-body">  

         <div class="col-lg-6">

          <dl class="dl-horizontal">
            <dt>Fecha Radicado:</dt>
            <dd><?php echo $registro["fecha_vencimiento"]; ?></dd>
            <dt>Fecha Vencimiento:</dt>
            <dd><?php echo $registro["fecha"]; ?></dd>
            <dt>Días Restantes:</dt>
            <dd><?php echo $registro["dias_restantes"]; ?></dd>
          </dl>


        </div>



      </div><!--BOX BODY-->
    </div><!--BOX-->
    <div class="box">
      <div class="box-body">
        <?php

        var_dump($registro);

        ?>
      </div>
    </div>
  </section>
</div>
