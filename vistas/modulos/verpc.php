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
      $usuario = ControladorUsuarios::ctrMostrarNombre("id", $equipo["id_usuario"]);
      $supervisor = ControladorUsuarios::ctrMostrarNombre("id", $equipo["id_responsable"]);
      $usr_gen = ControladorUsuarios::ctrMostrarNombre("id", $equipo["id_usr_generado"]);
      $area = ControladorAreas::ctrMostrarNombreAreas("id", $equipo["id_area"]);

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
        
        <div class="col-lg-6 col-md-6 col-sm-12">
          <dl class="dl-horizontal">
            <?php 
              #asignado a
              #rol
              #Responsable
              #area
              #generado por
              #propietario
              #nombrepc
              echo ControladorEquipos::ctrMostrarItem($equipo["n_serie"], 0, "Serial");
              echo ControladorEquipos::ctrMostrarItem($equipo["nombre"], 0, "Nombre PC");
              echo ControladorEquipos::ctrMostrarItem($equipo["serialD"], 0, "2do Serial");
              echo ControladorEquipos::ctrMostrarItem($equipo["id_propietario"], 1, "Propietario");
              echo ControladorEquipos::ctrMostrarItem($equipo["id_arquitectura"], 1, "Arquitectura");
              echo ControladorEquipos::ctrMostrarItem($equipo["marca"], 1, "Marca");
              echo ControladorEquipos::ctrMostrarItem($equipo["modelo"], 1, "Modelo");
              echo ControladorEquipos::ctrMostrarItem($equipo["cpu"], 1, "CPU");
              echo ControladorEquipos::ctrMostrarItem($equipo["cpu_modelo"], 1, "Modelo CPU");
            ?>
          </dl>
        </div><!--col-lg-6 col-md-6 col-sm-12-->

         <div class="col-lg-6 col-md-6 col-sm-12">
          <dl class="dl-horizontal">
            <?php 
              echo ControladorEquipos::ctrMostrarItem($equipo["ram"], 0, "Memoria RAM");
              echo ControladorEquipos::ctrMostrarItem($equipo["ssd"], 0, "Disco SSD");
              echo ControladorEquipos::ctrMostrarItem($equipo["hdd"], 1, "HDD");
              echo ControladorEquipos::ctrMostrarItem($equipo["gpu"], 1, "GPU");
              echo ControladorEquipos::ctrMostrarItem($equipo["gpu_modelo"], 1, "Modelo GPU");
              echo ($equipo["teclado"] == 1)? '<dt>Teclado</dt><dd>Incluido</dd>' : '' ;
              echo ($equipo["mouse"] == 1)? '<dt>Mouse</dt><dd>Incluido</dd>' : '' ;
              echo ControladorEquipos::ctrMostrarItem($equipo["so"], 1, "Sistema Operativo");
              echo ControladorEquipos::ctrMostrarItem($equipo["so_version"], 1, "Versión SO");

            ?>
          </dl>
        </div><!--col-lg-6 col-md-6 col-sm-12-->
        
        <?php
        echo ( !empty($equipo["observaciones"]) )? '<div class="col-lg-12 col-md-12 col-sm-12"><dt>Observaciones</dt><dd>'.$equipo["observaciones"].'</dd></div>' : "" ;
        ?>

      </div><!--box-body-->
      <div class="box-footer">
        <button class="btn btn-success"><i class="fa fa-user-plus"></i> Reasignar</button>
        <button class="btn btn-success"><i class="fa fa-sign-out"></i> Marcar como Devuelto</button>
        <button class="btn btn-success"><i class="fa fa-bullhorn"></i> Reportar</button>
      </div>
    </div>

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">
          Información de Usuario
        </h3>
      </div>
      <div class="box-body">

        <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
          <div class="description-block border-right">
            <span class="description-text">Asignado</span>
            <h5 class="description-header"><?php echo $usuario; ?></h5>
            <h5 class="description-header"><?php echo ( $equipo["rol"] == 0 ) ? "(Contratista)" : "(Empleado)" ; ?></h5>
          </div>
        </div>

        <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
          <div class="description-block border-right">
            <span class="description-text">Supervisor</span>
            <h5 class="description-header"><?php echo $supervisor; ?></h5>
          </div>
        </div>

        <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
          <div class="description-block border-right">
            <span class="description-text">Área</span>
            <h5 class="description-header"><?php echo $area;?></h5>
          </div>
        </div>

        <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
          <div class="description-block border-right">
            <span class="description-text">Proyecto</span>
            <h5 class="description-header">Administrativo</h5>
          </div>
        </div>

      </div><!--box-body-->
    </div>

    <div class="col-md-12">
      <h3>Trazabilidad</h3>
    </div>

    <div class="col-md-12">
      <ul class="timeline">

        <li class="time-label">
          <span class="bg-red">
            10 Feb. 2014
          </span>
        </li>


        <li>
          <i class="fa fa-arrow-circle-up bg-green"></i>
          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
            <h3 class="timeline-header"><a href="#"><i class="fa fa-paperclip"></i> Anexo</a></h3>
            <div class="timeline-body">
              <?php echo "<strong>".$usr_gen.":</strong> " ?>Se recibio por parte del proveedor el equipo.
            </div>
          </div>
        </li>

      </ul>
    </div>

   
  </section>

</div>
