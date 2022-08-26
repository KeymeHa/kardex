<?php
  if(isset($_GET["idOC"]) )
  {
    if($_GET["idOC"] == null)
    {
      echo'<script> window.location="ordendecompras";</script>';
    }
    else
    {
      $item = "id";
      $valor = $_GET["idOC"];
      $Orden =  ControladorOrdenCompra::ctrMostrarOrdenesdeCompras($item, $valor, $_SESSION["anioActual"]);
      $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $Orden["id_proveedor"]); 
      $fecha = substr($Orden["fecha"],8,10);
      $fecha .= "-".substr($Orden["fecha"],5,-3);
      $fecha .= "-".substr($Orden["fecha"],0,-6);
      $listaInsumos = json_decode($Orden["insumos"], true);
      $cantidadInsumos = 0;
      if( !$listaInsumos == null )
      {
        $cantidadStock = 0;
        foreach ($listaInsumos as $k => $v) 
        {
          $cantidadInsumos ++;
          $cantidadStock+= $v["can"] ;
        }
      }
    }
  }
  else
  {
   echo'<script> window.location="ordendecompras";</script>';
  }
?>
<div class="content-wrapper">
  <section class="content-header">
    
      <?php

        if ( isset($_GET["sw"]) ) 
        {
          echo '<a href="index.php?ruta=verFactura&idFactura='.$_GET["sw"].'">
                  <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
                    Regresar
                  </button>
                </a>';
        }
        else
        {
          echo '<a href="ordendecompras">
                  <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
                    Regresar
                  </button>
                </a>';
        }
      ?> 
    <h1>    
      Orden de Compra N°<b><?php echo $Orden["codigoInt"]." - ".$proveedores["razonSocial"];?></b>  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="Orden"> Orden</a></li>    
      <li class="active">OC-<?php echo $Orden["codigoInt"];?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Información de la Orden de Compra</h3> 
      </div>    
      <div class="box-body">  
        <div class="row">
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Proveedor</span>
              <h5 class="description-header"><?php echo $proveedores["razonSocial"];?></h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Fecha</span>
              <h5 class="description-header"><?php echo $fecha;?></h5>
            </div>
          </div>
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Sub Total</span>
              <h5 class="description-header cantidadEfectivo"><?php echo $Orden["inversion"];?></h5>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">IVA Generado</span>
              <h5 class="description-header cantidadEfectivo"><?php echo $Orden["iva"];?></h5>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Total</span>
              <h5 class="description-header cantidadEfectivo"><?php echo $Orden["inversion"]+$Orden["iva"];?></h5>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block">
              <span class="description-text">Insumos para adquirir</span>
              <h5 class="description-header"><?php echo $cantidadInsumos;?></h5>
            </div>
            <!-- /.description-block -->
          </div>
        </div><!--row-->
        <div class="row">
          <br>
          <div class="col-xs-2">
              <?php 
              echo '<br><a class="btn btn-block btn-social btn-google btnOrdenPDF" id="generarPdfOC" idOC="'.$Orden["id"].'">
                        <i class="fa fa-file-pdf-o"></i> Generar PDF
                    </a>';
              ?>     
          </div>
          <div class="col-xs-10">
          </div>
        </div>
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
           <th title="Nueva Cantidad añadida al stock">Cantidad</th>
           <th>Precion U/N</th>
           <th>SubTotal</th>
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

              if ($insumos["imagen"] == "") 
              {
                $imagen = "vistas/img/productos/default/anonymous.png";
              }else
              {
                $imagen = $insumos["imagen"];
              }

               echo '<tr>
                      <td>'.($key+1).'</td>
                      <td><img src="'.$imagen.'" class="img-thumbnail" width="40px"></td>
                      <td>'.$insumos["codigo"].'</td>
                      <td>'.$value["des"].'</td>
                      <td>'.$categoria["categoria"].'</td>
                      <td>'.$value["can"].'</td>
                      <td>$<span class="cantidadEfectivo">'.$value["pre"].'</span></td>
                      <td>$<span class="cantidadEfectivo">'.$value["sub"].'</span></td>
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
