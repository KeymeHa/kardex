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
      $usr_gen = ControladorUsuarios::ctrMostrarNombrea($item, $equipo["id_usr_generado"]);


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
              <?php echo ($equipo["estado"] != 0)?'<button class="btn btn-warning pull-right btn-editarPC" nombre="'.$equipo["nombre"].'" data-toggle="modal" data-target="#modalEquipo" idPC="'.$equipo["id"].'" ><i class="fa fa-pencil"></i> Editar</button>': '';?>
              
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
                    if ( $equipo["id_licencia"] != 0 ) 
                    {
                      $licenciaE = ControladorEquipos::ctrMostrarLicencias("id", $equipo["id_licencia"]);

                      echo '<dt>Usuario</dt><dd>'.$licenciaE["usuario"].'</dd>';
                    }
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
                    echo ControladorEquipos::ctrMostrarItem($equipo["gpu_modelo"], 0, "Modelo GPU", "");
                    echo ($equipo["teclado"] == 1)? '<dt>Teclado</dt><dd>Incluido</dd>' : '' ;
                    echo ($equipo["mouse"] == 1)? '<dt>Mouse</dt><dd>Incluido</dd>' : '' ;
                    echo ControladorEquipos::ctrMostrarItem($equipo["so"], 1, "Sistema Operativo", "");
                    echo ControladorEquipos::ctrMostrarItem($equipo["so_version"], 1, "Versión SO", "");



                    //echo ( $equipo["id_licencia"] != 0 )? ControladorEquipos::ctrMostrarLicencias("id", $equipo["id_licencia"]) : "" ;

                  ?>
                </dl>
              </div><!--col-lg-6 col-md-6 col-sm-12-->
              
              <?php
              echo ( !empty($equipo["observaciones"]) )? '<div class="col-lg-12 col-md-12 col-sm-12"><dt>Observaciones</dt><dd>'.$equipo["observaciones"].'</dd></div>' : "" ;
              ?>

            </div><!--box-body-->
            <div class="box-footer">
             
              <?php 

              echo ($equipo["estado"] ==  1)? '<button type="button" class="btn btn-success btn-devolverPC" idPC="'.$equipo['id'].'" est="'.$equipo['estado'].'" data-toggle="modal" data-target="#modalEstadoPC"><i class="fa fa-sign-out"></i> Marcar como Devuelto</button> <button type="button" class="btn btn-success btn-AddSoporte" data-toggle="modal" data-target="#modalSoportePC" ><i class="fa fa-file"></i> Añadir Soporte</button>' :'<button  type="button" class="btn btn-success btn-devolverPC" idPC="'.$equipo['id'].'" est="'.$equipo['estado'].'" data-toggle="modal" data-target="#modalEstadoPC"><i class="fa fa-sign-in"></i> Ingresar Equipo</button>';

              /*
            <button type="button" class="btn btn-success"><i class="fa fa-bullhorn"></i> Reportar</button>
              */

              ?>
            </div>
          </div>

             <?php


                if ( $equipo['estado'] == 1 )
                {

                    if($equipo["id_usuario"] != 0 && $equipo["id_responsable"] != 0)
                    {

                      $usuario = ControladorUsuarios::ctrMostrarNombrea($item, $equipo["id_usuario"]);
                      $supervisor = ControladorUsuarios::ctrMostrarNombrea($item, $equipo["id_responsable"]);
                      //var_dump($equipo["id_area"]);

                      $area = (!is_null($equipo["id_area"]))?ControladorAreas::ctrMostrarNombreAreas($item, $equipo["id_area"]): "Error" ;

                     // $area = ControladorAreas::ctrMostrarNombreAreas($item, $equipo["id_area"]);
                      $proyecto = ControladorProyectos::ctrMostrarProyectos($item, $equipo["id_proyecto"]);

                       echo '<div class="box box-success">
                        <div class="box-header">
                          <h3 class="box-title">
                            Información de Usuario
                          </h3>
                        </div>
                        <div class="box-body">';


                        if ($equipo["rol"] == 0) 
                        {
                          echo '<div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                <div class="description-block border-right">
                                  <span class="description-text">Asignado</span>
                                  <h5 class="description-header">'.$usuario.'</h5>
                                  <h5 class="description-header">(Contratista)</h5>
                                </div>
                              </div>
                              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                <div class="description-block border-right">
                                  <span class="description-text">Resonsable</span>
                                  <h5 class="description-header">'.$supervisor.'</h5>
                                </div>
                              </div>
                              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                <div class="description-block border-right">
                                  <span class="description-text">Área</span>
                                  <h5 class="description-header">'.$area.'</h5>
                                </div>
                              </div>
                              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                <div class="description-block border-right">
                                  <span class="description-text">Proyecto</span>
                                  <h5 class="description-header">'.$proyecto["nombre"].'</h5>
                                </div>
                              </div>';
                        }//if ($equipo["rol"] == 0) 
                        else
                        {
                          //responsable solamente
                          echo '<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <div class="description-block border-right">
                                  <span class="description-text">Responsable</span>
                                  <h5 class="description-header">'.$usuario.'</h5>
                                  <h5 class="description-header">(Empleado)</h5>
                                </div>
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <div class="description-block border-right">
                                  <span class="description-text">Área</span>
                                  <h5 class="description-header">'.$area.'</h5>
                                </div>
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <div class="description-block border-right">
                                  <span class="description-text">Proyecto</span>
                                  <h5 class="description-header">'.$proyecto["nombre"].'</h5>
                                </div>
                              </div>';
                        }

                      echo '</div>
                          <div class="box-footer">
                               <button class="btn btn-success btn-reasignar" id="btn-reasignar" data-toggle="modal" data-target="#modalReasignarPC"><i class="fa fa-user-plus"></i> Reasignar</button>
                            </div>
                      </div>';

            

                    }
                    else
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

            <?php

            if (!empty($equipo["fotos"])) 
            {
              $fotosEquipo = json_decode($equipo["fotos"], true);

              if (!is_null($fotosEquipo) && is_countable($fotosEquipo[0]) && count($fotosEquipo[0]) > 0) 
              {

                echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">';

                for ($i = 0; $i < count($fotosEquipo[0]); $i++) 
                { 
                  if (isset($fotosEquipo[0][($i+1)]) ) 
                  {
                    $rutaImg = 'vistas/img/equipos/'.$equipo["n_serie"].'/'.$fotosEquipo[0][($i+1)];
                    if( file_exists($rutaImg) )
                    {
                       echo ($i == 0)?'<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>':'<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class=""></li>';
                    }
                  }
                }

                echo '</ol>
                      <div class="carousel-inner" style="height: 450px;">';

                for ($i = 0; $i < count($fotosEquipo[0]); $i++) 
                { 
                    if (isset($fotosEquipo[0][($i+1)]) ) 
                    {
                      $rutaImg = 'vistas/img/equipos/'.$equipo["n_serie"].'/'.$fotosEquipo[0][($i+1)];
                      if (file_exists($rutaImg)) 
                      {
                        echo ($i == 0)?'<div class="item active">
                        <img height="100%" src="'.$rutaImg.'" alt="Imagen '.($i+1).'">
                        <div class="carousel-caption">
                        <a style="text-decoration:none; color:white; text-shadow: 1px 1px 2px black;" href="'.$rutaImg.'" target="_blank"><i class="fa fa-expand"></i> Imagen '.($i+1).'</a>
                        </div>
                        </div>':'<div class="item">
                        <img height="100%" src="'.$rutaImg.'" alt="Imagen '.($i+1).'">
                          <div class="carousel-caption">
                            <a style="text-decoration:none; color:white; text-shadow: 2px 2px 2px black;" href="'.$rutaImg.'" target="_blank"><i class="fa fa-expand"></i> Imagen '.($i+1).'</a>
                          </div>
                        </div>';
                      }
                    }

                    
                }

                echo '<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                      </a>
                      </div></div>';

              }

            }
            else
            {
              $imgDefault = "vistas/img/equipos/default/MAC.png";

              echo (file_exists($imgDefault))?'<img class="img-responsive" src="'.$imgDefault.'" alt="Photo">':'<p>No hay nada para mostrar.</p>';
             
            }

            ?>

          </div><!--box-body-->
          <div class="box-footer">

            <?php

            if ($equipo["estado"] != 0) 
            {
              echo '<button class="btn btn-warning pull-right btn-editarFoto" data-toggle="modal" data-target="#modalImagenesPC" idPC="'.$equipo["id"].'" ><i class="fa fa-pencil"></i> ';
              echo (!empty($equipo["fotos"]) )?'Editar': 'Agregar';
              echo ' Imagen</button>';
            }

            ?>
          </div>
        </div>
      </div>


    <?php

      if ($equipo["historial"] != null) 
      {
        $grupoFechas = [];
        $trazabilidad = json_decode($equipo["historial"], true);

        if ( is_countable($trazabilidad) ) 
        {
          echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h3>Historial</h3></div></div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><ul class="timeline">';
            foreach ($trazabilidad as $key => $value) 
          {
            if (!in_array($value["fe"], $grupoFechas)) 
            {
              if (!empty($value["fe"])) 
              {
                $grupoFechas[] = $value["fe"];
              }
            }
          }// foreach ($accionesPQR as $key => $value) 

          sort($grupoFechas, SORT_STRING);

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
                                 <strong>'.ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["gen"]).'</strong>: Se dio de baja o se devolvio el equipo.
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

                          if($equipo["id_acta"] != 0)
                          {
                            $actaPDF = ControladorEquipos::ctrMostrarActas($item, $equipo["id_acta"]);

                             echo'<li>
                            <!-- timeline icon -->
                            <i class="fa fa-arrow-circle-up bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                                <h3 class="timeline-header"><a href="'.$actaPDF["file"].'"><i class="fa fa-paperclip"></i> Ingreso '.$actaPDF["codigo"].'</a></h3>

                                <div class="timeline-body">
                                    <strong>'.ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["gen"]).'</strong>: Ingreso el equipo.
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
                        case 2:

                        if ($trazabilidad[$x]["da"]["idAsg"] != 0 && $trazabilidad[$x]["da"]["idRes"] && $trazabilidad[$x]["da"]["idArea"]) 
                        {
                                                   echo'<li>
                          <!-- timeline icon -->
                          <i class="fa fa-share-square bg-blue"></i>
                          <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                              <h3 class="timeline-header docResposability" fe="'.$trazabilidad[$x]["fe"].'" idPC="'.$equipo["id"].'"><a href="#">Asignación</a></h3>

                              <div class="timeline-body">
                                  <strong>'.ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["gen"]).'</strong>: Se asigno el equipo a <strong>';



                                  $usuario_tr = ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["da"]["idAsg"]);
                                  $supervisor_tr = ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["da"]["idRes"]);
                                  $area_tr = ControladorAreas::ctrMostrarNombreAreas($item, $trazabilidad[$x]["da"]["idArea"]);

                                  echo($trazabilidad[$x]["da"]["idAsg"] == $trazabilidad[$x]["da"]["idRes"])? $usuario_tr.'</strong> del área '.$area_tr : $usuario_tr.'</strong> y quien supervisa su uso <strong>'.$supervisor_tr.'</strong> del área '.$area_tr ;

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
                        }
                        else
                        {
                      echo'<li>
                          <!-- timeline icon -->
                          <i class="fa fa-close bg-red"></i>
                          <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                              <h3 class="timeline-header"><a href="#">Asignación</a></h3>

                              <div class="timeline-body">
                                  Error de asignación no se puede visualizar el usuario u otros parametros.
                              </div>';

                      echo '
                          </div>
                      </li>';
                        }


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
                                  <strong>'.ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["gen"]).'</strong>: Adjunto un ';

                                  switch ($trazabilidad[$x]["da"]["type"]) {
                                    case 1:
                                      echo 'Doc. de Responsabilidad Firmado';
                                      break;

                                    case 2:
                                      echo 'Doc. Devolución Firmado';
                                      break;

                                    case 3:
                                      echo 'Solicitud de Soporte';
                                      break;

                                    case 4:
                                      echo 'Otro';
                                      break;
                                    
                                    default:
                                      echo 'soporte';
                                      break;
                                  }


                                  echo '
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


                        case 4:


                           echo'<li>
                          <!-- timeline icon -->
                          <i class="fa fa-pencil bg-yellow"></i>
                          <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                              <h3 class="timeline-header"><a href="#">Edición</a></h3>

                              <div class="timeline-body">
                                  <strong>'.ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["gen"]).'</strong>: se Modificaron los siguientes valores: '.$trazabilidad[$x]["da"].'.
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

                        case 5:



                           $actaPDF1 =($trazabilidad[$x]["acct1"] != 0)? ControladorEquipos::ctrMostrarActas($item, $trazabilidad[$x]["acct1"]) : 0 ;

                            $actaPDF2 = ControladorEquipos::ctrMostrarActas($item, $trazabilidad[$x]["acct2"]);

                            if (isset($actaPDF2["file"]) && file_exists($actaPDF2["file"])) 
                            {
                              echo'<li>
                                <!-- timeline icon -->
                                <i class="fa fa-file-pdf-o bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                                    <h3 class="timeline-header"><a href="#">Cambio de Acta</a></h3>

                                    <div class="timeline-body">
                                    ';

                                    echo ($trazabilidad[$x]["acct1"] != 0)? '<strong>'.ControladorUsuarios::ctrMostrarNombrea($item, $trazabilidad[$x]["gen"]).'</strong>: Cambio del acta <a href="'.$actaPDF1["file"].'">'.$actaPDF1["codigo"].'</a> a <a href="'.$actaPDF2["file"].'">'.$actaPDF2["codigo"].'</a>' : 'Se asigna al alta acta: <a href="'.$actaPDF2["file"].'">'.$actaPDF2["codigo"].'</a>' ;

                                       
                                   echo '</div>';

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
                            else{
                               echo'<li>
                              <!-- timeline icon -->
                              <i class="fa fa-close bg-red"></i>
                              <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> '.$trazabilidad[$x]["hr"].'</span>

                                  <h3 class="timeline-header"><a href="#">No se encontro el archivo del acta</a></h3>
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
                <div class="col-lg-12 col-md-12 col-ms-12"><div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
            Existe un problema en la información tipo JSON.
            </div></div>
                ';
        }

        

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

                      if ($equipo["id_responsable"] != 0) 
                      {
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
                      }
                      else
                      {
                        echo '<option value="0">Seleccione un Responsable</option>';
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

                    if ($equipo["id_usuario"] != 0) 
                    {
                        while ( $contar < count($usuarios) && $gatillo == 0 ) 
                      {
                        if ( $usuarios[$contar]["id"] == $equipo["id_usuario"] ) 
                        {
                          echo '<option value="'.$usuarios[$contar]["id"].'">'.$usuarios[$contar]["nombre"].'</option>';
                          $gatillo = 1;
                        }
                        $contar++;
                      }
                    }
                    else
                    {
                       echo '<option value="0">Seleccione un asignado</option>';
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

<?php include("modal/equipo.php")?>

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
              <input type="radio" name="optionTipoSp" id="opTipoS1" value="1" checked="">
              Doc. de Responsabilidad Firmado
              </label>
              </div>

              <div class="radio">
              <label>
              <input type="radio" name="optionTipoSp" id="opTipoS2" value="2">
              Doc. Devolución Firmado
              </label>
              </div>

              <div class="radio">
              <label>
              <input type="radio" name="optionTipoSp" id="opTipoS3" value="3">
              Solicitud de Soporte
              </label>
              </div>

              <div class="radio">
              <label>
              <input type="radio" name="optionTipoSp" id="opTipoS4" value="4">
              Otro
              </label>
              </div>
            </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Fecha Soporte:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control" name="dateSoporte" id="dateSoporte" value="" />
                  </div>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

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

<?php 

  include("modal/modalEstadoPC.php");

?>

<div id="modalImagenesPC" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

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

            <input type="hidden" class="inputIdImagenesPC" required readonly name="inputIdImagenesPC" id="inputIdImagenesPC" value="<?php echo $equipo['id'];?>">

            <div class="form-group">
              <label>Fotos equipo:</label>
              <div class="input-group date">
                <input name="fotosE[]" type="file" multiple />
              </div>
            </div>
          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      <?php

      $imagenesPc = new ControladorEquipos();
      $imagenesPc -> ctrImagenesEquipo($_SESSION["id"]);

      ?>
      </form>
    </div>
  </div>
</div>
