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

    $porcentaje = [[]];
    $sumatoria = 0;
    $cuad1 = 0 ; // 1 resuelto, 6trasladado
    $cuad2 = 0 ; //4 extemporaneo
    $cuad3 = 0 ; //2 pendiente, 5 por asignar 
    $cuad4 = 0 ; //3 vencido

    $estados_pqr = ControladorParametros::ctrContarEstados($_SESSION["perfil"]);


    if (!is_null($estados_pqr)) 
    {

      for ($i=0; $i < count($estados_pqr) ; $i++) 
      { 
        $sumatoria+=$estados_pqr[$i]["COUNT(registropqr.id_estado)"];
      }

      for ($i=0; $i < count($estados_pqr); $i++) 
      {
        $porcentaje[ $estados_pqr[$i]["id"] ]["id"] = $estados_pqr[$i]["id"]; 
        $porcentaje[ $estados_pqr[$i]["id"] ]["nombre"] = $estados_pqr[$i]["nombre"];
        $porcentaje[ $estados_pqr[$i]["id"] ]["contar"] = $estados_pqr[$i]["COUNT(registropqr.id_estado)"];
        $porcentaje[ $estados_pqr[$i]["id"] ]["per"] = bcdiv( ($estados_pqr[$i]["COUNT(registropqr.id_estado)"]/$sumatoria) *100, '1', 2) ;
      }

    $percentCuad1 = 0;
    $percentCuad3 = 0;


    //cuadrante 1
    if (isset($porcentaje[1])) 
    {
      if (isset($porcentaje[6])) 
      {$cuad1 = $porcentaje[1]["contar"] + $porcentaje[6]["contar"];$percentCuad1+=$porcentaje[1]["per"]+$porcentaje[6]["per"];}
      else
      {$cuad1 = $porcentaje[1]["contar"];$percentCuad1+=$porcentaje[1]["per"];}
    }
    elseif (isset($porcentaje[6])) 
    {$cuad1 = $porcentaje[6]["contar"];$percentCuad1+=$porcentaje[6]["per"];}

    //cuadrante 2
    if (isset($porcentaje[4])) 
    {$cuad2 = $porcentaje[4]["contar"];}

    //cuadrante 3
    if (isset($porcentaje[2])) 
    {
      if (isset($porcentaje[5])) 
      {$cuad3 = $porcentaje[2]["contar"] + $porcentaje[5]["contar"];$percentCuad3+=$porcentaje[2]["per"]+$porcentaje[5]["per"];}
      else
      {$cuad3 = $porcentaje[2]["contar"];$percentCuad3+=$porcentaje[2]["per"];}
    }
    elseif (isset($porcentaje[5])) 
    {$cuad3 = $porcentaje[5]["contar"];$percentCuad3+=$porcentaje[5]["per"];}

    //cuadrante 4
    if (isset($porcentaje[3])) 
    {$cuad4 = $porcentaje[3]["contar"];}

    
    $contarCuadSu = $cuad3 + $cuad4;
    $contarCuadIn = $cuad1 + $cuad2;

    }//!is_null($estados_pqr)

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


       echo ' <button type="button" class="btn btn-info" id="btn-actualizarParamRegis">    
            <span>
              <i class="fa fa-exchange"></i> Actualizar Tabla (Ultima actualización: '.$fechaActu->format("h:m a d-m-Y").')
            </span>
        </button>';

        
    echo '<button type="button" class="btn btn-success pull-right" id="btn-RangoRegistroPQR">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
      </div><!--box-header with-border-->
    </div><!--box box-success-->';


    //Por Asignar
    if ( isset($porcentaje[5]) ) 
    {
      echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4 class="banner-asignar" style="cursor:pointer;" es="'.$porcentaje[5]["id"].'" per="'.$_SESSION["perfil"].'" idUser="'.$_SESSION["id"].'" anio="'.$_SESSION["anioActual"].'"><i class="icon fa fa-info"></i>Hay <strong>('.$porcentaje[5]["contar"].')</strong> Oficio(s) por validar a su encargado para su tramite. ver Listado.
             </h4>
            </div>';
    }//vencidas
    
    if (isset( $porcentaje[3] ) ) 
    {
      echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4 class="banner-vencidos" style="cursor:pointer;" es="'.$porcentaje[3]["id"].'" per="'.$_SESSION["perfil"].'" idUser="'.$_SESSION["id"].'" anio="'.$_SESSION["anioActual"].'"><i class="icon fa fa-danger"></i>Se encuentran Vencidos <strong>('.$porcentaje[3]["contar"].')</strong> Oficios. ver Listado. </h4>
            </div>';
    }

    ?>

   

    <?php echo '<input type="hidden" readonly es="5" per="'.$_SESSION["perfil"].'" idUser="'.$_SESSION["id"].'" anio="'.$_SESSION["anioActual"].'" id="inputVar">'?>
    <div class="row">
       
       <div class="col-lg-6">
           <div class="col-lg-6 box-semaforo" cuadrante="c3" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-warning" style="background-color:#F7F733;"><i class="glyphicon glyphicon-exclamation-sign"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">(3)Pendientes</span>
                <span class="info-box-number"><?php echo $cuad3 ;?></span>
                <span class="info-box-number"><small><?php  echo $percentCuad3."% ,"; echo (isset($porcentaje[5]["contar"])) ? " por asignar ".$porcentaje[5]["contar"] : ""; ?></small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-lg-6"-->

           <div class="col-lg-6 box-semaforo" cuadrante="c4" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-remove-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">(4)Vencidas</span>
                <span class="info-box-number"><?php echo (isset($porcentaje[3]["per"])) ? $porcentaje[3]["per"] : 0  ;?></span>
                <span class="info-box-number"><small><?php echo (isset($porcentaje[3]["contar"])) ? $porcentaje[3]["contar"] : 0 ; ?> %</small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-lg-6"-->

             <div class="col-lg-6 box-semaforo" cuadrante="c1" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-ok-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">(1)Resueltas</span>
                <span class="info-box-number"><?php echo $cuad1 ;?></span>
                <span class="info-box-number"><small><?php echo $percentCuad1  ; ?> %</small></span>
              </div><!--class="info-box-content"-->
            </div><!--class="info-box"-->
          </div><!--class="col-lg-6"-->

           <div class="col-lg-6 box-semaforo" cuadrante="c2" style="cursor:pointer;">
            <div class="info-box">
              <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-remove-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">(2)Extemporaneas</span>
                <span class="info-box-number"><?php echo $cuad2 ;?></span>
                <span class="info-box-number"><small><?php echo (isset($porcentaje[4])) ? $porcentaje[4]["count"] : 0 ; ?> %</small></span>
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

     <div class="box box-success">

      <?php 
