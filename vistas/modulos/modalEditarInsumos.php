<div id="modalEditarInsumo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#00A65A; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Imsumo</h4>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <div class="box-body">
              <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
              <div class="form-group">          
                <div class="input-group">
                  <!-- EDITAR ID -->       
                  <input type="hidden" class="form-control input-lg" id="eIdP" name="eIdP" readonly>    
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" id="EsCategoria" name="EsCategoria" required>
                  </select>
                </div>
              </div>
              <!-- ENTRADA PARA EL CÓDIGO -->         
              <div class="form-group">               
                <div class="input-group">               
                  <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                  <input type="number" class="form-control input-lg" id="eCodigoP" name="eCodigoP"  readonly>
                </div>
              </div>
              <!-- ENTRADA PARA LA DESCRIPCIÓN -->
              <div class="form-group">              
                <div class="input-group">               
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                  <input type="text" class="form-control input-lg" id="eDescripcionP" name="eDescripcionP" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group row">          
                <div class="input-group">                   
                  <textarea type="text" class="form-control input-lg" name="eObservacionP" id="eObservacionP" placeholder="Observaciones" style="width: 566px; resize: none"></textarea>
                </div>
               </div>

              <div class="form-group row">
                 <label>&nbsp;Precio de Compra</label> 
                  <div class="input-group"> 
                    <div class="col-xs-8">              
                      <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-money"></i></span> 
                        <input type="number" class="form-control input-lg" id="ePrecioCompra" min="0" placeholder="Precio de compra" autocomplete="off">
                      </div>
                    </div>
                  </div>
               </div>

               <div class="form-group">  
               <label>Unidad de Medida Entrada (Facturas)</label>           
                <div class="input-group">           
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 
                  <select class="form-control input-lg" id="editarUnidadEnt" name="editarUnidadEnt" required>
                  </select>
                </div>
              </div>

               <div class="form-group">              
                <div class="input-group">               
                  <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                  <input type="number" class="form-control input-lg" id="ediarContenido" name="ediarContenido" placeholder="Cantidad Individual" autocomplete="off" title="Ej: un paquete contiene 6 unidades de un articulo" required>
                </div>
              </div>

               <div class="form-group">  
               <label>Unidad de Medida Salida (Requisición)</label>           
                <div class="input-group">           
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 
                  <select class="form-control input-lg" id="editarUnidadSal" name="editarUnidadSal" required>
                  </select>
                </div>
              </div>

              <!-- UBICACION EN BODEGA -->
               <div class="form-group row">
                  <div class="col-xs-4"> 
                    <p class="help-block">Estante</p>               
                    <div class="input-group">                 
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                      <input type="number" class="form-control input-lg" id="eEstanteP" min="0" name="eEstanteP" placeholder="5" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <p class="help-block">Nivel</p>               
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                      <input type="number" class="form-control input-lg" id="eNivelP" min="0" name="eNivelP" placeholder="2" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <p class="help-block">Sección</p>           
                    <div class="input-group">          
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                      <input type="number" class="form-control input-lg" id="eSeccionP" min="0" name="eSeccionP" placeholder="3" autocomplete="off">
                    </div>
                  </div>
               </div>
              <div class="form-group row">          
                <label>&nbsp;Prioridad</label>           
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" name="ePrioridadP" id="ePrioridadP" required>
                    <option value="3" style="color: green;">Baja</option>
                    <option value="2" style="color: orange;">Media</option>
                    <option value="1" style="color: red;">Alta</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="0" id="editarHabilitado" name="editarHabilitado">
                      Marque para no mostrar el insumo en requisición
                    </label>
                  </div>
              </div>
              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">               
                <div class="panel">*Subir Imagen</div>
                <input type="file" class="eImagenP" name="eImagenP">
                <p class="help-block">Peso máximo de la imagen 2MB</p>
                <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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
          $editarInsumo = new ControladorInsumos();
          $editarInsumo -> ctrEditarInsumo();
        ?>  
      </form>
    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modalEditarInsumo-->