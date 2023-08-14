<?php

  if(isset($_GET["idpc"]) )
  {
    if($_GET["idpc"] == null)
    {
      echo'<script> window.location="404";</script>';
    }
    else
    {
      $item = "id";
      $equipo = ControladorEquipos::ctrMostrarEquipos($item,$_GET["idpc"]);
      $usuario = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_usuario"]);
      $supervisor = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_responsable"]);
      $usr_gen = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_usr_generado"]);
      $area = ControladorAreas::ctrMostrarNombreAreas($item, $equipo["id_area"]);
      $proyecto = ControladorProyectos::ctrMostrarProyectos($item, $equipo["id_proyecto"]);

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


      <div class="col-lg-8 col-md-8 col-sm-12">
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
                    <h5 class="description-header"><?php echo $proyecto["nombre"];?></h5>
                  </div>
                </div>

              </div><!--box-body-->
              <div class="box-footer">
                 <button class="btn btn-success btn-reasignar" id="btn-reasignar" data-toggle="modal" data-target="#modalReasignarPC"><i class="fa fa-user-plus"></i> Reasignar</button>
              </div>
            </div>

      </div>



      <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="box">
          <div class="box-body">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
              </ol>
              <div class="carousel-inner">
              <div class="item">
              <img src="vistas/img/equipos/edu-083/foto_1.jpg" alt="First slide" width="500">
              <div class="carousel-caption">
              Foto 1
              </div>
              </div>
              <div class="item">
              <img src="vistas/img/equipos/edu-083/foto_2.jpg" alt="Second slide" width="500">
              <div class="carousel-caption">
              Foto 2
              </div>
              </div>
              <div class="item active">
              <img src="vistas/img/equipos/edu-083/foto_3.jpg" alt="Third slide" width="500">
              <div class="carousel-caption">
              Foto 3
              </div>
              </div>
              </div>
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span class="fa fa-angle-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span class="fa fa-angle-right"></span>
              </a>
            </div>
          </div><!--box-body-->
        </div>
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



<div id="modalReasignarPC" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reasignar Equipo:<strong><?php echo $equipo["nombre"]."</strong>, Serial: <strong>".$equipo["n_serie"];?></strong> </h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="divAlertError">
              
            </div>


            <div class="row">


              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Responsabilidad</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
             
             
                <div class="form-group">
                  <label>Responsable</label>
                  <select class="form-control" name="selectResponsableE">
                    <?php
                      $responsable = ControladorPersonas::ctrMostrarPersonas("sw", 1);

                      $contar = 0;
                      $gatillo = 0;

                      while ( $contar < count($responsable) && $gatillo == 0 ) 
                      {
                        if ( $responsable[$contar]["id"] == $equipo["id_responsable"] ) 
                        {
                          $areaR = ControladorAreas::ctrMostrarAreas("id", $responsable[$contar]["id_area"]);
                          echo '<option value="'.$responsable[$contar]["id"].'">'.$responsable[$contar]["nombre"].' - '.$areaR["nombre"].'</option>';
                          $gatillo = 1;
                        }
                        $contar++;
                      }

                      foreach ($responsable as $key => $value) :
                        $areaR = ControladorAreas::ctrMostrarAreas("id", $value["id_area"]);

                        if ($equipo["id_responsable"] != $value["id"]) 
                        {
                           echo '<option value="'.$value["id"].'">'.$value["nombre"].' - '.$areaR["nombre"].'</option>';
                        }
                      endforeach;
                    ?>
                  </select>
                </div>
              </div>


              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Asignado a:</label>
                  <select class="form-control" name="selectAsignadoE">
                    <?php

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

                    $contar = 0;
                    $gatillo = 0;

                    while ( $contar < count($usuarios) && $gatillo == 0 ) 
                    {
                      if ( $usuarios[$contar]["id"] == $equipo["id_usuario"] ) 
                      {
                        echo '<option value="'.$usuarios[$contar]["id"].'">'.$usuarios[$contar]["nombre"].'</option>';
                        $gatillo = 1;
                      }
                      $contar++;
                    }

                    foreach ($usuarios as $key => $value) 
                    {
                      if ($equipo["id_usuario"] != $value["id"]) 
                      {
                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }
                    }

                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Rol</label>
                  <select class="form-control" name="selectRolE">

                    <?php echo ( $equipo["rol"] == 0 ) ? '<option value="0">Contratista</option><option value="1">Empleado</option>' : '<option value="1">Empleado</option><option value="0">Contratista</option>' ; ?>

                    
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Proyecto:</label>
                  <select class="form-control" name="selectProyectoE">
                    <?php

                    $proyectos = ControladorProyectos::ctrMostrarProyectos(null, null);

                    foreach ($proyectos as $key => $value) 
                    {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    }

                    ?>
                  </select>
                </div>
              </div>

            </div><!--row-->

            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Fecha asignación:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control" name="dateReasignar" id="dateReasignar" value="" />
                  </div>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->



            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="textObservacionesE"></textarea>
              </div>
            </div>

          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Ingresar</button>
        </div>

        <?php

        $accionEquipo = new ControladorEquipos();
        $accionEquipo -> ctrAccionEquipo($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>