/*
      $conteo = ControladorParametros::ctrContarDias("2023-01-27", "2023-02-10");

      var_dump($conteo);*/

     // $prueba = ControladorRadicados::ctractualizarRegistros($_SESSION["id"], $_SESSION["perfil"], $_SESSION["anioActual"]);

      ?>

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
           <th style="width: 100px">Acciones</th>
         </tr> 
        </thead>
        </table>

      </div>
    </div><!--box box-success-->

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

                        $accion_pqr = ControladorParametros::ctrmostrarRegistros("accion_pqr", null, null);
                        echo '<option value="">Seleccione una Acción</option>';
                        foreach ($accion_pqr as $key => $value) 
                        {
                          echo '<option value="'.$value["id"].'">0'.$value["id"].' - '.$value["nombre"].'</option>';
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
            <div class="row">
              <div class="col-md-6">
                  <p>Fecha</p>
                  <input type="date" class="form-control" name="fechaReg" id="fechaReg" value="" />
              </div>
               <div class="col-md-6">
                  <p>Hora</p>
                  <input type="time" id="horaReg" name="horaReg" class="form-control timepicker" value=""/>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <div class="panel">Detalles</div>
              </div>
            </div>
          </div>

            <div class="row">
               <div id="contenido-modal-accion" class="col-md-8"></div>
               <div id="contenido-modal-detalles" class="col-md-4"></div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <div class="panel">Constancia</div>
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
          $actualizarReg -> ctrActualizarRegistro();
        ?>

      </form>
    </div>
  </div>
</div>
