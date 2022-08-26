<?php
  if(isset($_GET["idFactura"]) )
  {
    if($_GET["idFactura"] == null)
    {
      echo'<script> window.location="facturas";</script>';
    }
    else
    {
      $item = "id";
      $valor = $_GET["idFactura"];
      $facturas = ControladorFacturas::ctrMostrarFacturas($item, $valor, $_SESSION["anioActual"]); 
      $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $facturas["id_proveedor"]); 
      $fecha = ControladorParametros::ctrOrdenFecha($facturas["fecha"], 0);
      $listaInsumos = json_decode($facturas["insumos"], true);
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
  else
  {
   echo'<script> window.location="facturas";</script>';
  }
?>
<div class="content-wrapper">
  <section class="content-header">
    <a href="facturas">
      <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>
    <br><br>
    <h1>    
      Factura: <b><?php echo $facturas["codigoInt"];?></b>  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="facturas"> facturas</a></li>    
      <li class="active"><?php echo $facturas["codigoInt"];?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Información de la Factura</h3> 
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
              <h5 class="description-header cantidadEfectivo"><?php echo $facturas["inversion"];?></h5>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">IVA Generado</span>
              <h5 class="description-header cantidadEfectivo"><?php echo $facturas["iva"];?></h5>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Total</span>
              <h5 class="description-header cantidadEfectivo"><?php echo $facturas["inversion"]+$facturas["iva"];?></h5>
            </div>
            <!-- /.description-block -->
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
        <div class="row">
          <br>
          <div class="col-xs-2">
              <?php 
              echo '<br><a class="btn btn-block btn-social btn-google" id="generarPdfFAc" codigoInt="'.$facturas["codigoInt"].'">
                        <i class="fa fa-file-pdf-o"></i> Generar PDF
                    </a>';
              if( !$facturas['soporte'] == null)
              {
                echo '<a class="btn btn-block btn-social btn-google" href="'.$facturas['soporte'].'">
                  <i class="fa fa-file-pdf-o"></i> Ver Soporte Factura
                </a>';
              }
             ?>     
          </div>
          <div class="col-xs-10">
            <?php
            $item = "fac_asociada";
            $valor = $facturas['id'];
            $ordenes = ControladorOrdenCompra::ctrMostrarOrdenesdeCompras($item, $valor, $_SESSION["anioActual"]);
            if(!$ordenes == null)
            {
              echo' <div class="col-xs-2">
                      <h3 class="box-title">Trazabilidad:</h3>
                    </div>
                    <div class="col-xs-2">
                      <div class="description-block">
                        <span class="description-text">Orden de Compra</span>
                        <button class="btn btn-info btnVerOrden" sw="'.$facturas["id"].'" idOC="'.$ordenes["id"].'" title="Ver Orden">
                          <i class="fa fa-file-o"></i> '.$ordenes["codigoInt"].'
                        </button>
                      </div>
                    </div>';
            }
            ?>
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
           <th title="Cantidad añadida al stock">Stock</th>
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

              if (isset($value["imp"])) 
              {
                $imp1 = " (imp :".$value["imp"]."%)";
                $imp2 = " ($ ".(($value["imp"]/100)*$value["sub"]).", = ".(($value["imp"]/100)*$value["sub"])+$value["sub"].")";
              }
              else
              {
                $imp1 = "";
                $imp2 = "";
              }

              

              if($insumos["imagen"] != null)
              {
                $imagen = $insumos["imagen"];
              }
              else
              {
                 $imagen = "vistas/img/productos/default/anonymous.png";
              }

              $unidad = ControladorParametros::ctrMostrarUnidad($insumos["unidad"]);
              $unidadSal = ControladorParametros::ctrMostrarUnidad($insumos["unidadSal"]);

              $categoria = ControladorCategorias::ctrMostrarCategorias($item, $insumos["id_categoria"]);
               echo '<tr>
                      <td>'.($key+1).'</td>
                      <td><img src="'.$imagen.'" class="img-thumbnail" width="40px"></td>
                      <td>'.$insumos["codigo"].'</td>
                      <td>'.$value["des"].'</td>
                      <td>'.$categoria["categoria"].'</td>
                      <td>'.$value["can"].' '.$unidad.'(s)</td>
                      <td>'.($value["can"]*$value["con"]).' '.$unidadSal.'(s)</td>
                      <td>$<span class="cantidadEfectivo">'.$value["pre"].'</span>'.$imp1.'</td>
                      <td>$<span class="cantidadEfectivo">'.$value["sub"].'</span>'.$imp2.'</td>
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
