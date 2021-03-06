<div class="content-wrapper">


  <section class="content-header">
    
    <h1>
      
      Nueva Requisición
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="#">Generaciones</a></li>

      <li><a href="requisiciones">Requisición</a></li>
      
      <li class="active">Nueva Rq</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-5">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos Requisición
          </div>

          <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data" class="formularioNuevaRq">

              <div class="row">
                
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Requisición</label>
                    <?php
                     $val = 4;
                     $parametro = ControladorParametros::ctrMostrarParametros($val);
                      echo ' <input type="text" class="form-control" name="codigoInterno" required value="'.$parametro["codigo"].'" readonly>';
                      echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                    ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-7">
                  <div class="form-group">
                    <label>Solicitante RQ</label>
                    <select class="form-control" name="id_persona">
                        <?php
                        $item = null;
                        $valor = null;
                        $personas = ControladorPersonas::ctrMostrarPersonas($item, $valor);
                        
                       foreach ($personas as $key => $value){
                                  
                          $item1 = "id";
                          $valor1 = $value["id_area"];
                          $areas = ControladorAreas::ctrMostrarAreas($item1, $valor1);

                          echo '<option value="'.$value["id"].'" name="idPersona">'.$value["nombre"].', '.$areas["nombre"].'</option>';
                        }

                        ?> 
                    </select>
                  </div>   
                </div>
              </div>

              <div class="row">
                <div class="col-xs-5">
                  <p class="help-block">*Fecha de Solicitud</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" id="fechaGeneracion" placeholder="dd/mm/AAAA" autocomplete="off" required>
                    </div>              
                  </div>
                </div>
              </div><!--row-->

              <textarea class="form-control" rows="3" name="observacionRq" rows="3" name="observacionRq" placeholder="Observaciones" autocomplete="off" style="resize: none"></textarea>

              <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-5" style="padding-right:0px">
                  <p class="help-block">Insumo</p> 
                </div>
                <div class="col-xs-3">
                  <p class="help-block">Solicitado</p> 
                </div>
                 <div class="col-xs-3">
                  <p class="help-block">Entregado</p> 
                </div>
                <br>
              </div>
              <div class="form-group nuevoInsumoAgregadoRq"></div>

              <input type="hidden" name="listadoInsumosRq" id="listadoInsumosRq" value>

                <br>

                <a href="requisiciones">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarRq">Guardar</button>

                <?php
                  $anexarRq = new ControladorRequisiciones();
                  $anexarRq -> ctrCrearRequisicion();
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
            
             <table class="table table-bordered table-striped dt-responsive tablaInsumosNRq" width="100%">
               
              <thead>
               
               <tr>
                 
                <th style="width:10px">#</th>
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
