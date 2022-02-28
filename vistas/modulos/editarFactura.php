<div class="content-wrapper">
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
        $facturas = ControladorFacturas::ctrMostrarFacturas($item, $valor);
      }
    }
    else{

     echo'<script> window.location="facturas";</script>';

    }


  ?>
  <section class="content-header">
    
    <h1>
      
      Editar Factura: <?php  echo $facturas["codigoInt"];?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="#">Generaciones</a></li>

      <li><a href="facturas">Facturas</a></li>
      
      <li class="active"><?php  echo $facturas["codigoInt"];?></li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-6">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos de la Factura
          </div>

          <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data" class="formularioNuevaFactura">

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Interno</label>
                    <?php
                      echo ' <input type="text" class="form-control" id="codigoInterno" name="codigoInterno" required value="'.$facturas["codigoInt"].'" readonly>';
                       echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                        echo ' <input type="hidden" class="form-control" name="idFactura" required value="'.$facturas["id"].'" readonly required>';
                        $parametros = ControladorParametros::ctrMostrarTodosParam();
                        echo'<input type="hidden" id="valorImpuesto" value="'.$parametros["valorIVA"].'" readonly>';
                    ?>       
                  </div>
                </div>

                <div class="col-xs-7">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Factura</label>

                    <input type="text" class="form-control" id="codigoFactura" name="codigoFactura" placeholder="ej: COD-02-2021" value="<?php echo $facturas['codigo'];?>" autocomplete="off" title="Codigo o referencia del proveedor" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label>Proveedor</label>
                    <select class="form-control" name="selecProveedor" required>
                      <?php

                          $item = "id";
                          $valor = $facturas["id_proveedor"];

                          $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                           echo'<option value="'.$proveedores["id"].'">'.$proveedores["nit"].' - '.$proveedores["digitoNit"].', '.$proveedores["razonSocial"].'</option>';

                          $proveedores = ControladorProveedores::ctrMostrarProveedores(null, null);

                          foreach ($proveedores as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["nit"].' - '.$value["digitoNit"].', '.$value["razonSocial"].'</option>';
                          }

                          ?>
                    </select>
                  </div>  
                </div>

                <div class="col-xs-7">
                  <div class="form-group">
                    <label>Asociar Orden de Compra</label>
                      <select class="form-control" name="selectOC" required>

                        <option value="0">Seleccione la Orden de Compra</option>

                      <?php
                          $item = "fac_asociada";
                          $valor = 0;
                          //Buscar en orden de compra si existe un registro que tenga el id de esta factura
                          //si existe hacer un echo de <option> con los valores de la consulta
                          $ordenCompra = ControladorOrdenCompra::ctrMostrarOrdenesdeComprasFAC($item, $valor);
                          foreach ($ordenCompra as $key => $value) {       
                            echo '<option value="'.$value["id"].'">'.$value["codigoInt"].'</option>';
                          }
                      ?>
                    </select>
                  </div>
                </div>        
              </div>

              
              <textarea class="form-control" rows="3" name="observacionNF" placeholder="Observaciones" style="resize: none"><?php  echo $facturas["observacion"];?></textarea>

              <div class="row">
                 <div class="col-xs-7">
                  <div class="form-group">
                    <label for="exampleInputFile">Soporte Factura</label>
                    <input type="file" name="soporteFactura">

                    <p class="help-block">*Solo acepta Un solo PDF.</p> 
                    <br>
                  </div>
                </div>
                <div class="col-xs-3">
                  <div class="form-group">
                    <!--agregar un boton con el pdf actual, si se selecciona un nuevo archivo remplaza el actual-->
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-xs-3" style="padding-right:0px">
                  <p class="help-block">Insumo</p> 
                </div>
                <div class="col-xs-2">
                  <p class="help-block">Cantidad</p> 
                </div>
                <div class="col-xs-2">
                  <p class="help-block">Contenido</p> 
                </div>
                <div class="col-xs-2">
                  <p class="help-block">Precio</p> 
                </div>
                <div class="col-xs-3">
                  <p class="help-block">SubTotal Item</p> 
                </div>
                <br>
              </div>
              <div class="form-group nuevoInsumoAgregado">
                 <?php

                    $listaInsumos = json_decode($facturas["insumos"], true);

                  if(!$listaInsumos == null)
                  {
                    foreach ($listaInsumos as $key => $value) 
                    {
                        echo '<div class="row" style="padding:5px 15px">
                        <div class="col-xs-3" style="padding-right:0px">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'.$value["id"].'"><i class="fa fa-times"></i></button>
                            </span>
                          <input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'.$value["id"].'"  value="'.$value["des"].'" title="'.$value["des"].'" readonly>
                          </div>
                        </div>
                        <div class="col-xs-2 ingresoCantidad">
                          <input type="number" class="form-control nuevaCantidadInsumo"  autocomplete="off" min="1" value="'.$value["can"].'" required>
                        </div>
                        <div class="col-xs-2 ingresoContenido">
                          <input type="number" class="form-control nuevoContenido"  autocomplete="off" min="1" value="'.$value["con"].'" required>
                        </div>
                        <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">
                          <div class="input-group">
                            <input type="text" class="form-control nuevoPrecioInsumo" min="1" name="nuevoPrecioInsumo" value="'.$value["pre"].'" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-xs-3 ingresoSubT" style="padding-left:0px">
                          <div class="input-group">
                            <input type="text" class="form-control subTotalInsumo" min="1" name="subTotalInsumo" readonly value="'.$value["sub"].'" required>
                          </div>
                        </div>
                      </div>';
                    }
                  }
             
                ?>
              </div>
              <input type="hidden" name="listaInsumos" id="listaInsumos" value>
              <input type="hidden" name="valorIva" id="valorIva" value="<?php echo $facturas['iva'];?>">
              <input type="hidden" name="valorSub" id="valorSub" value="<?php echo $facturas['inversion'];?>">
              <div class="form-group" id="cajaToNuFa">
                <div class="row" style="padding:5px 15px">
                  <div class="col-xs-7" style="padding-right:0px">
                    <div class="input-group" title="SubTotal sin IVA">
                      <span class="input-group-addon">
                      <p>Sub T
                      </p>
                      </span>
                      <input type="text" class="form-control input-lg" id="totalSinIVA" value="<?php echo $facturas['inversion'];?>" disabled readonly required>
                    </div>
                  </div>
                  <div class="col-xs-4" style="padding-right:0px">
                    <div class="input-group" title="IVA">
                      <input type="number" class="form-control input-lg" id="iva" value="<?php echo $parametros['valorIVA'];?>" disabled readonly required>
                      <span class="input-group-addon">
                      <p>%
                      </p>
                      </span>
                    </div>
                  </div>
                  </div>
                  <div class="row" style="padding:5px 15px">
                  <div class="col-xs-7" style="padding-right:0px">
                    <div class="input-group" title="TotalIVA">
                      <span class="input-group-addon">
                      <p>Total
                      </p>
                      </span>
                      <?php $total= intval($facturas['inversion']) + intval($facturas['iva']) ?>
                      <input type="text" class="form-control input-lg" id="totalMasIVA" value="<?php echo $total;?>" disabled  readonly required>
                    </div>
                  </div>
                </div>
              </div>
                <br>
                <a href="facturas">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarFac">Guardar</button>
                <?php
                  $editarFac = new ControladorFacturas();
                  $editarFac -> ctrEditarFactura();
                ?>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="box box-success">
          <div class="box-header with-border">
            Seleccionar Insumos
          </div>
          <div class="box-body">            
             <table class="table table-bordered table-striped dt-responsive tablaInsumosNFactura" width="100%">              
              <thead>              
               <tr>                 
                 <th style="width:10px">Código</th>
                 <th>Descripción</th>
                 <th style="width:20px">Stock</th>
                 <th style="width:15px">Acciones</th>
               </tr> 
              </thead>
             </table>
          </div>
        </div><!--box box-success-->
      </div>
    </div><!--div-->
  </section>
</div>

