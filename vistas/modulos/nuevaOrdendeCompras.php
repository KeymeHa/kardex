<div class="content-wrapper">


  <section class="content-header">
    
    <h1>
      
      Nueva Orden de Compra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="generaciones">Generaciones</a></li>

      <li><a href="ordenesdecompra">Ordenes de Compra</a></li>
      
      <li class="active">Nueva Orden de Compra</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-5">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos de la Orden de Compra
          </div>

          <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data" class="formularioNuevaOC">

              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">N° de Orden</label>
                    <?php
                      echo ' <input type="text" class="form-control" id="codigoInterno" name="codigoInterno" required value="1" readonly>';
                       echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                        $valorIVA = ControladorParametros::ctrMostrarTodosParam();
                        echo'<input type="hidden" id="valorImpuesto" value="'.$valorIVA["valorIVA"].'" readonly>';
                    ?>       

                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>*Proveedor</label>
                    <select class="form-control selectProv" name="selecProveedor" required>
                      <option value="0">Seleccione el Proveedor</option>
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
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-money"></i></span> 
                      <input type="text" class="form-control input-xs" title="Forma de Pago" name="nuevaFormaPago" placeholder="*Forma de Pago" autocomplete="off" required>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" name="nuevoResponsable" title="Responsable" placeholder="*Responsable" autocomplete="off" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <p class="help-block">Fecha de Entrega</p>           
                    <div class="input-group">                            
                      <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                      <input type="date" class="form-control input-xs" name="nuevaFechaEntrOC" title="Fecha para Entrega" placeholder="dd/mm/AAAA" autocomplete="off">
                    </div>              
                  </div>
                </div>      

                <div class="col-lg-6">
                  <div class="form-group">          
                    <div class="input-group">                   
                      <textarea type="text" class="form-control" name="observacionOC" placeholder="Observaciones" title="Observaciones" autocomplete="off" rows="4" cols="20" style="resize: none"></textarea>
                    </div>
                   </div>
                </div>  
              </div>

              <div class="row">
                <br>
                <div class="col-xs-3" style="padding-right:0px">
                  <p class="help-block">Insumo</p> 
                </div>
                <div class="col-xs-3">
                  <p class="help-block">Cantidad</p> 
                </div>
                <div class="col-xs-3">
                  <p class="help-block">Precio</p> 
                </div>
                <div class="col-xs-3">
                  <p class="help-block">SubTotal Item</p> 
                </div>
                <br>
              </div>
              <div class="form-group nuevoInsumoAgregado"></div>

              <input type="hidden" name="listaInsumos" id="listaInsumos" value>
              <input type="hidden" name="valorIva" id="valorIva" value>
              <input type="hidden" name="valorSub" id="valorSub" value>

              <div class="form-group" id="cajaToNuOC"></div>
                <br>

                <a href="ordendecompras">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarOC">Generar</button>

                <?php
                  $generarOC = new ControladorOrdenCompra();
                  $generarOC -> ctrGenerarOrdenC();
                ?>

            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="box box-success">
          <div class="box-header with-border">
            Seleccionar Insumos
          </div>
          <div class="box-body">
            
             <table class="table table-bordered table-striped dt-responsive tablaInsumosNOC" width="100%">
               
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

