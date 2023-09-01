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
      
      $usr_gen = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_usr_generado"]);


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
      
      Equipo: <b><?php echo $equipo["nombre"]; echo ( $equipo['estado'] == 1 )? '(Activo)' : '(Devuelto)' ; ?></b>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="equipos">Base de Datos PC</a></li>
      
      <li class="active"><?php echo $equipo["nombre"];?></li>
    
    </ol>

  </section>

  <section class="content">


      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="box <?php echo ( $equipo['estado'] == 1 )? 'box-success' : 'box-danger' ; ?>">
            <div class="box-header">
              <h3 class="box-title">
              Caracteristicas
              </h3>
              <?php echo ($equipo["estado"] != 0)?'<button class="btn btn-warning pull-right btn-editarPC" data-toggle="modal" data-target="#modalEditarPc" idPC="'.$equipo["id"].'" ><i class="fa fa-pencil"></i> Editar</button>': '';?>
              
            </div>
            <div class="box-body">
              
              <div class="col-lg-6 col-md-6 col-sm-12">
                <dl class="dl-horizontal">
                  <?php 
                    echo ControladorEquipos::ctrMostrarItem($equipo["n_serie"], 0, "Serial", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["nombre"], 0, "Nombre PC", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["serialD"], 0, "2do Serial", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["id_propietario"], 1, "Propietario", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["id_arquitectura"], 1, "Arquitectura", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["marca"], 1, "Marca", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["modelo"], 1, "Modelo", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["cpu"], 1, "CPU", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["cpu_modelo"], 1, "Modelo CPU", "");
                  ?>
                </dl>
              </div><!--col-lg-6 col-md-6 col-sm-12-->

               <div class="col-lg-6 col-md-6 col-sm-12">
                <dl class="dl-horizontal">
                  <?php 
                    echo ControladorEquipos::ctrMostrarItem($equipo["ram"], 0, "Memoria RAM", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["ssd"], 0, "Disco SSD", "GB");
                    echo ControladorEquipos::ctrMostrarItem($equipo["hdd"], 0, "HDD", "GB");
                    echo ControladorEquipos::ctrMostrarItem($equipo["gpu"], 0, "GPU", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["gpu_modelo"], 1, "Modelo GPU", "");
                    echo ($equipo["teclado"] == 1)? '<dt>Teclado</dt><dd>Incluido</dd>' : '' ;
                    echo ($equipo["mouse"] == 1)? '<dt>Mouse</dt><dd>Incluido</dd>' : '' ;
                    echo ControladorEquipos::ctrMostrarItem($equipo["so"], 1, "Sistema Operativo", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["so_version"], 1, "Versión SO", "");

                  ?>
                </dl>
              </div><!--col-lg-6 col-md-6 col-sm-12-->
              
              <?php
              echo ( !empty($equipo["observaciones"]) )? '<div class="col-lg-12 col-md-12 col-sm-12"><dt>Observaciones</dt><dd>'.$equipo["observaciones"].'</dd></div>' : "" ;
              ?>

            </div><!--box-body-->
            <div class="box-footer">
             
              <?php 

              echo ($equipo["estado"] ==  1)? '<button type="button" class="btn btn-success btn-devolverPC" idPC="'.$equipo['id'].'" est="'.$equipo['estado'].'" data-toggle="modal" data-target="#modalEstadoPC"><i class="fa fa-sign-out"></i> Marcar como Devuelto</button><button type="button" class="btn btn-success"><i class="fa fa-bullhorn"></i> Reportar</button> <button type="button" class="btn btn-success btn-AddSoporte"  data-toggle="modal" data-target="#modalSoportePC" ><i class="fa fa-file"></i> Añadir Soporte</button>' :'<button  type="button" class="btn btn-success btn-devolverPC" idPC="'.$equipo['id'].'" est="'.$equipo['estado'].'" data-toggle="modal" data-target="#modalEstadoPC"><i class="fa fa-sign-in"></i> Ingresar Equipo</button>';

              ?>
            </div>
          </div>

                <?php


                if ( $equipo['estado'] == 1 )
                {

                  if($equipo["id_usuario"] != 0 && $equipo["id_responsable"] != 0)
                  {

                    $usuario = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_usuario"]);
                    $supervisor = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_responsable"]);
                    $area = ControladorAreas::ctrMostrarNombreAreas($item, $equipo["id_area"]);
                    $proyecto = ControladorProyectos::ctrMostrarProyectos($item, $equipo["id_proyecto"]);

                      echo '<div class="box box-success">
              <div class="box-header">
                <h3 class="box-title">
                  Información de Usuario
                </h3>
              </div>
              <div class="box-body">';

                if ( $equipo["id_responsable"] == $equipo["id_usuario"] )
                {
                  echo '<div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
                  <div class="description-block border-right">
                    <span class="description-text">Asignado</span>
                    <h5 class="description-header">'.$usuario.'</h5>
                    <h5 class="description-header">'; 
                  echo ( $equipo["rol"] == 0 ) ? "(Contratista)" : "(Empleado)" ;

                  echo '</h5>
                    </div>
                </div>';

                }
                

                echo '<div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
                  <div class="description-block border-right">
                    <span class="description-text">Asignado</span>
                    <h5 class="description-header">'.$usuario.'</h5>
                    <h5 class="description-header">';

                    echo ( $equipo["rol"] == 0 ) ? "(Contratista)" : "(Empleado)" ; echo '</h5>
                  </div>
                </div>';


                echo '
                <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
                  <div class="description-block border-right">
                    <span class="description-text">Supervisor</span>
                    <h5 class="description-header">'.$supervisor.'</h5>
                  </div>
                </div>

                <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
                  <div class="description-block border-right">
                    <span class="description-text">Área</span>
                    <h5 class="description-header">'.$area.'</h5>
                  </div>
                </div>

                <div class="col-sm-3 col-xs-3 col-lg-3 col-md-3">
                  <div class="description-block border-right">
                    <span class="description-text">Proyecto</span>
                    <h5 class="description-header">'.$proyecto["nombre"].'</h5>
                  </div>
                </div>

              </div><!--box-body-->
              <div class="box-footer">
                 <button class="btn btn-success btn-reasignar" id="btn-reasignar" data-toggle="modal" data-target="#modalReasignarPC"><i class="fa fa-user-plus"></i> Reasignar</button>
              </div>
            </div>';


                  }else
                  {
                    echo '<div class="box box-default"><div class="box-footer">
                 <button class="btn btn-success btn-reasignar" id="btn-reasignar" data-toggle="modal" data-target="#modalReasignarPC"><i class="fa fa-user-plus"></i> Asignar</button>
              </div></div>';
                  }

                

                }//if ( $estado['estado'] == 1 )
                else
                {
                  echo '<div class="box box-default"><div class="box-header"><h3>Sin información de usuario</h3></div></div>';
                }
              


                ?>


      </div>



      <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="box <?php echo ( $equipo['estado'] == 1 )? 'box-success' : 'box-danger' ; ?>">
          <div class="box-body  box-<?php echo ($equipo['estado'] == 1 )? 'success' : 'danger' ; ?> ">

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


    <?php

      if ($equipo["historial"] != null) 
      {
 
        echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h3>Historial</h3></div></div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><ul class="timeline">';

        $grupoFechas = [];
        $trazabilidad = json_decode($equipo["historial"], true);

        foreach ($trazabilidad as $key => $value) 
        {
          if (!in_array($value["fe"], $grupoFechas)) 
          {
            $grupoFechas[] = $value["fe"];
          }
        }// foreach ($accionesPQR as $key => $value) 


        for ($y=0; $y < count($grupoFechas) ; $y++) 
        {
          $fechaTemp = ControladorParametros::ctrOrdenFecha($grupoFechas[$y], 0);
          echo ' <li class="time-label">
              <span class="bg-red">
                  '.$fechaTemp.'
              </span>
          </li>';

           for ($x=0; $x < count($trazabilidad); $x++) 
            {
                if ($grupoFechas[$y] == $trazabilidad[$x]["fe"]) 
                {
                   switch ($trazabilidad[$x]["acc"]) 
                   {
                      case 0:
                         echo'<li>
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down bg-red"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                            <h3 class="timeline-header"><a href="#">Salida</a></h3>

                            <div class="timeline-body">
                               <strong>'.$usr_gen.'</strong>: Se dio de baja o se devolvio el equipo.
                            </div>';

                            if (isset($trazabilidad[$x]["obs"])) 
                            {
                               echo ( !empty($trazabilidad[$x]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["obs"].'
                            </div>' : '' ;
                            }
                            else
                            {
                               echo ( !empty($trazabilidad[$x]["da"]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["da"]["obs"].'
                            </div>' : '' ;
                            }

                    echo '
                        </div>
                    </li>';
                        break;
                      case 1:

                         $actaPDF = ControladorEquipos::ctrMostrarActas($item, $equipo["id_acta"]);

                         echo'<li>
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-up bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                            <h3 class="timeline-header"><a href="vistas/actas'.$actaPDF["file"].'"><i class="fa fa-paperclip"></i> Ingreso '.$actaPDF["codigo"].'</a></h3>

                            <div class="timeline-body">
                                <strong>'.$usr_gen.'</strong>: Ingreso el equipo.
                            </div>';

                            if (isset($trazabilidad[$x]["obs"])) 
                            {
                               echo ( !empty($trazabilidad[$x]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["obs"].'
                            </div>' : '' ;
                            }
                            else
                            {
                               echo ( !empty($trazabilidad[$x]["da"]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["da"]["obs"].'
                            </div>' : '' ;
                            }

                    echo '
                        </div>
                    </li>';
                        break;
                      case 2:
                         echo'<li>
                        <!-- timeline icon -->
                        <i class="fa fa-share-square bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                            <h3 class="timeline-header"><a href="#">Asignación</a></h3>

                            <div class="timeline-body">
                                <strong>'.$usr_gen.'</strong>: Se asigno el equipo a ';


                                $usuario_tr = ControladorUsuarios::ctrMostrarNombre($item, $trazabilidad[$x]["da"]["idAsg"]);
                                $supervisor_tr = ControladorUsuarios::ctrMostrarNombre($item, $trazabilidad[$x]["da"]["idRes"]);
                                $area_tr = ControladorAreas::ctrMostrarNombreAreas($item, $trazabilidad[$x]["da"]["idArea"]);

                                echo($trazabilidad[$x]["da"]["idAsg"] == $trazabilidad[$x]["da"]["idRes"])? $usuario_tr.' del área '.$area_tr : $usuario_tr.' y quien supervisa su uso '.$supervisor_tr.' del área '.$area_tr ;

                                echo'
                            </div>';

                            if (isset($trazabilidad[$x]["obs"])) 
                            {
                               echo ( !empty($trazabilidad[$x]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["obs"].'
                            </div>' : '' ;
                            }
                            else
                            {
                               echo ( !empty($trazabilidad[$x]["da"]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["da"]["obs"].'
                            </div>' : '' ;
                            }

                    echo '
                        </div>
                    </li>';
                        break;
                      case 3:


                        if (!file_exists("vistas/doc/equipos/".$equipo["nombre"]."/".$trazabilidad[$x]["da"]["file"].".pdf")) {
                           echo'<li>
                        <!-- timeline icon -->
                        <i class="fa fa-close bg-red"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                            <h3 class="timeline-header"><a href="#">Soporte</a></h3>

                            <div class="timeline-body">
                                No se encontro el archivo
                            </div>

                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">...</a>
                            </div>
                        </div>
                    </li>';
                        }
                        else
                        {
                                                     echo'<li>
                        <!-- timeline icon -->
                        <i class="fa fa-book bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                            <h3 class="timeline-header"><a href="vistas/doc/equipos/'.$equipo["nombre"].'/'.$trazabilidad[$x]["da"]["file"].'.pdf"><i class="fa fa-book"></i> Soporte</a></h3>

                            <div class="timeline-body">
                                <strong>'.$usr_gen.'</strong>: Adjunto un soporte.
                            </div>';

                            if (isset($trazabilidad[$x]["obs"])) 
                            {
                               echo ( !empty($trazabilidad[$x]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["obs"].'
                            </div>' : '' ;
                            }
                            else
                            {
                               echo ( !empty($trazabilidad[$x]["da"]["obs"]) )? '<div class="timeline-footer">
                                '.$trazabilidad[$x]["da"]["obs"].'
                            </div>' : '' ;
                            }

                    echo '
                        </div>
                    </li>';
                        }


                        break;
                      
                      default:
                         echo'<li>
                        <!-- timeline icon -->
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                            <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                            <div class="timeline-body">
                                ...
                                Content goes here
                            </div>

                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">...</a>
                            </div>
                        </div>
                    </li>';
                        break;
                    }
                }
            }

        }

echo '
</ul></div></div>
          ';

      }
      else
      {
        echo '<div class="col-md-12">
      <h3>Trazabilidad</h3>
    </div>
    <div class="col-lg-12 col-md-12 col-ms-12"><div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-warning"></i> Alerta!</h4>
No se encontraron datos.
</div></div>
    ';
      }





    ?>
   
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
                  <input type="hidden" name="idEReasignar" value="<?php echo $_GET['idpc']?>" required readonly>
                  <select class="form-control" name="selectResponsableE" required>
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
                  <select class="form-control" name="selectAsignadoE" required>
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
                  <select class="form-control" name="selectRolE" required>

                    <?php echo ( $equipo["rol"] == 0 ) ? '<option value="0">Contratista</option><option value="1">Empleado</option>' : '<option value="1">Empleado</option><option value="0">Contratista</option>' ; ?>

                    
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Proyecto:</label>
                  <select class="form-control" name="selectProyectoE" required>
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
        $accionEquipo -> ctrReasignacion($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>


<div id="modalEditarPc" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Equipo: <?php echo $equipo["nombre"];?></h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="divAlertError">
              
            </div>

            <div class="col-md-6 col-lg-4 col-sm-12">

              <div class="form-group">
                <label for="pc_serial">*Serial</label>
                <input type="text" class="form-control pc_serial" id="pc_serial" placeholder="Ingrese número serie" required autocomplete="off" name="inputSerialE">
                 <input type="hidden" class="inputEquipoAccion" required readonly name="inputEquipoAccion" id="inputEquipoAccion" value="<?php echo $equipo['id'];?>">
              </div>

              <div class="form-group">
                <label for="pc_serialD">Segundo Serial</label>
                <input type="text" class="form-control inputSerialDE" id="pc_serialD" placeholder="número de serie opcional" autocomplete="off" name="inputSerialDE">
              </div>


              <div class="form-group">
                <label for="pc_nombreE">*Nombre PC</label>
                <input type="text" class="form-control inputNombreE" id="pc_nombreE" placeholder="EDU-000" autocomplete="off" name="inputNombreE">
              </div>

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Propietario</label>

                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success btn-addParam" param="2">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>

                    <select class="form-control selectIdProE" id="selectIdProE" required name="selectIdProE">
                    </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->  

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Arquitectura</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="1"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectIdArqE" id="selectIdArqE" required name="selectIdArqE">
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Marca Equipo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="3"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectIdMarcaE" id="selectIdMarcaE" required name="selectIdMarcaE">
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Modelo</label>

                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success btn-addParam" param="4"><i class="fa fa-plus"></i></button>
                    </div>

                    <select class="form-control selectIdModeloE" id="selectIdModeloE" required name="selectIdModeloE">
                    </select>
                  </div>



               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->


            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="col-md-6 col-lg-4 col-sm-12">


<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*CPU: Marca</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="5"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectIdCPUE" id="selectIdCPUE" required name="selectIdCPUE">
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*CPU: Modelo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="6"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectIdCPUModE" id="selectIdCPUModE" required name="selectIdCPUModE">
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

              <div class="form-group">
                <label>*CPU: Generación</label>
                <select class="form-control selectIdCPUGenE" required name="selectIdCPUGenE">
                </select>
              </div>

              <div class="form-group">
                <label for="pc_cpufre">*CPU: Frecuencia (Ghz)</label>
                <input type="text" class="form-control inputCPUFreE" id="pc_cpufre" placeholder="2.5" value="0" name="inputCPUFreE">
              </div>

              <div class="form-group">
                <label for="pc_ram">*Capacidad RAM (Gb)</label>
                <input type="number" class="form-control inputRamE" id="pc_ram" min="4" value="8" placeholder="8" required name="inputRamE">
              </div>

              <div class="form-group">
                <label for="pc_ssd">*SSD (Gb)</label>
                <input type="number" class="form-control inputSSDE" id="pc_ssd" min="120" value="250" placeholder="250" required name="inputSSDE">
              </div>


            </div><!--col-md-6 col-lg-4 col-sm-12-->

<!------------------------------------------------------------------------------------------------->

            <div class="col-md-6 col-lg-4 col-sm-12">
              
              <div class="form-group">
                <label for="pc_hdd">HDD (Gb)</label>
                <input type="number" class="form-control inputHDDE" id="pc_hdd" min="120" value="" placeholder="1000" name="inputHDDE">
              </div>

              <div class="form-group">
                <label for="pc_gpumarca">GPU: Marca</label>
                <input type="text" class="form-control inputGPUE" id="pc_gpumarca" placeholder="NVIDIA, AMD" name="inputGPUE">
              </div>

              <div class="form-group">
                <label for="pc_gpumodelo">GPU: Modelo</label>
                <input type="text" class="form-control inputGPUModE" id="pc_gpumodelo" placeholder="Gforce, Radeon" name="inputGPUModE">
              </div>

              <div class="form-group">
                <label for="pc_gpucap">GPU: Capacidad (Gb)</label>
                <input type="number" class="form-control inputGPUCapE" id="pc_gpucap" placeholder="2" name="inputGPUCapE">
              </div>

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Sistema Operativo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="7"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectSOE" id="selectSOE" required name="selectSOE">
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->


              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Versión SO</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="8"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectSOVerE" id="selectSOVerE" required name="selectSOVerE">
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->
            
            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="form-group">

                <div class="col-md-3 col-lg-2 col-sm-6">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" class="checkTecladoE" name="checkTecladoE">
                    Teclado
                    </label>
                  </div>
                </div>

                <div class="col-md-3 col-lg-2 col-sm-6">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" class="checkMouseE" name="checkMouseE">
                    Mouse
                    </label>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Ingreso</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Fecha Ingreso:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control" name="dateIngresoE" id="dateIngresoE" value="" />
                  </div>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Acta de Ingreso</label>
                  <select class="form-control selectIdActaE" id="selectIdActaE" required name="selectIdActaE">
                  </select>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

            </div><!--col-lg-12 col-md-12 col-sm-12-->

            <div class="row">


              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Responsabilidad</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
             
             
                <div class="form-group">
                  <label>Responsable</label>
                  <select class="form-control selectResponsableE" id="selectResponsableE" name="selectResponsableE">
                  </select>
                </div>
              </div>


              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Asignado a:</label>
                  <select class="form-control selectAsignadoE" id="selectAsignadoE" name="selectAsignadoE">
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Rol</label>
                  <select class="form-control selectRolE" id="selectRolE" name="selectRolE">
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Proyecto:</label>
                  <select class="form-control selectProyectoE" id="selectProyectoE" name="selectProyectoE">
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Licencia</label>
                  <select class="form-control selectLicenciaE" id="selectLicenciaE" name="selectLicenciaE">
                  </select>
                </div>
              </div>


              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Fotos equipo:</label>
                  <div class="input-group date">
                    <input type="file" name="fotosE[]" id="fotosE" multiple>
                  </div>
                </div>
              </div>

            </div><!--row-->

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="textObservacionesE"></textarea>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Nota: los campos con el simbolo * son campos requeridos</label>
              </div>
            </div>            


          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Editar</button>
        </div>

        <?php

        $accionEquipo = new ControladorEquipos();
        $accionEquipo -> ctrAccionEquipo($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>

<div id="modalSoportePC" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Soporte: <strong><?php echo $equipo["nombre"]."</strong>, Serial: <strong>".$equipo["n_serie"];?></strong> </h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="divAlertError">
            </div>

            <div class="form-group">
              <label for="soportePC">Soporte</label>
              <input type="file" id="soportePC" name="soportePC">
              <p class="help-block">Acepta solo Archivo PDF.</p>
            </div>

                        <div class="form-group">
              <div class="radio">
              <label>
              <input type="radio" name="optionsRadios" id="optionTipoEstado1" value="1" checked="">
              Doc. de Responsabilidad Firmado
              </label>
              </div>

              <div class="radio">
              <label>
              <input type="radio" name="optionsRadios" id="optionTipoEstado2" value="2">
              Doc. Devolución Firmado
              </label>
              </div>

              <div class="radio">
              <label>
              <input type="radio" name="optionsRadios" id="optionTipoEstado3" value="3">
              Solicitud de Soporte
              </label>
              </div>

              <div class="radio">
              <label>
              <input type="radio" name="optionsRadios" id="optionTipoEstado4" value="3">
              Otro
              </label>
              </div>
            </div>

            <input type="hidden" class="inputSoporteID" required readonly name="inputSoporteID" id="inputSoporteID" value="<?php echo $equipo['id'];?>">

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="textObsSE"></textarea>
              </div>
            </div>

          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Añadir</button>
        </div>

        <?php

        $addSoporte = new ControladorEquipos();
        $addSoporte -> ctrSoporte($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>

<div id="modalEstadoPC" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="title-estado"></span> <strong><?php echo $equipo["nombre"]."</strong>, Serial: <strong>".$equipo["n_serie"];?></strong></h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="divAlertError">
            </div>

            <input type="hidden" class="inputEstadoPC" required readonly name="inputEstadoPC" id="inputEstadoPC" value="<?php echo $equipo['id'];?>">

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="textObsEE"></textarea>
              </div>
            </div>

            <div class="divAsignacionEstado">
            </div>


          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Aceptar</button>
        </div>

        <?php

        $estadoPC = new ControladorEquipos();
        $estadoPC -> ctrEstadoEquipo($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>
