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

?>


<div class="content-wrapper">

  <section class="content-header">
    <h1>    
      Módulo Registros<h3 id="titulo-registros"></h3>
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 
      <li class="active">Registros <?php if ( $_SESSION["perfil"] == 7 ) { echo ' de PQR'; }elseif( $_SESSION["perfil"] == 8 ){ echo ' de Remisiones';} ?></li>  
    </ol>
  </section>
  <section class="content">

    <?php
     $fechaInicial = null;
     $fechaFinal = null;

     if (isset($_GET["fechaInicial"])) 
      {
        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
      }

      $porcentaje = ControladorRadicados::ctrCuadrantesRegistros($_SESSION["id"], $_SESSION["perfil"], $_SESSION["anioActual"], $fechaInicial, $fechaFinal);
    /*
    echo ' 
        <?php 
           
        ?>
        &nbsp;
         <button style="color: white;" class="btn btn-success"><i class="fa fa-search"></i>  Busqueda Avanzada</button>
       

    */
    echo '<div class="box">
      <div class="box-header with-border">';
    ?>

    <?php

     include "anios.php";

     $fechaActu = new DateTime(ControladorParametros::ctrMostrarFechaRegis());
     date_default_timezone_set('America/Bogota');
     $hoymismo = date('Y-m-d');


       echo ' <button type="button" class="btn btn-primary" id="btn-actualizarParamRegis">    
            <span>
              <i class="fa fa-exchange"></i> Actualizar Tabla (Ultima actualización: '.$fechaActu->format("H:m a d-m-Y").')
            </span>
        </button>';

        
   echo '<button type="button" class="btn btn-success pull-right" id="btn-RangoRegistroPQR">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button></div><!--box-header with-border-->
    </div><!--box box-success-->';


    //Por Asignar
    if ( isset($porcentaje[5]) && $_SESSION["perfil"] == 7 || $_SESSION["perfil"] == 11 ) 
    {
      echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4 class="banner-asignar" style="cursor:pointer;" es="c6" per="'.$_SESSION["perfil"].'" idUser="'.$_SESSION["id"].'" anio="'.$_SESSION["anioActual"].'"><i class="icon fa fa-info"></i>Hay <strong>('.$porcentaje[5]["contar"].')</strong> Oficio(s) por validar a su encargado para su tramite. ver Listado.
             </h4>
            </div>';
    }//vencidas
    /*
    if (isset( $porcentaje[3] ) ) 
    {
      echo '<div class="alert alert-danger alert-dismissible box-semaforo" cuadrante="c4">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4 style="cursor:pointer;"  es="'.$porcentaje[3]["id"].'" per="'.$_SESSION["perfil"].'" idUser="'.$_SESSION["id"].'" anio="'.$_SESSION["anioActual"].'"><i class="icon fa fa-danger"></i>Oficios Vencidos : <strong>'.$porcentaje[3]["contar"].'</strong> ver Listado. </h4>
            </div>';
    }
*/
    ?>

    <div class="row">      
       <div class="col-lg-6">
           <div class="col-lg-6 box-semaforo" cuadrante="c3" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-warning" style="background-color:#F7F733;"><i class="glyphicon glyphicon-exclamation-sign"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pendientes</span>
                <span class="info-box-number"><?php echo $porcentaje["cuad3"][0] ;?></span>
                <span class="info-box-number"><small><?php echo ( isset($porcentaje["percentCuad3"][0]) )? $porcentaje["percentCuad3"][0]."%" : "0%" ;
                //echo (isset($porcentaje[5]["contar"])) ? " por asignar ".$porcentaje[5]["contar"] : ""; 
                 ?></small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-lg-6"-->

           <div class="col-lg-6 box-semaforo" cuadrante="c4" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-remove-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Vencidas</span>
                <span class="info-box-number"><?php echo (isset($porcentaje[3]["contar"])) ? $porcentaje[3]["contar"] : 0  ;?></span>
                <span class="info-box-number"><small><?php echo (isset($porcentaje[3]["per"])) ? $porcentaje[3]["per"] : 0 ; ?> %</small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-lg-6"-->

             <div class="col-lg-6 box-semaforo" cuadrante="c1" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-ok-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Resueltas</span>
                <span class="info-box-number"><?php echo $porcentaje["cuad1"][0] ;?></span>
                <span class="info-box-number"><small><?php echo ( isset($porcentaje["percentCuad1"][0]) ) ? $porcentaje["percentCuad1"][0] : 0 ; ?> %</small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-lg-6"-->

           <div class="col-lg-6 box-semaforo" cuadrante="c2" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-remove-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Extemporaneas</span>
                <span class="info-box-number"><?php echo $porcentaje["cuad2"][0] ;?></span>
                <span class="info-box-number"><small><?php echo (isset($porcentaje[4])) ? $porcentaje[4]["per"] : 0 ; ?> %</small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-md-2 col-sm-6 col-xs-12"-->

      </div>
      <div class="col-lg-6">
        <?php

          include "reportes/kpiGrafica.php";

        ?>
      </div><!--col-lg-6-->

    </div>



        
            <?php

            if ($_SESSION["perfil"] == 11 || $_SESSION["perfil"] == 7) 
            {

              $contarPorArea = ControladorRadicados::ctrContarAsignaciones($_SESSION["anioActual"], $fechaInicial, $fechaFinal); 
              $tcuadrante = [];
              $tt = 0;
              if (!is_null($contarPorArea) && is_countable($contarPorArea) && count($contarPorArea) > 0 ) 
              {
                
                for ($i=1; $i < 5 ; $i++) 
                { 

                  $tcuadrante[$i] = 0;

                  for ($k=0; $k < count($contarPorArea); $k++) 
                  { 
                    if (array_key_exists($i, $contarPorArea[$k])) 
                    {
                      $tcuadrante[$i] += $contarPorArea[$k][$i];
                    }
                  }//for k
                }// for i

                for ($i=1; $i < 5 ; $i++) 
                { 
                  $tt+= $tcuadrante[$i];
                }

                
           

              echo '
        <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Resumen Asignaciones por áreas</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          </div>
      </div>
      <div class="box-body">
        <table  class="table table-bordered table-striped dt-responsive tabla" width="100%" style="text-align: center" >
          <thead>
            <tr>
              <th rowspan="2"  style="text-align: center;">Área</th>
              <th class="bg-red"  style="text-align: center;" title="Vencidas"><i class="glyphicon glyphicon-ban-circle"></i></th>
              <th class="bg-yellow" style="text-align: center;" title="Pendientes"><i class="glyphicon glyphicon-exclamation-sign"></i></th>
              <th class="bg-red disabled" style="text-align: center;" title="Extemporaneas"><i class="glyphicon glyphicon-remove-circle"></i></th>
              <th class="bg-green" style="text-align: center;" title="Resueltas"><i class="glyphicon glyphicon-ok"></i></th>
              <th class="bg-gray" style="text-align: center;" title="Total">Total</th>
            </tr>
            <tr>
              <th id="th-r" style="text-align: center" title="Vencidas">'.$tcuadrante[3].'</th>
              <th id="th-y" style="text-align: center" title="Pendientes">'.$tcuadrante[2].'</th>
              <th id="th-rd" style="text-align: center" title="Extemporaneas">'.$tcuadrante[4].'</th>
              <th id="th-g" style="text-align: center" title="Resueltas">'.$tcuadrante[1].'</th>
              <th id="th-gr" style="text-align: center" title="Total">'.$tt.'</th>
            </tr>
          </thead>
          <tbody>';

  

             if (!is_null($contarPorArea)) 
             {
               foreach ($contarPorArea as $key => $value) 
               {

                if (array_key_exists("nombre", $value)) {

                  $total = $value["1"] + $value["2"]  + $value["3"] + $value["4"];

                 echo '<tr>
                    <td class="td_area" idA="'.$value["id"].'"><a href="#">'.$value["nombre"].'</a></td>
                    <td class="td_areaCua" idA="'.$value["id"].'" es="c4" title="'.$value["4"].' Vencidas en '.$value["nombre"].'"><a href="#">'.$value["4"].'</a></td>
                    <td class="td_areaCua" idA="'.$value["id"].'" es="c3" title="'.$value["3"].' Pendientes en '.$value["nombre"].'"><a href="#">'.$value["3"].'</a></td>
                    <td class="td_areaCua" idA="'.$value["id"].'" es="c2" title="'.$value["2"].'  Extemporaneas en '.$value["nombre"].'"><a href="#">'.$value["2"].'</a></td>
                    <td class="td_areaCua" idA="'.$value["id"].'" es="c1" title="'.$value["1"].'  Resueltas en '.$value["nombre"].'"><a href="#">'.$value["1"].'</a></td>
                    <td class="td_areaCuaTotal" idA="'.$value["id"].'" title="Total '.$total.' en '.$value["nombre"].'">'.$total.'</td>
                 </tr>';
                }

                
               }
             }

            echo '
          </tbody>
        </table>
      </div>
       
     </div>';

              }


            }

            ?>

           

     <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">
          Registros <?php if ( $_SESSION["perfil"] == 7 ) { echo ' de PQR'; }elseif( $_SESSION["perfil"] == 8 ){ echo ' de Remisiones';} ?>
        </h3>
      </div>
      <div class="box-body div-tablaRegistros">

        <table class="table table-bordered table-striped dt-responsive tablaRegistros" width="100%">
        <thead>
         <tr>
           <th>Fecha Radicado</th>
           <th># Radicado</th>
           <th>Estado</th>
           <th>Asunto</th>
           <th>Remitente</th>
           <th>Área</th>
           <th>Encargado</th>
           <th>Fecha Respuesta</th>
           <th>Fecha Vencimiento</th>
           <th>días</th> 
           <th style="width: 120px">Acciones</th>
         </tr> 
        </thead>
        </table>

      </div>
    </div><!--box box-success-->

    <?php

    if ($_SESSION["perfil"] == 7 || $_SESSION["perfil"] == 11) 
    {
     include("reportes/oficiosAreaspqr.php");
     include("reportes/oficiospqr.php");
    }


    ?>

  </section>
