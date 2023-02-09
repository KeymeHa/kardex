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

      $fechaRad = ControladorParametros::ctrOrdenFecha($registro["fecha"], 0);
      $fecha_vencimiento = ControladorParametros::ctrOrdenFecha($registro["fecha_vencimiento"], 0);

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
              <dt>Días de Retención:</dt>
              <dd><?php echo $registro["dias_contados"]." / ".$registro["dias_habiles"]." días habiles"; ?></dd>
              <dt>Estado:</dt>
              <dd><button type="button" class="btn btn-<?php echo $estado['html'];?>" ><?php echo $estado["nombre"]; ?></button></dd>
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
              <?php

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

            echo '<div class="col-lg-12"><div class="row"><div class="pull-left">'.$radicado["fecha"].'</div><div class="pull-right">'.$radicado["fecha_vencimiento"].'</div></div></div><p>'.$radicado["contador"].'%</p><div class="progress progress-sm active">
                  <div class="progress-bar progress-bar-'.$tipoProgress.' progress-bar-striped" role="progressbar" style="width: '.$radicado["contador"].'%" title="">
                  <span class="sr-only">20% Complete</span>
                  </div>
                  </div>';?>



          </div>
        </div>

      </div><!--BOX BODY-->
      
        <?php

         echo ( $radicado["soporte"] != "" && file_exists($radicado["soporte"]) ) ? '<div class="box-footer">
                  <div class="col-md-1">
                  <a href="'.$radicado["soporte"].'"; target="_blank">
                      <button type="button" class="btn btn-block btn-primary"><i class="fa fa-external-link-square"></i> Soporte</button>
                    </a>
                  </div></div>' : '';

        ?>
     
    </div><!--BOX-->

    <?php

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

          <div class="box-body">
       
            <div class="row">
              <div class="col-md-6"><p>Fecha</p><input type="date" class="form-control" name="fechaReg" id="fechaReg" value="" /></div>
              <div class="col-md-6"><p>Hora</p><input type="time" id="horaReg" name="horaReg" class="form-control timepicker" value=""/></div>
            </div>

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
              </div>';

               $actualizarReg = new ControladorRadicados();
              $actualizarReg -> ctrActualizarRegistro();

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

             }


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

                     if ( isset($accionesPQR[$x]["da"]["nom"]) ) 
                     {
                        $areaR = ControladorParametros::ctrmostrarRegistroEspecifico('areas', "id", $accionesPQR[$x]["da"]["idA"], "nombre");

                        echo '<li>
                        <i class="fa fa-share bg-yellow"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                            <h3 class="timeline-header">Asignado a '.$accionesPQR[$x]["da"]["nom"].' del área '.$areaR.'.</h3>
                        </div>
                      </li>';
                     }elseif ($accionesPQR[$x]["acc"] == 2) 
                     {
                        $remitentes = "";

                        for ($i=0; $i < count($accionesPQR[$x]["da"]); $i++) 
                        { 
                          $remitentes .= "(".$accionesPQR[$x]["da"][$i]["rem"].")";
                        }

                       echo '<li>
                        <i class="fa fa-envelope bg-green"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> '.$horaR.'</span>
                            <h3 class="timeline-header">Traslado por Compentencia a '.$remitentes.'.</h3>
                        </div>
                       </li>';
                     }

                  }
               }
             }

      }

      

      ?>

    <!--
  
    <li>
      <i class="fa fa-envelope bg-blue"></i>
      <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>hora</span>
          <h3 class="timeline-header">Fue Radicado el Documento</h3>
          <div class="timeline-body">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
          weebly ning heekya handango imeem plugg dopplr jibjab, movity
          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
          quora plaxo ideeli hulu weebly balihoo...
          </div>
        <div class="timeline-footer">
          <a class="btn btn-primary btn-xs">Read more</a>
          <a class="btn btn-danger btn-xs">Delete</a>
        </div>
      </div>
    </li>

    -->

    <li>
      <i class="fa fa-clock-o bg-gray"></i>
    </li>

  </ul><!--class="timeline"-->

</div>

</div>


  </section>
</div>
