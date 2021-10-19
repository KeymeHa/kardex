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
      $ordenCompra = ControladorOrdenCompra::ctrMostrarOrdenesdeCompras($item, $valor);

       $item ="id";
       $valor = $ordenCompra['id_proveedor'];
       $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor); 
    }
  }
  else
  {
   echo'<script> window.location="ordendecompras";</script>';
  }
?>

<script type="text/javascript">
  $(document).ready(function(){

   if($('.nuevoInsumoAgregado').find(".row").length)
    {
      $("#cajaToNuFa").children().remove();
      $("#btnEditarOC").removeClass("btn-default");
      $("#btnEditarOC").addClass("btn-success");
      $('#btnEditarOC').attr("disabled", false);

      if ( $("#totalSinIVA").length > 0 ) 
      {
        $("#totalSinIVA").val(0);
      }
    }
    else
    {
      $("#btnEditarOC").removeClass("btn-success");
      $("#btnEditarOC").addClass("btn-default");
    }

  });
</script>

<div class="content-wrapper">

  <section class="content-header">   
    <h1>     
      Editar Orden de Compra   
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
      <li><a href="ordenesdecompra">Ordenes de Compra</a></li>     
      <li class="active">Editar Orden <?php echo $ordenCompra["codigoInt"]?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-6">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos de la Orden de Compra
          </div>
          <div class="box-body">
          <form role="form" method="post" class="formularioNuevaOC">
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Interno</label>
                    <?php
                      echo ' <input type="text" class="form-control" id="codigoInterno" name="codigoInterno" required value="'.$ordenCompra["codigoInt"].'" readonly>';
                       echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                        $parametros = ControladorParametros::ctrMostrarTodosParam();
                        echo'<input type="hidden" id="valorImpuesto" value="'.$parametros["valorIVA"].'" readonly>';
                    ?>       
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Proveedor</label>
                    <select class="form-control selectProvEdit" name="selecProveedor" idprovant="<?php echo $ordenCompra['id_proveedor']?>" codigo="<?php echo $ordenCompra["codigoInt"]?>" required>
                    <option value="<?php echo $ordenCompra['id_proveedor']?>" ><?php echo $proveedores["nit"]."-".$proveedores["digitoNit"].", ".$proveedores["razonSocial"];?></option>
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
                      <input type="text" class="form-control input-xs" title="Forma de Pago" name="nuevaFormaPago" placeholder="Forma de Pago" autocomplete="off" value="<?php echo $ordenCompra['formaPago']?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" title="Responsable" name="nuevoResponsable" placeholder="Responsable" autocomplete="off" value="<?php echo $ordenCompra['responsable']?>" required>
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
                      <input type="date" class="form-control input-xs" name="nuevaFechaEntrOC" title="Fecha de Entrega" value="" placeholder="dd/mm/AAAA" autocomplete="off">
                    </div>              
                  </div>
                </div>      
                <div class="col-lg-6">
                  <div class="form-group">          
                    <div class="input-group">                   
                      <textarea type="text" class="form-control input-xs" title="Observaciones" name="observacionOC" placeholder="Observaciones" autocomplete="off" style="width: 292px; height: 69px; resize: none"><?php echo $ordenCompra['observacion']?></textarea>
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
              <div class="form-group nuevoInsumoAgregado">
                <?php
                  $listaInsumos = json_decode($ordenCompra["insumos"], true);

                  if(!$listaInsumos == null)
                  {
                    foreach ($listaInsumos as $key => $value) 
                    {
                      echo'
                      <div class="row" style="padding:5px 15px">
                        <div class="col-xs-3" style="padding-right:0px">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'.$value["id"].'"><i class="fa fa-times"></i></button>
                            </span>
                          <input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'.$value["id"].'" value="'.$value["des"].'" title="'.$value["des"].'" readonly>
                          </div>
                        </div>
                        <div class="col-xs-3 ingresoCantidad">
                          <input type="number" class="form-control nuevaCantidadInsumo"  stock="stock" autocomplete="off" min="1" value="'.$value["can"].'" required>
                        </div>
                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="ion ion-social-usd"></i>
                            </span>
                            <input type="text" class="form-control nuevoPrecioInsumo" min="1" value="'.$value["pre"].'" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-xs-3 ingresoSubT" style="padding-left:0px">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="ion ion-social-usd"></i>
                            </span>
                            <input type="text" class="form-control subTotalInsumo" min="1" value="'.$value["sub"].'" disabled readonly required>
                          </div>
                        </div>

                      </div>
                      ';

                    }
                  }  
                ?>
              </div>
              <input type="hidden" name="listaInsumos" id="listaInsumos" value='<?php echo $ordenCompra['insumos']?>'>
              <input type="hidden" name="idOCedit" value="<?php echo $_GET["idOC"];?>" >
              <input type="hidden" name="valorIva" id="valorIva" value="<?php echo $ordenCompra['iva'];?>">
              <input type="hidden" name="valorSub" id="valorSub" value="<?php echo $ordenCompra['inversion'];?>">
              <div class="form-group" id="cajaToNuOC">
                <div class="row" style="padding:5px 15px">
                  <div class="col-xs-7" style="padding-right:0px">
                    <div class="input-group" title="SubTotal sin IVA">
                      <span class="input-group-addon">
                      <p>Sub T
                      </p>
                      </span>
                      <input type="text" class="form-control input-lg" id="totalSinIVAOC" value="<?php echo $ordenCompra['inversion'];?>" disabled readonly required>                   
                    </div>
                  </div>
                  <div class="col-xs-3" style="padding-right:0px">
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
                    <div class="input-group" title="Total+IVA">
                      <span class="input-group-addon">
                      <p>Total
                      </p>
                      </span>
                      <?php $total= intval($ordenCompra['inversion']) + intval($ordenCompra['iva']) ?>
                      <input type="text" class="form-control input-lg" id="totalMasIVA" value="<?php echo $total;?>" disabled  readonly required>
                    </div>
                  </div>
                </div>
              </div>
                <br>
                <a href="ordendecompras">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" style="color: white;" id="btnEditarOC" disabled class="btn btn-default pull-right">Editar</button>
                <?php
                  $editarNOC = new ControladorOrdenCompra();
                  $editarNOC -> ctrEditarOC();
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
             <table class="table table-bordered table-striped dt-responsive tablaInsumosNOC" width="100%">
              <thead>              
               <tr>             
                <th style="width:10px">#</th>
                 <th style="width:45px">Imagen</th>
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

