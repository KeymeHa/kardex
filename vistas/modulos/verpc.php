<?php

  if(isset($_GET["idpc"]) )
  {
    if($_GET["idpc"] == null)
    {
      echo'<script> window.location="404";</script>';
    }
    else
    {
      $equipo = ControladorEquipos::ctrMostrarEquipos("id",$_GET["idpc"]);

      if (is_null($equipo)) 
      {
        echo'<script> window.location="404";</script>';
      }
    }
  }
  else
  {

   echo'<script> window.location="404";</script>';

  }

?>


<div class="content-wrapper">

  <section class="content-header">

    <a href="javascript:history.back()">
      <button class="btn btn-success btn-md"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>

    <button class="btn btn-info btnPrint" onclick="window.print()" ><i class="fa fa-print"></i> Imprimir</button>
    
    <br><br>

    <h1>
      
      Equipo: <b><?php echo $equipo["nombre"];?></b>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="equipos">Base de Datos PC</a></li>
      
      <li class="active"><?php echo $equipo["nombre"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-success">
      <div class="box-header">
        <div class="box-title">
          Caracteristicas
        </div>
      </div>
      <div class="box-body">
        
        <dl class="dl-horizontal">
          <?php 
            echo ControladorEquipos::ctrMostrarItem($equipo["n_serie"], 0, "Serial");
            echo ControladorEquipos::ctrMostrarItem($equipo["serialD"], 0, "2do Serial");
            echo ControladorEquipos::ctrMostrarItem($equipo["id_propietario"], 1, "Propietario");
            echo ControladorEquipos::ctrMostrarItem($equipo["id_arquitectura"], 1, "Arquitectura");
            echo ControladorEquipos::ctrMostrarItem($equipo["marca"], 1, "Marca");
            echo ControladorEquipos::ctrMostrarItem($equipo["modelo"], 1, "Modelo");
            echo ControladorEquipos::ctrMostrarItem($equipo["cpu"], 1, "CPU");
            echo ControladorEquipos::ctrMostrarItem($equipo["cpu_modelo"], 1, "Modelo CPU");
          ?>
        </dl>

      </div><!--box-body-->
    </div>
   
  </section>

</div>
