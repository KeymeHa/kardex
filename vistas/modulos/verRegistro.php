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
      $radicado = ControladorRadicados::ctrAccesoRapidoRegistros($valor, 1);
      $area_responsable = ControladorParametros::ctrmostrarRegistroEspecifico('areas', "id", $registro["id_area"], "nombre");
      $responsable = ControladorParametros::ctrmostrarRegistroEspecifico('usuarios', "id", $registro["id_usuario"], "nombre");
      $estado = ControladorParametros::ctrmostrarRegistros('estado_pqr', "id", $registro["id_estado"]);
      $anio = new DateTime($radicado["fecha"]);
      $fechaRad = ControladorParametros::ctrOrdenFecha($registro["fecha"], 0);
      $fecha_vencimiento = ControladorParametros::ctrOrdenFecha($registro["fecha_vencimiento"], 0);

      $corte = ( $radicado["id_corte"] != 0 ) ? ControladorRadicados::ctrMostrarCortes("id", $radicado["id_corte"]) : "Sin Número de Corte" ;

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
      Radicado: <?php echo $radicado["radicado"]." - ".$estado["nombre"]; ?><b></b>  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="registros"> Registros PQR</a></li>    
      <li class="active">Radicado: <?php echo $radicado["radicado"]; ?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="box box-<?php echo $estado['html'];?>">
      <div class="box-header with-border">
        <h3 class="box-title">Información Registro</h3> 
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          </div>
      </div>    
      <div class="box-body" style="font-size: 18px;">  

        <div class="row">
          <div class="col-lg-6">

            <dl class="dl-horizontal">
              <dt>Fecha Radicado:</dt>
              <dd><?php echo $fechaRad; ?></dd>
              <dt>Fecha Vencimiento:</dt>
              <dd><?php echo $fecha_vencimiento; ?></dd>
              <dt>Tipo de Oficio (PQR)</dt>
              <dd><?php $tipoPQR = ControladorParametros::ctrmostrarRegistros("pqr", "id", $registro["id_pqr"]); echo $tipoPQR["nombre"]; ?></dd>
              <dt>Días de Retención:</dt>
              <dd><?php echo $registro["dias_contados"]." / ".$registro["dias_habiles"]." días habiles"; ?></dd>
              <dt>Estado:</dt>
              <dd><button type="button" class="btn btn-<?php echo $estado['html'];?>" ><?php echo $estado["nombre"]; ?></button></dd>
              <?php

              if (!is_null($registro["fecha_respuesta"])) 
              {
                $fecha_respuesta = new DateTime($registro["fecha_respuesta"]);

                echo '<dt>Fecha de Respuesta:</dt>
                <dd>'.$fecha_respuesta->format('d-m-Y h:i a').'</dd>';
              }

              ?>
            </dl>


          </div>

          <div class="col-lg-6">

            <dl class="dl-horizontal">
              <dt>Asunto:</dt>
              <dd><?php echo $radicado["asunto"]; ?></dd>
              <dt>Remitente:</dt>
              <dd><?php echo $radicado["id_remitente"]; ?></dd>
              <dt>Área Encargada:</dt>
              <dd><?php echo $area_responsable; ?></dd>
               <dt>Encargado(a):</dt>
              <dd><?php echo $responsable; ?></dd>
               <dt>Recibido por:</dt>
              <dd><?php echo $radicado["recibido"]; ?></dd>
              <dt>Número de Corte:</dt>
              
                <?php
                echo '<dd ';
                if ($radicado["id_corte"] == 0) 
                {
                  echo '>'.$corte;
                }
                else
                {
                  echo ' class="btnImpCorte" idCorte="'.$corte["id"].'" corte="'.$corte["corte"].'" title="Ver Corte '.$corte["corte"].'"><a href="#">'.$corte["corte"].'</a>';
                }
                 echo '</dd>';

              if (!is_null($radicado["observaciones"]) && $radicado["observaciones"] != "" ) {
                echo ' <dt>Observaciones (Gral):</dt>
              <dd>'.$radicado["observaciones"].'</dd>';
              }

              if (!is_null($radicado["direccion"]) && $radicado["direccion"] != "") {
                echo ' <dt>Dirección:</dt>
              <dd>'.$radicado["direccion"].'</dd>';
              }

               if (!is_null($radicado["correo"]) && $radicado["correo"] != "") {
                echo ' <dt>Correo Electrónico:</dt>
              <dd>'.$radicado["correo"].'</dd>';
              }

              ?>
            </dl>


          </div>
        </div><!--class row-->
        <div class="row">
          <div class="col-md-12">

          <?php 

            if ($radicado["contador"] < 33) 
            {
              $tipoProgress = "success";
            }
            else if($radicado["contador"] >= 34 && $radicado["contador"] <= 66)
            {
              $tipoProgress = "warning";
            }
            else
            {
              $tipoProgress = "danger";
            }

            echo '<div class="col-lg-12"><div class="row"><div class="pull-left">'.$fechaRad.'</div><div class="pull-right">'.$fecha_vencimiento.'</div></div></div><p>'.$radicado["contador"].'%</p><div class="progress progress-sm active">
                  <div class="progress-bar progress-bar-'.$tipoProgress.' progress-bar-striped" role="progressbar" style="width: '.$radicado["contador"].'%" title="">
                  <span class="sr-only">20% Complete</span>
                  </div>
                  </div>';?>



          </div>
        </div>

      </div><!--BOX BODY-->
      
        
     
    </div><!--BOX-->

    <?php

         echo ( $radicado["soporte"] != "" && file_exists($radicado["soporte"]) ) ? '<div class="box box-'.$estado["html"].'"><div class="box-header">
       <h3 class="box-title">Soporte</h3>
       <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div><div class="box-body"><div class="col-lg-12">
                  <embed src="'.$radicado["soporte"].'" width="100%" height="700px"  type="application/pdf"> 
                  </div></div></div>' : '<div class="box box-'.$estado["html"].'"><div class="box-header">
       <h3 class="box-title">Soporte</h3>
       <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div><div class="box-body"><div class="col-lg-12">
        <i class="fa fa-file-o"></i> <cite title="Source Title">Sin Soportes Adjuntos.</cite>           
                  </div></div></div>';


    if($registro["id_estado"] != 1 && $registro["id_estado"] != 4 && $registro["id_estado"] != 6)
    {
      echo '<div class="box box-'.$estado['html'].'">

      <div class="box-header">
       <h3 class="box-title">Acciones</h3>
       <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

       <form role="form" method="post" enctype="multipart/form-data" class="formularioModalRegistros">

          <div class="box-body">';

            if ($_SESSION["perfil"] == 7) 
            {
              echo '<div class="row">
              <div class="col-md-6"><p>Fecha</p><input type="date" class="form-control" name="fechaReg" id="fechaReg" value="" /></div>
              <div class="col-md-6"><p>Hora</p><input type="time" id="horaReg" name="horaReg" class="form-control timepicker" value=""/></div>
            </div><div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                   <div class="panel">Detalles</div>
                  </div>
                </div>
              </div>';
            }
       
            
          echo '
           <div class="row">
              <br>
              <div class="col-md-6">
                <p>Seleccione una acción rapida para este oficio.</p>
                        <!-- ENTRADA PARA EL NOMBRE -->         
                  <div class="form-group">   
                    <input type="hidden" id="id_Registro_accion" name="idRegistro" value="'.$_GET['idRegistro'].'"> <select class="form-control" id="select_accion" required name="accionReg"></select>
                  </div>
              </div>
            </div>

             

             <div class="row">
                 <div id="contenido-modal-accion" class="col-md-8"></div>
                 <div id="contenido-modal-detalles" class="col-md-4"></div>
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
              </div>';

               $actualizarReg = new ControladorRadicados();
              $actualizarReg -> ctrActualizarRegistro($_SESSION["id"]);

      echo ' </div><!--box-body-->

          <div class="box-footer">
            <button type="submit" class="btn btn-success btn-GuardarRegistro pull-right">Grabar</button>
          </div>
       </form>
    </div><!--box-->';
    }

    ?>

  <div class="row">
  <div class="col-md-12">
    <ul class="timeline">

      <li class="time-label">
        <span class="bg-green">
        <?php echo $fechaRad;?>
        </span>
      </li>


      <li>
        <i class="fa fa-envelope bg-blue"></i>
        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> <?php echo $registro["hora"];?></span>
            <h3 class="timeline-header">Radicación del documento.</h3>
            <?php  if (!is_null($radicado["observaciones"]) && $radicado["observaciones"] != "" ) {
                echo '<div class="timeline-body">Observaciones: '.$radicado["observaciones"].'</div>';
              } ?>
            
        </div>
      </li>

      <?php

       $grupoFechas = [];

      if ($registro["acciones"] != null) 
      {

          $accionesPQR = json_decode($registro["acciones"], true);

             foreach ($accionesPQR as $key => $value) 
             {
        
                if (!in_array($value["fe"], $grupoFechas)) 
                {
                  $grupoFechas[] = $value["fe"];
                }

             }// foreach ($accionesPQR as $key => $value) 

             //si marca 1 las asiones no serian asignado sino reasignado
             $swAsignado = 0;

             for ($y=0; $y < count($grupoFechas) ; $y++) 
             { 

              $fechaTemp = ControladorParametros::ctrOrdenFecha($grupoFechas[$y], 0);

                echo '<li class="time-label">
                        <span class="bg-green">
                   '.$fechaTemp.'
                    </span>
                  </li>';

               for ($x=0; $x < count($accionesPQR); $x++) 
               { 

                  if ($grupoFechas[$y] == $accionesPQR[$x]["fe"]) 
                  {

                     $horaTemp = new DateTime($accionesPQR[$x]["hr"]);
                     $horaR = $horaTemp->format('h:i a');

                     $nombreObs = ControladorParametros::ctrmostrarRegistroEspecifico('usuarios', "id", $accionesPQR[$x]["idS"], "nombre");

                    switch ($accionesPQR[$x]["acc"]) 
                    {
                      case 1:

                        $areaR = ControladorParametros::ctrmostrarRegistroEspecifico('areas', "id", $accionesPQR[$x]["da"]["idA"], "nombre");

                        echo '<li>
                          <i class="fa fa-share bg-yellow"></i>
                          <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                          <h3 class="timeline-header">';

                          if($swAsignado == 0)
                          {
                            echo 'A';
                          }
                          else{
                            echo 'Rea';
                          }

                        echo 'signado a <strong>'.$accionesPQR[$x]["da"]["nom"].'</strong>, perteneciente a <strong>'.$areaR.'</strong>.</h3>';

                          if (isset($accionesPQR[$x]["obs"]) && !empty($accionesPQR[$x]["obs"]) ) 
                          {
                             echo '<div class="timeline-body"><strong>'.$nombreObs.': </strong>'.$accionesPQR[$x]["obs"].'</div>';
                          }

                          if (isset($accionesPQR[$x]["sop"]) && !empty($accionesPQR[$x]["sop"]) ) 
                          {
                             echo '<div class="timeline-footer">
                              <a href="vistas/radicados/'.strval($anio->format("Y")).'/'.$radicado["radicado"].'/'.$accionesPQR[$x]["sop"].'.pdf" class="btn btn-primary btn-xs"><i class="fa fa-paperclip"></i> Anexo</a>
                              </div>';
                          }

                          echo '
                          </div>
                          </li>';

                          if($swAsignado == 0)
                          {
                            $swAsignado = 1;
                          }

                        break;
                      case 2:
                        
                        $remitentes = "";

                        for ($i=0; $i < count($accionesPQR[$x]["da"]); $i++) 
                        { 
                          $remitentes .= " ".$accionesPQR[$x]["da"][$i]["rem"].",";
                        }

                        $remitentes = substr($remitentes, 0 ,-1);

                        echo '<li>
                          <i class="fa fa-envelope bg-green"></i>
                          <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                          <h3 class="timeline-header">Traslado por Compentencia a <strong>'.$remitentes.'</strong>.</h3>';

                          if (isset($accionesPQR[$x]["obs"]) && !empty($accionesPQR[$x]["obs"]) ) 
                          {
                             echo '<div class="timeline-body"><strong>'.$nombreObs.': </strong>'.$accionesPQR[$x]["obs"].'</div>';
                          }

                          if (isset($accionesPQR[$x]["sop"]) && !empty($accionesPQR[$x]["sop"]) ) 
                          {
                             echo '<div class="timeline-footer">
                              <a href="vistas/radicados/'.strval($anio->format("Y")).'/'.$radicado["radicado"].'/'.$accionesPQR[$x]["sop"].'.pdf" class="btn btn-primary btn-xs"><i class="fa fa-paperclip"></i> Anexo</a>
                              </div>';
                          }

                          echo '
                          </div>
                          </li>';


                        break;
                      case 3:
                        $areaR = ControladorParametros::ctrmostrarRegistroEspecifico('areas', "id", $accionesPQR[$x]["da"]["idA"], "nombre");
                        $areaRD = ControladorParametros::ctrmostrarRegistroEspecifico('areas', "id", $accionesPQR[$x]["da"]["idAD"], "nombre");

                        echo '<li>
                          <i class="fa fa-reply bg-blue"></i>
                          <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                          <h3 class="timeline-header">';

                          

                        echo '<strong>'.$accionesPQR[$x]["da"]["nom"].'</strong>, perteneciente a <strong>'.$areaR.'</strong>,<strong> devolvió</strong> el oficio a <strong>'.$accionesPQR[$x]["da"]["nomD"].'</strong> del área <strong>'.$areaRD.'</strong> para su reasignación.</h3>';

                          if (isset($accionesPQR[$x]["obs"]) && !empty($accionesPQR[$x]["obs"]) ) 
                          {
                             echo '<div class="timeline-body"><strong>'.$nombreObs.'</strong>: '.$accionesPQR[$x]["obs"].'</div>';
                          }

                          if (isset($accionesPQR[$x]["sop"]) && !empty($accionesPQR[$x]["sop"]) ) 
                          {
                             echo '<div class="timeline-footer">
                              <a href="vistas/radicados/'.strval($anio->format("Y")).'/'.$radicado["radicado"].'/'.$accionesPQR[$x]["sop"].'.pdf" class="btn btn-primary btn-xs"><i class="fa fa-paperclip"></i> Anexo</a>
                              </div>';
                          }

                          echo '
                          </div>
                          </li>';
                        break;
                      case 4:
                        # code...
                        break;
                      case 5:
                        # code...
                        break;
                      case 6:
                        # code...
                        break;
                      case 7:

                        $fechaVPQR = new DateTime($accionesPQR[$x]["da"]["fechav"]);
                        $fechaVAPQR = new DateTime($accionesPQR[$x]["da"]["fechaVa"]);
                         echo '<li>
                          <i class="fa fa-share bg-yellow"></i>
                          <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                          <h3 class="timeline-header">Se Modifico el Tipo de Oficio</h3><div class="timeline-body">Paso de ser <strong>'.$accionesPQR[$x]["da"]["pqra"].'</strong> con <strong>'.$accionesPQR[$x]["da"]["tera"].'</strong> días habiles, fecha de vencimiento <strong>'.$fechaVAPQR->format('d-m-Y').'</strong> y se actualizo a <strong>'.$accionesPQR[$x]["da"]["pqr"].'</strong> con <strong>'.$accionesPQR[$x]["da"]["ter"].'</strong> días habiles y nueva fecha de vencimiento <strong>'.$fechaVPQR->format('d-m-Y').'</strong>. <br>';


                          if (isset($accionesPQR[$x]["obs"]) && !empty($accionesPQR[$x]["obs"]) ) 
                          {
                             echo $accionesPQR[$x]["obs"];
                          }


                          echo '

                          </div>
                          </div>
                          </li>';
                        break;
                      case 8:

                        echo '<li>
                          <i class="fa fa-share bg-yellow"></i>
                          <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                          <h3 class="timeline-header">Marcado como <strong>Resuelto</strong></h3>';

                          if (isset($accionesPQR[$x]["obs"]) && !empty($accionesPQR[$x]["obs"]) ) 
                          {
                             echo '<div class="timeline-body">'.$accionesPQR[$x]["obs"].'</div>';
                          }

                          if (isset($accionesPQR[$x]["sop"]) && !empty($accionesPQR[$x]["sop"]) ) 
                          {

                            $direccion = 'vistas/radicados/'.strval($anio->format("Y")).'/'.$radicado["radicado"].'/'.$accionesPQR[$x]["sop"].'.pdf';

                            if (file_exists($direccion)) 
                            {
                              echo '<div class="timeline-footer">
                              <a href="'.$direccion.'" class="btn btn-primary btn-xs"><i class="fa fa-paperclip"></i> Anexo</a>
                              </div>';
                            }
                          }

                          echo '
                          </div>
                          </li>';

                        break;
                      
                      default:
                        # code...
                        break;
                    }//switch ($accionesPQR[$x]["acc"])


                  }//if ($grupoFechas[$y] == $accionesPQR[$x]["fe"]) 
               }//for
              }//for             

      }//if ($registro["acciones"] != null) 

      

      ?>

    <li>
      <i class="fa fa-clock-o bg-gray"></i>
    </li>

  </ul><!--class="timeline"-->

</div>

</div>


  </section>
</div>
