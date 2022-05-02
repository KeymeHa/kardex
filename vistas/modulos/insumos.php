<?php
  if(isset($_GET["resultado"]) )
  {
    if($_GET["resultado"] == "ok")
    {
      echo'<script>

      swal({
          type: "success",
          title: "Insumos Importados",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
          }).then(function(result){
              if (result.value) {

              window.location = "insumos";

              }
            })

      </script>';
    }
    else if($_GET["resultado"] == "error")
    {
      echo'<script>

      swal({
          type: "error",
          title: "Error En la importación, no se pudo completar.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
          }).then(function(result){
              if (result.value) {

              window.location = "insumos";

              }
            })

      </script>';

    }
  }
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Insumos  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Inventario</a></li>     
      <li class="active">Insumos</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" id="btn-AddInsumo" data-toggle="modal" data-target="#modalAgregarInsumo"><i class="fa fa-plus"></i>      
          Nuevo Insumo
        </button>
        <?php
         $parametro = ControladorParametros::ctrVerificarIns();

         if($parametro == 0)
         {
            echo'<button class="btn btn-success" data-toggle="modal" data-target="#modalimportarIns">
                <i class="fa fa-download"></i> Importar Insumos
                </button>
                <a href="vistas/doc/plantillaInsumos.xlsx">
                <button class="btn btn-success">
                <i class="fa fa-download"></i> Descargar Plantilla
                </button>
                </a> <i class="fa fa-warning text-yellow"></i><span> Antes de importar debe haber creado al menos 1 categoria</span>';
         }
        ?>   
        <div class="btn-group pull-right">
          <button class="btn btn-success" id="btnGenIns" data-toggle="modal" data-target="#modalGeneracionInsumos"><i class="fa fa-file-text-o"></i>
            Generaciones
          </button>
        </div>
        <div class="btn-group pull-right" style="margin-right: 5px;">
          <button class="btn btn-success" id="btnParamLim" paramIns="1" data-toggle="modal" data-target="#modalParametrosInsumos"><i class="fa fa-gear"></i>
            Parametros
          </button>
        </div>
      </div>
      <div class="box-body"> 
        <?php include "accionId.php";
              include "tablas/tablaInsumos.php";?>     
       
      </div>
    </div>
  </section>
</div>


