<?php

  if(isset($_GET["idRq"]) )
  {
    if($_GET["idRq"] == null)
    {
      echo'<script> window.location="inicio";</script>';
    }
    else
    {

      if ($_SESSION["perfil"] != 3) 
      {
        $idmodulo = 3;
        $verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

        if ( !isset($verModulo["modulo"]) &&  $verModulo["modulo"] != $idmodulo) 
        {
          echo'<script> window.location="noAutorizado";</script>';
        }
      }// if ($_SESSION["perfil"] != 3) 

      $item = "id";
      $valor = $_GET["idRq"];
      $requisicion = ControladorRequisiciones::ctrMostrarRequisiciones($item, $valor, $_SESSION["anioActual"]);

      echo ( !isset($requisicion["id_persona"]) ) ? '<script> window.location="inicio";</script>' : '';

      echo ($_SESSION["id"] != $requisicion["id_persona"] && $_SESSION["perfil"] != 3 ) ? '<script> window.location="inicio";</script>' : '';

      $usrApr = ControladorUsuarios::ctrMostrarUsuarios($item, $requisicion["id_usr"]);
      $valor =  $requisicion["id_persona"];
      $persona = ControladorPersonas::ctrMostrarPersonas("id_usuario", $valor);
      $valor = $requisicion["id_area"];
      $area = ControladorAreas::ctrMostrarAreas($item, $valor);
      $listaInsumos = json_decode($requisicion["insumos"], true);
      $cantidadInsumos = 0;
      $boxStyleBorder = '';
      if ($requisicion["aprobado"] == 1) 
      {$boxStyleBorder = ' box-success';}
      else
      {$boxStyleBorder = ' box-danger';}

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

   echo'<script> window.location="inicio";</script>';

  }

?>

<div class="content-wrapper">

  <section class="content-header">

    <a href="javascript:history.back()">
      <button class="btn btn-success btn-md"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>
    <a href="index.php?ruta=requisicion&idRq=<?php echo $_GET['idRq'];?>">
      <button class="btn btn-info btn-md btnReplicarRq"><i class="fa fa-copy"></i> 
      Replicar
      </button>
    </a>

    <button class="btn btn-info btnPrint" onclick="window.print()" ><i class="fa fa-print"></i> Imprimir</button>
    
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

    <div class="box <?php echo $boxStyleBorder; ?> ">
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
              <span class="description-text">Fecha Solicitud</span>
              <h5 class="description-header"><?php echo ControladorParametros::ctrOrdenFecha($requisicion["fecha_sol"], 0);?></h5>
            </div>
          </div>

          <?php 

          if ($requisicion["aprobado"] == 1) 
          {
            echo '<div class="col-sm-2 col-xs-6">
              <div class="description-block border-right">
                <span class="description-text">Fecha de Aprobación</span>
                <h5 class="description-header">'.ControladorParametros::ctrOrdenFecha($requisicion["fecha"], 3).'</h5>
              </div>
            </div>';
          }
          else
          {
             echo '<div class="col-sm-2 col-xs-6">
              <div class="description-block border-right">
                <span class="description-text">Estado</span>
                <h5 class="description-header">';

                if ($requisicion["aprobado"] == 0 || $requisicion["aprobado"] == 3) 
                {
                  echo 'En Espera.';
                }
                else
                {
                   echo 'Anulado el '.ControladorParametros::ctrOrdenFecha($requisicion["fecha"], 0);
                }

                echo '</h5>
              </div>
            </div>';
          }


          ?>

           
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
    <div class="box <?php echo $boxStyleBorder; ?>">
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

        <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="box <?php echo $boxStyleBorder; ?>">
          <div class="box-header with-border">
            <h3 class="box-title">
              Tus Observaciones
            </h3>
          </div>
          <div class="box-body">
            <p>
              <?php echo ($_SESSION["perfil"] == 3) ? $requisicion["observacion"] : $requisicion["observacionE"] ;?>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="box <?php echo $boxStyleBorder; ?>">
          <div class="box-header with-border">
            <h3 class="box-title">
              Observaciones de<?php echo ($_SESSION["perfil"] != 3) ? ' Compras' : 'l Encargado' ;  ?>
            </h3>
          </div>
          <div class="box-body">
            <p>
              <?php echo ($_SESSION["perfil"] == 3) ? "</strong>: ".$requisicion["observacionE"] : $requisicion["observacion"] ;?>
            </p>
          </div>
        </div>
      </div>
      
    </div>

    <?php 


    if (!is_null($requisicion["registro"]) ) 
    {
      if (!empty($requisicion["registro"])) 
      {
        echo '    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Registros
            </h3>
          </div>
          <div class="box-body">
            <ul class="todo-list ui-sortable">
            '.$requisicion["registro"].'
            </ul>
          </div>
        </div>
      </div>
    </div>';
      }
    }

    ?>
   
  </section>

</div>