</div>


<div id="modalRegistroPQR" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="formularioModalRegistros">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Radicado: <b id="tituloRegistro"></b></h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <div class="row">
                 <div class="col-md-6">
                    <dl class="dl-horizontal" style="font-size: 18px;">
                    <dt>Fecha Radicado:</dt>
                      <dd id="mod-fecha-rad"></dd>
                    <dt>Remitente:</dt>
                      <dd id="mod-remitente"></dd>
                    <dt>Área Encargada:</dt>
                      <dd id="mod-area"></dd>
                    </dl>

                    <p>Seleccione una acción rapida para este oficio.</p>
                    <!-- ENTRADA PARA EL NOMBRE -->         
                    <div class="form-group">   
                      <input type="hidden" id="id_Registro_accion" name="idRegistro" value="">    
                      <select class="form-control" id="select_accion" required name="accionReg">
                        <?php

                        $accion_pqr = ControladorParametros::ctrMostrarAccionesPQR("accion_pqr", $_SESSION["perfil"]);

                        if (!is_countable($accion_pqr)) 
                        {
                          echo '<option value="">No hay Acciones Disponibles</option>';
                        }
                        else
                        {
                          echo '<option value="">Seleccione una Acción</option>';
                          foreach ($accion_pqr as $key => $value) 
                          {
                            echo '<option value="'.$value["id"].'">'.($key+1).'-'.$value["nombre"].'</option>';
                          }
                        }

                        

                        ?>
                      </select>
                    </div>  

                  </div>

                 <div class="col-md-6" >
                    <dl class="dl-horizontal" style="font-size: 18px;">
                    <dt>Fecha Vencimiento:</dt>
                      <dd id="mod-fecha-venc"></dd>
                    <dt>Estado Actual:</dt>
                      <dd id="mod-estado"></dd>
                      <dt>Responsable:</dt>
                      <dd id="mod-responsable"></dd>
                    </dl>
                    <div class="row div-progress-bar"></div>
                  </div>
            </div><!--row-->

            <?php if($_SESSION["perfil"] == 7)
            {
              echo ' <div class="row">
              <div class="col-md-6">
                  <p>Fecha</p>
                  <input type="date" class="form-control" name="fechaReg" id="fechaReg" value="" />
              </div>
               <div class="col-md-6">
                  <p>Hora</p>
                  <input type="time" id="horaReg" name="horaReg" class="form-control timepicker" value=""/>
              </div>
            </div><div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <div class="panel">Detalles</div>
              </div>
            </div>
          </div>';
            }

            ?>
            

            <div class="row">
               <div id="contenido-modal-accion" class="col-md-8"></div>
               <div id="contenido-modal-detalles" class="col-md-4"></div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <div class="panel">Soporte o documento para adjuntar al avance del tramite.</div>
                  <input type="file" name="editarArchivo">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" rows="10" placeholder="Observaciones" name="observacionesReg" style="resize: none;"></textarea>
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success btn-GuardarRegistro">Grabar</button>
        </div>

        <?php
          $actualizarReg = new ControladorRadicados();
          $actualizarReg -> ctrActualizarRegistro($_SESSION["id"]);
        ?>

      </form>
    </div>
  </div>
</div>
