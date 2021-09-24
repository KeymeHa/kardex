<?php

  if(isset($_GET["idRq"]) )
  {
    if($_GET["idRq"] == null)
    {
      echo'<script> window.location="requisiciones";</script>';

    }
    else
    {
      $item = "id";
      $valor = $_GET["idRq"];
      $requisicion = ControladorRequisiciones::ctrMostrarRequisiciones($item, $valor);
      $valor =  $requisicion["id_persona"];
      $persona = ControladorPersonas::ctrMostrarPersonas($item, $valor);
      $valor = $requisicion["id_area"];
      $area = ControladorAreas::ctrMostrarAreas($item, $valor);
      $listaInsumos = json_decode($requisicion["insumos"], true);
      $cantidadInsumos = 0;

      if( !$listaInsumos == null )
      {
        foreach ($listaInsumos as $k => $v) 
        {
          $cantidadInsumos ++;
        }
      }

    }
  }
  else{

   echo'<script> window.location="requisiciones";</script>';

  }

?>

<div class="content-wrapper">

  <section class="content-header">

    <a href="requisiciones">
      <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>

    <br><br>

    <h1>
      
      Requisición: <b><?php echo $requisicion["codigoInt"];?></b>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="requisiciones"> Requisiciones</a></li>
      
      <li class="active"><?php echo $requisicion["codigoInt"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Información de la Requisición</h3> 
      </div>
    
      <div class="box-body">  
        <div class="row">
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Area Solicitante</span>
              <h5 class="description-header"><?php echo $area["nombre"];?></h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Solicitante</span>
              <h5 class="description-header"><?php echo $persona["nombre"];?></h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Fecha</span>
              <h5 class="description-header"><?php echo $requisicion["fecha"];?></h5>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block">
              <span class="description-text">Insumos con Nuevo Stock</span>
              <h5 class="description-header"><?php echo $cantidadInsumos;?></h5>
            </div>
            <!-- /.description-block -->
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
           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Categoría</th>
           <th title="Nueva Cantidad añadida al stock">Solicitada</th>
           <th title="Nueva Cantidad añadida al stock">Entregada</th>
         </tr> 
        </thead>
        <tbody>
          
          <?php

          if( !$listaInsumos == null )
          {
            foreach ($listaInsumos as $key => $value) 
            {

              $tabla = "insumos";
              $item = "id";
              $valor = $value["id"];

              $insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);
              $categoria = ControladorCategorias::ctrMostrarCategorias($item, $insumos["id_categoria"]);

               echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'; 

                      if($insumos["imagen"] != null)
                      {
                        echo'<img src="'.$insumos["imagen"].'" class="img-thumbnail" width="40px">';
                      }
                      else
                      {
                        echo'<img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px">';
                      }
                      echo'</td>
                      <td>'.$insumos["codigo"].'</td>
                      <td>'.$value["des"].'</td>
                      <td>'.$categoria["categoria"].'</td>
                      <td>'.$value["ped"].'</td>
                      <td>'.$value["ent"].'</td>
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
