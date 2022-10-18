<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Nueva Remisión
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="#">Generaciones</a></li>

      <li><a href="facturas">Remisiones</a></li>
      
      <li class="active">Nueva Remisión</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-6">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos de la Remisión
          </div>

          <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data" class="formularioNuevaFactura">

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Interno</label>
                    <?php
                     $val = 5;
                     $parametro = ControladorParametros::ctrMostrarParametros($val);
                      echo ' <input type="text" class="form-control" id="codigoInterno" name="codigoInterno" required value="'.$parametro["codigo"].'" readonly>';
                       echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                        $parametros = ControladorParametros::ctrMostrarTodosParam();
                        echo'<input type="hidden" id="valorImpuesto" value="'.$parametros["valorIVA"].'" readonly>';
                    ?>       

                  </div>
                </div>

                <div class="col-xs-7">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Factura</label>

                    <input type="text" class="form-control" id="codigoFactura" name="codigoFactura" placeholder="ej: COD-02-2021" autocomplete="off" title="Codigo o referencia del proveedor" required>
                    <input type="hidden" id="inputanioActual" value="<?php echo $_SESSION['anioActual'];?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label>Proveedor</label>
                    <select class="form-control" name="selecProveedor" required>
                      <?php

                          $item = null;
                          $valor = null;

                           $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

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
                          $ordenCompra = ControladorOrdenCompra::ctrMostrarOrdenesdeComprasFAC($item, $valor);
                          foreach ($ordenCompra as $key => $value) {       
                            echo '<option value="'.$value["id"].'">'.$value["codigoInt"].'</option>';
                          }
                          ?>
                    </select>
                  </div>
                </div>        
              </div>

              <div class="row">
                  <div class="col-sm-6 col-lg-6 col-md-6">
                    <p class="help-block">*Fecha</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" name="fechaAprobacion" id="fechaAprobacionF" value="" />
                    </div>              
                  </div>
                </div>
              </div>

               <textarea class="form-control" rows="3" name="observacionNF" placeholder="Observaciones" style="resize: none"></textarea>

              <div class="row">
                 <div class="col-xs-7">
                  <div class="form-group">
                    <label for="exampleInputFile">Soporte Remisión</label>
                    <input type="file" name="soporteFactura">

                    <p class="help-block">*Solo acepta Un solo PDF.</p> 
                    <br>
                  </div>
                </div>
              </div>

              
              <div class="row">
                <div class="col-sm-3 col-md-2 col-lg-3" style="padding-right:0px">
                  <p class="help-block">Insumo</p> 
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                  <p class="help-block">Cantidad</p> 
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                  <p class="help-block">Contenido</p> 
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                  <p class="help-block">Precio</p> 
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                  <p class="help-block">SubTotal Item</p> 
                </div>
                <br>
              </div>
              <div class="form-group nuevoInsumoAgregado"></div>
              <input type="hidden" name="listaInsumos" id="listaInsumos" value>
              <input type="hidden" name="valorIva" id="valorIva" value>
              <input type="hidden" name="valorSub" id="valorSub" value>
              <div class="form-group" id="cajaToNuFa"></div>
                <br>
                <a href="facturas">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarFac">Guardar</button>
                <?php
                  $anexarFac = new ControladorFacturas();
                  $anexarFac -> ctrCrearFactura();
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