<div id="modalAgregarInsumo" class="modal fade" role="dialog"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#00A65A; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar Insumo</h4>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <div class="box-body">
              <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
              <div class="form-group">          
                <div class="input-group">           
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>              
                    <option value="">Selecionar categoría</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $categorias = ControladorCategorias::ctrMostrarCategoriasConFiltro($item, $valor);
                    foreach ($categorias as $key => $value) 
                    {                  
                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- ENTRADA PARA EL CÓDIGO -->           
              <div class="form-group">              
                <div class="input-group">               
                  <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                  <input type="number" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" autocomplete="off" title="Codigo del Insumo" required>
                </div>
              </div>
              <!-- ENTRADA PARA LA DESCRIPCIÓN -->
              <div class="form-group">             
                <div class="input-group">             
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" autocomplete="off" title="Nombre o descripción" required>
                  <input type="hidden" name="idUsr" value="<?php echo $_SESSION['id'];?>" required>
                </div>
              </div>
               <!-- UBICACION EN BODEGA -->
               <div class="form-group row">
                  <div class="col-xs-4"> 
                    <p class="help-block">Estante</p>               
                    <div class="input-group">                 
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                      <input type="text" class="form-control input-lg" id="nuevoEstante" name="nuevoEstante" placeholder="1" autocomplete="off" title="Estante" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <p class="help-block">Nivel</p>               
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                      <input type="text" class="form-control input-lg" title="Nivel" id="nuevoNivel" name="nuevoNivel" placeholder="4" autocomplete="off" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <p class="help-block">Sección</p>           
                    <div class="input-group">          
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                      <input type="text" class="form-control input-lg" title="sección" id="nuevaSeccion" name="nuevaSeccion" placeholder="3"  autocomplete="off">
                    </div>
                  </div>
               </div>
               <!-- ENTRADA PARA PRECIO COMPRA -->

               <div class="form-group">  
               <label>Precio de Compra</label>           
                <div class="input-group">           
                  <span class="input-group-addon"><i class="fa fa-money"></i></span> 
                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" value="0" title="Precio de Compra" placeholder="Precio de compra" autocomplete="off" required>
                </div>
              </div>

               <div class="form-group">  
               <label>Unidad de Medida Entrada (Facturas)</label>           
                <div class="input-group">           
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 
                  <select class="form-control input-lg" id="nuevaUnidadEnt" name="nuevaUnidadEnt" required>
                  </select>
                </div>
              </div>

               <div class="form-group">              
                <div class="input-group">               
                  <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoContenido" placeholder="Cantidad Individual" autocomplete="off" title="Ej: un paquete contiene 6 unidades de un articulo" required>
                </div>
              </div>

               <div class="form-group">  
               <label>Unidad de Medida Salida (Requisición)</label>           
                <div class="input-group">           
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 
                  <select class="form-control input-lg" id="nuevaUnidadSal" name="nuevaUnidadSal" required>
                  </select>
                </div>
              </div>

               <div class="form-group">          
                <label>Prioridad</label>           
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" name="nuevaPrioridad" required>              
                    <option value="3" style="color: green;">Baja</option>
                    <option value="2" style="color: orange;">Media</option>
                    <option value="1" style="color: red;">Alta</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="0" name="nuevaHabilitado">
                      Marque para no mostrar el insumo en requisición
                    </label>
                  </div>
              </div>

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">             
                <div class="panel">*Subir Imagen</div>
                <input type="file" class="nuevaImagen" name="nuevaImagen">
                <p class="help-block">Peso máximo de la imagen 2MB</p>
                <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              </div>
          </div><!--box-body-->
        </div><!--modal-body-->
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar producto</button>
        </div>
      </form>
        <?php
          $crearInsumo = new ControladorInsumos();
          $crearInsumo -> ctrCrearInsumo();
        ?>  
    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modalAgregarInsumo-->

<?php

  include "modalEditarInsumos.php";
  include "modal/modalStock.php";
?>

<div id="modalParametrosInsumos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#00A65A; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Parametros</h4>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <div class="box-body">

                <div class="form-group row">
                  <p>Modificar limites Bajos, moderados y Altos de los insumos en inventario.</p>
                  <p><b>Alto:</b> 26 o mayor.</p>
                  <p><b>Moderado:</b> 11 a 25.</p>
                  <p><b>Bajo:</b> 1 a 10.</p>
                </div>

              <!-- UBICACION EN BODEGA -->
               <div class="form-group row">
                  <div class="col-xs-4"> 
                    <p class="help-block">Bajo</p>               
                    <div class="input-group">                 
                      <span class="input-group-addon"><i class="fa fa-chevron-down"></i></span> 
                      <input type="number" class="form-control input-lg" id="insumoBajo" name="insumoBajo" min="1" max="10" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <p class="help-block">Moderado</p>               
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span> 
                      <input type="number" class="form-control input-lg" id="insumoModerado" name="insumoModerado" min="11" max="25" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <p class="help-block">Alto</p>           
                    <div class="input-group">          
                      <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span> 
                      <input type="number" class="form-control input-lg" id="insumoAlto" name="insumoAlto" min="26" autocomplete="off">
                    </div>
                  </div>
               </div>
            </div><!--box-body-->
          </div><!--modal-body-->
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Editar</button>
        </div>
        <?php
          $editarParInsu = new ControladorParametros();
          $editarParInsu -> ctrEditarLimInsumos();
        ?>  
      </form>
    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modalEditarInsumo-->

<div id="modalGeneracionInsumos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#00A65A; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Generarción Archivos</h4>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <div class="box-body">
                <div class="form-group row">
                   <div class="col-xs-8"> 
                    <p class="help-block">Nombre del Responsable</p>               
                    <div class="input-group">                 
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-lg" id="nombreResp"  autocomplete="off">
                    </div>
                  </div>
                </div>
               <div class="form-group row" style="margin-left: 5px;">
                    <div class="input-group">                 
                      <button class="btn btn-danger pull-right" id="genPDFInsumos" disabled="">
                        <i class="fa fa-file-pdf-o"></i>
                        Generar Acta de Inventario PDF
                      </button>
                    </div>
  
                    <br>
                
                    <div class="input-group">                 
                      <button class="btn btn-success pull-right" id="genXlsInsumos">
                        <i class="fa fa-file-excel-o"></i>
                        Descargar Insumos en Excel
                      </button>
                    </div>
               </div>
            </div><!--box-body-->
          </div><!--modal-body-->
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modalEditarInsumo-->

<div id="modalimportarIns" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importar Requisición</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="importacionGenerada" val="1">
              <input type="file" name="nuevaImpIns">
              <p class="help-block">Archivo formato .xlsx .xls .odt</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Importar</button>
          </div>
        </div>
        <?php
            $importarIns = new ControladorInsumos();
            $importarIns -> ctrImportarIns();
        ?>
      </form>
    </div>
</div>

<?php
  $borrarInsumo = new ControladorInsumos();
  $borrarInsumo -> ctrBorrarInsumo();
?>  