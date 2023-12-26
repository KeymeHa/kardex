<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Resumen</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Paneles</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
       
          <div class="row">
                <?php 

                //$area_o = ControladorPersonas::ctrMostrarPersonas("id_usuario", 11);
                //var_dump($area_o);

                if($_SESSION["perfil"] == 1 || $_SESSION["perfil"] == 2){ echo'<div class="col-lg-6 col-md-6 col-xs-12">


                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Usuarios</h3>

                    <p>Puedes Agregar, Eliminar, modificar datos de usuarios</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="usuarios" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-6 col-md-6 col-xs-12-->';}


               if($_SESSION["perfil"] == 1 || $_SESSION["perfil"] == 2 || $_SESSION["perfil"] == 10){ echo'<div class="col-lg-6 col-md-6 col-xs-12">


                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Base de Datos PC</h3>

                    <p>Lista El invantario de Equipos de Computo.</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-desktop"></i>
                  </div>
                  <a href="equipos" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-6 col-md-6 col-xs-12-->';}

              if($_SESSION["perfil"] == '7' || $_SESSION["perfil"] == '3')
              {
                echo'<div class="col-lg-6 col-md-6 col-xs-12">


                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Encargados</h3>

                    <p>Puedes permitir a un usuario que se encarge de tus módulos.</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="asignaciones" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-6 col-md-6 col-xs-12-->';
              }


              if($_SESSION["perfil"] == '7')
              {
                 echo'<div class="col-lg-6 col-md-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>Registros</h3>
                      <p>Contiene la base de datos de todos los PQR registrados en sistema.</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-balance-scale"></i>
                    </div>
                    <a href="registros" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!--col-lg-6 col-md-6 col-xs-12-->';
              }


               if($_SESSION["perfil"] == '6')
              {
                 echo'<div class="col-lg-6 col-md-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>Radicados</h3>
                      <p>Genera Radicados y los registra en sistema.</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <a href="radicado" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!--col-lg-6 col-md-6 col-xs-12-->

                <div class="col-lg-6 col-md-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Cortes</h3>
                      <p>Visualiza Los cortes y planaillas generados.</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-newspaper-o"></i>
                    </div>
                    <a href="cortes" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!--col-lg-6 col-md-6 col-xs-12-->';
              }


              if($_SESSION["perfil"] == '3'){ echo'<div class="col-lg-6 col-md-6 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Inventario</h3>
                    <p>Ralación de todos los insumos almacenados en bodega.</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <a href="inventario" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-6 col-md-6 col-xs-12-->
              <div class="col-lg-6 col-md-6 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>Proveedores</h3>
                    <p>Lista de cada uno de los proveedores conocidos y asociados.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <a href="proveedores" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-6 col-md-6 col-xs-12-->
              <div class="col-lg-6 col-md-6 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>Generaciones</h3>
                    <p>Ingreso de Remisiones, ordenes de compra y pedidos de los usuarios.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-file-text"></i>
                  </div>
                  <a href="generaciones" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-6 col-md-6 col-xs-12-->';}

                $swmod = 0;

                $idmodulo = 3;
                $verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

                if ( isset($verModulo["modulo"]) &&  $verModulo["modulo"] == $idmodulo) 
                {
                     echo '<div class="col-lg-6 col-md-6 col-xs-12">

                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>Generar Requisición</h3>
                          <p>Crea tu solicitud de con los insumos necesarios para tu labor.</p>
                          
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text"></i>
                        </div>
                        <a href="requisicion" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div><!--col-lg-6 col-md-6 col-xs-12-->


                    <div class="col-lg-6 col-md-6 col-xs-12">

                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>Historial de Requisiciones</h3>
                          <p>Valida las Requisiciones aprobadas.</p>
                          
                        </div>
                        <div class="icon">
                          <i class="fa fa-cart-arrow-down"></i>
                        </div>
                        <a href="index.php?ruta=hisRequisicion&iduser='.$_SESSION["id"].'" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div><!--col-lg-6 col-md-6 col-xs-12-->';

                     $swmod = 1;

                }

                if ($_SESSION["perfil"] == '11') 
                {
                  echo'<script> window.location="registros";</script>';
                }
                else
                {
                    $idmodulo = 7;
                    $verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

                    if ( isset($verModulo["modulo"]) &&  $verModulo["modulo"] == $idmodulo) 
                    {
                         echo'<div class="col-lg-6 col-md-6 col-xs-12">
                              <!-- small box -->
                              <div class="small-box bg-blue">
                                <div class="inner">
                                  <h3>Base de Datos</h3>

                                  <p>Registros de PQR tramitadas o por tramitar.</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-balance-scale"></i>
                                </div>
                                <a href="registros" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div><!--col-lg-6 col-md-6 col-xs-12-->';

                     $swmod = 1;

                    }
                }

                

                if ( $swmod == 0 && $_SESSION["perfil"] == 4) 
                {
                  echo '<br><div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Modulos</span>
                        <span class="info-box-number">Si te aparece este mensaje, solicita que te asignen un módulo para su gestión.</span>
                        </div>

                        </div>

                        </div>';
                }

                ?>

          </div>

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

     <?php

      if ($_SESSION["perfil"] == '3') 
      {
        echo '
    <div class="row">

      <div class="col-lg-6">
        <div class="box">
          <div class="box-header">


             <h4>Inversiónes</h4>

             <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
          </div>
          <div class="box-body">';

        include "reportes/dgInversion.php";


        echo '
          </div>
        </div>
        
      </div>

      <div class="col-lg-6">';

        include "reportes/rqInsumos.php";

        echo '
      </div>
      
    </div>';
      }
    ?>


    <?php

    $mis_equipos = ControladorEquipos::ctrMostrarEquipos("id_usuario" , $_SESSION["id"]);

    if (!is_null($mis_equipos) && is_countable($mis_equipos) && count($mis_equipos) > 0 ) 
    {
        echo '<div class="box">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-television"></i> Computadores asignados</h3>
          </div>
        </div>';

        for ($i=0; $i < count($mis_equipos); $i++) 
        { 
                  echo '<div class="box">
          <div class="box-header">
            <h3 class="box-title">PC Serial: <b>'.$mis_equipos[$i]["n_serie"].'</b></h3>
          </div>
          <div class="box-body">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <dl class="dl-horizontal">
                
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["n_serie"], 0, "Serial", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["nombre"], 0, "Nombre PC", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["serialD"], 0, "2do Serial", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["id_propietario"], 1, "Propietario", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["id_arquitectura"], 1, "Arquitectura", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["marca"], 1, "Marca", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["modelo"], 1, "Modelo", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["cpu"], 1, "CPU", "").'
                  '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["cpu_modelo"], 1, "Modelo CPU", "").'

              </dl>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <dl class="dl-horizontal">
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["ram"], 0, "Memoria RAM", "").'
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["ssd"], 0, "Disco SSD", "GB").'
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["hdd"], 0, "HDD", "GB").'
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["gpu"], 0, "GPU", "").'
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["gpu_modelo"], 0, "Modelo GPU", "").'
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["so"], 1, "Sistema Operativo", "").'
                    '.ControladorEquipos::ctrMostrarItem($mis_equipos[$i]["so_version"], 1, "Versión SO", "").'
                </dl>
              </div><!--col-lg-6 col-md-6 col-sm-12-->';

              if (!empty($mis_equipos[$i]["fotos"])) 
              {
                $fotosEquipo = json_decode($mis_equipos[$i]["fotos"], true);

                if (!is_null($fotosEquipo) && is_countable($fotosEquipo[0]) && count($fotosEquipo[0]) > 0) 
                {

                  echo '
                    <div class="col-sm-4">';

                  echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">';

                  for ($j = 0; $j < count($fotosEquipo[0]); $j++) 
                  { 
                    if (isset($fotosEquipo[0][($j+1)]) ) 
                    {
                      $rutaImg = 'vistas/img/equipos/'.$mis_equipos[$i]["n_serie"].'/'.$fotosEquipo[0][($j+1)];
                      if( file_exists($rutaImg) )
                      {
                         echo ($j == 0)?'<li data-target="#carousel-example-generic" data-slide-to="'.$j.'" class="active"></li>':'<li data-target="#carousel-example-generic" data-slide-to="'.$j.'" class=""></li>';
                      }
                    }
                  }

                  echo '</ol>
                        <div class="carousel-inner" style="height: 450px;">';

                  for ($j = 0; $j < count($fotosEquipo[0]); $j++) 
                  { 
                      if (isset($fotosEquipo[0][($j+1)]) ) 
                      {
                        $rutaImg = 'vistas/img/equipos/'.$mis_equipos[$i]["n_serie"].'/'.$fotosEquipo[0][($j+1)];
                        if (file_exists($rutaImg)) 
                        {
                          echo ($j == 0)?'<div class="item active">
                          <img height="100%" src="'.$rutaImg.'" alt="Imagen '.($j+1).'">
                          <div class="carousel-caption">
                          <a style="text-decoration:none; color:white; text-shadow: 1px 1px 2px black;" href="'.$rutaImg.'" target="_blank"><i class="fa fa-expand"></i> Imagen '.($j+1).'</a>
                          </div>
                          </div>':'<div class="item">
                          <img height="100%" src="'.$rutaImg.'" alt="Imagen '.($j+1).'">
                            <div class="carousel-caption">
                              <a style="text-decoration:none; color:white; text-shadow: 2px 2px 2px black;" href="'.$rutaImg.'" target="_blank"><i class="fa fa-expand"></i> Imagen '.($j+1).'</a>
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


                  echo '</div>';
                }

              }
              else{
                echo '<div class="col-sm-4"><p class="lead">sin imagen para mostrar.</p></div>';
              }

              echo '
          </div>
        </div>';





        }

    }


    ?>





  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->