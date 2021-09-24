<div class="content-wrapper">
  <section class="content-header"> 
    <h1>   
      Nueva Acta
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="actas">Actas</a></li>
      <li class="active">Nueva Acta</li>
    </ol>
  </section>
  <section class="content">
    <form role="form" method="post" class="formularioNuevaActa">
    <div class="row">
      <div class="col-lg-4">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos del Acta de Salida
          </div>

          <div class="box-body">
            
              <div class="row">
                <div class="col-xs-5">
                  <label for="exampleInputEmail1" style="margin-top: 8px">Codigo Interno</label>
                  <div class="form-group">
                    <?php
                     $val = 20;
                     $parametro = ControladorParametros::ctrMostrarParametros($val);
                      echo ' <input type="text" class="form-control" name="codigoInterno" required value="'.$parametro["codigo"].'" readonly>';
                       echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                    ?>       
                  </div>
                </div>

                <div class="col-xs-6">
                  <label for="exampleInputEmail1" style="margin-top: 8px">Tipo de Acta</label>
                  <select class="form-control" name="tipoActa" required>
                    <option value="1">Salida</option>
                    <option value="2">Entrada</option>
                    <option value="3">Asignación</option>
                  </select>

                </div>

              </div>

                <div class="row">

                <div class="col-xs-5">
                  <p class="help-block">*Fecha</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" name="nuevaFecha" placeholder="dd/mm/AAAA" autocomplete="off" required>
                    </div>              
                  </div>
                </div>

              </div><!--row-->

              <div class="row">  
                <div class="col-xs-5">
                 <label>*Autorizado Por:</label>  
                </div>
              </div>

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" name="nuevoAutorizador" placeholder="Autorizado" autocomplete="off" required>
                    </div>
                  </div>
                </div>

                <div class="col-xs-5">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" name="nuevaDependencia" placeholder="Dependencia" autocomplete="off" required>
                    </div>
                  </div>
                </div>
              </div><!--row-->

              <div class="row">  
                <div class="col-xs-5">
                   <label>*Responsable:</label>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" name="nuevoResponsable" placeholder="Responsable" autocomplete="off" required>
                    </div>
                  </div>
                </div>

                <div class="col-xs-5">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" name="nuevaDependenciaR" placeholder="Dependencia" autocomplete="off" required>
                    </div>
                  </div>
                </div>
              </div><!--row-->

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label>*Motivo de Salida</label>
                    <select class="form-control" name="selecMotivo" required>
                      <option value="1">Prestamo</option>
                      <option value="2">Entrega</option>
                      <option value="3">Devolución</option>
                      <option value="4">Manto. o Reparación</option>
                      <option value="5">Traslado</option>
                    </select>
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">          
                    <div class="input-group">                   
                      <textarea type="text" class="form-control col-lg-12" name="observacionACT" placeholder="Observaciones" autocomplete="off" style="height: 69px; resize: none"></textarea>
                    </div>
                   </div>
                </div>
              </div><!--row-->
              <br>
              <a href="actas">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
              </a>
              <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarACT">Generar</button>
              
            
          </div><!--box body-->
        </div>
      </div>
      <div class="col-lg-8">
        <div class="box box-success">
          <div class="box-header with-border">
            
            <div class='btn-group'>
              <span class='btn btn-success agregarInsumo' title='Añadir'><i class='fa fa-plus'></i> Añadir
              </span>
             </div>
          </div>
          <div class="box-body">

             <div class="row">
                <center>
                <div class="col-xs-3">
                  <label>N° de Serie</label>
                </div>

                <div class="col-xs-2">
                  <label>Marca</label>
                </div>

                <div class="col-xs-2">
                  <label>Descripción</label>
                </div>

                 <div class="col-xs-2">
                  <label title="cantidad o unidades de este bien o insumo">U/N</label>
                </div>

                 <div class="col-xs-3">
                  <label>Observaciones</label>
                </div>
              </div>
              </center>
            <div class="form-group nuevoInsumoAgregado">
            </div><!--nuevoInsumoAgregado-->

            <div id="validarBN">
              <div class="hijovalidarBN">
                <br>
                <h5 style="text-align: center;">Por Favor Añadir bienes o insumos.</h5>
              </div>
            </div>

            <input type="hidden" name="listaInsumos" id="listaInsumos" value>
          </div>
        </div><!--box box-success-->
      </div>
    </div><!--div-->
      <?php
        $nuevaActa = new ControladorActas();
        $nuevaActa -> ctrNuevaActa();
      ?>
    </form>
  </section>
</div>