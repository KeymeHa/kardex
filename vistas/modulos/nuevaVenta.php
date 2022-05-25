<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Nueva Venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="facturas">Ventas</a></li>
      
      <li class="active">Nueva Venta</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-6">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos para Factura
          </div>

          <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data" class="formularioNuevaVenta">

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Interno</label>
                    <?php
                     $val = 26;
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
                    <label for="exampleInputEmail1">Seleccionar Cliente</label>
                      <div class="col-xs-9">
                      <select class="form-control input-xs" required id="select-clientes">
                        <option value="0">Clientes</option>
                        <?php

                          $clientes = ControladorClientes::ctrMostrarClientes(null, null);

                          if (count($clientes) != 0) 
                          {
                            foreach ($clientes as $key => $value) 
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].', '.$value["sid"].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-3">
                      <a href="#" class="btn btn-success btn-add-cliente" title="Añadir Cliente" data-toggle="modal" data-target="#modalAgregarCliente"><i class="fa fa-user-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>

               <textarea class="form-control" rows="3" name="observacionNF" placeholder="Observaciones" style="resize: none"></textarea>

              
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
                  <button type="button" class="btn btn-danger pull-left" onclick="history.back()" data-dismiss="modal">Cancelar</button>
                <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarFac">Guardar</button>
                <?php
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
             <table class="table table-bordered table-striped dt-responsive tablaInsumosNVenta" width="100%">              
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


<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form-add-cliente">

          <div class="modal-header" style="background:#00A65A; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Cliente</h4>

          </div>

          <div class="modal-body">
            <div class="box-body">
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                  <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cc-discover"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoID" id="nuevoID" placeholder="Identificación" min="0" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-at"></i></span> 
                  <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar correo Electronico" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefóno" required>
                </div>
              </div>

              
          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Agregar Cliente</button>
        </div>

      </form>

    </div><!--modal-content-->
  </div><!--modal-dialog-->

</div><!--modalAgregarPersona-->
