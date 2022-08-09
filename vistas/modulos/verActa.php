<?php

  if(isset($_GET["idActa"]) )
  {
    if($_GET["idActa"] == null)
    {
      echo'<script> window.location="actas";</script>';

    }
    else
    {
      $item = "id";
      $valor = $_GET["idActa"];
      $acta = ControladorActas::ctrMostrarActas($item, $valor, $_SESSION["anioActual"]);
      $listaInsumos = json_decode($acta["listainsumos"], true);
      $cantidadInsumos = 0;

      if( !$listaInsumos == null )
      {
        foreach ($listaInsumos as $k => $v) 
        {
          $cantidadInsumos ++;
        }
      }

      $motivo = ControladorActas::ctrVerMotivo($acta["motivo"]);

    }
  }
  else{

   echo'<script> window.location="actas";</script>';

  }

?>

<div class="content-wrapper">

  <section class="content-header">

    <a href="actas">
      <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>

    <br><br>

    <h1>
      
      Acta de<?php if( $acta["tipo"] == 1){ echo ' Salida ';}elseif( $acta["tipo"] == 2){ echo ' Ingreso ';}else{echo ' Asignación ';}?>: <b><?php echo $acta["codigoInt"];?></b>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="actas"> Actas</a></li>
      
      <li class="active"><?php echo $acta["codigoInt"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Información de la Acta</h3> 
      </div>
    
      <div class="box-body">  
        <div class="row">
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Autorizado Por:</span>
              <h5 class="description-header"><?php echo $acta["autorizado"];?></h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Dependencia: </span>
              <h5 class="description-header"><?php echo $acta["dependencia"];?></h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Responsable</span>
              <h5 class="description-header"><?php echo $acta["responsable"];?></h5>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block">
              <span class="description-text">Insumos y/o Equipos</span>
              <h5 class="description-header"><?php echo $cantidadInsumos;?></h5>
            </div>
          </div>

          <?php 

            if( $acta["tipo"] != 3)
            {
              echo '<div class="col-sm-2 col-xs-6">
            <div class="description-block">
              <span class="description-text">Fecha Salida</span>
              <h5 class="description-header">'.ControladorParametros::ctrOrdenFecha($acta["fechaSal"], 0).'</h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block">
              <span class="description-text">Fecha Ingreso</span>
              <h5 class="description-header">'.ControladorParametros::ctrOrdenFecha($acta["fechaEnt"], 0).'</h5>
            </div>
          </div>';
            }
            else
            {
               echo '<div class="col-sm-2 col-xs-6">
                <div class="description-block">
                  <span class="description-text">Fecha Asignación</span>
                  <h5 class="description-header">'.ControladorParametros::ctrOrdenFecha($acta["fechaEnt"], 0).'</h5>
                </div>
              </div>';
            }

          ?>

          
        </div><!--row-->
        <br>
        <div class="row">
          <div class="col-sm-2 col-xs-6">
            <div class="description-block">
              <span class="description-text">Motivo:</span>
              <h5 class="description-header"><?php echo $motivo;?></h5>
            </div>
          </div>
          <div class="col-sm-6 col-xs-6">
            <div class="description-block">
              <?php if( $acta["observacion"] != null || $acta["observacion"] != ""){echo '<span class="description-text">Observaciones</span>
              <h5 class="description-header">'.$acta["observacion"].'</h5>
            </div>';}?>
          </div>
        </div><!--row-->
      </div><!--BOX BODY-->
    </div><!--BOX-->
    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">       
        <thead>      
         <tr>           
          <th style="width:10px">#</th>
           <th>Serial</th>
           <th>Marca</th>
           <th>Descripción</th>
           <th>Cantidad</th>
           <th>Observación</th>
         </tr> 
        </thead>
        <tbody>
          
          <?php

          if( !$listaInsumos == null )
          {
            foreach ($listaInsumos as $key => $value) 
            {


               echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["sn"].'</td>
                      <td>'.$value["mc"].'</td>
                      <td>'.$value["des"].'</td>
                      <td>'.$value["can"].'</td>
                      <td>'.$value["obs"].'</td>
                    </tr>';
            }
          }
          ?>

        </tbody>

       </table>
      </div>
    </div>

    
  </section>

</div>
