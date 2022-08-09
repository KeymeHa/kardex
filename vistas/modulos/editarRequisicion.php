<div class="content-wrapper">
  <?php
    include "bannerConstruccion.php";
    $tempInsumos = ControladorRequisiciones::ctrMostrartempRq();
    //tempdatosrq
    $tempDatos = ControladorRequisiciones::ctrMostrartempDatosRq();
    $matchError = "";

    if($tempInsumos == null)
    {
      echo'<script> window.location="requisicion";</script>';
    }
  ?>
  <section class="content-header">
    <h1>
      Nueva Requisición
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
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

                <div class="col-xs-7">
                  <div class="form-group">
                    <label>Solicitante RQ</label>
                    <select class="form-control" name="id_persona" required>
                      <?php
                        
                        if($tempDatos["nombre"] != null)
                        {
                          $item = "nombre";
                          $valor = $tempDatos["nombre"];
                          $personas = ControladorPersonas::ctrMostrarPersonas($item, $valor);

                          if($personas != null)
                          {
                            $item1 = "id";
                            $valor1 = $personas["id_area"];
                            $areas = ControladorAreas::ctrMostrarAreas($item1, $valor1);

                            echo '<option value="'.$personas["id"].'">'.$personas["nombre"].', '.$areas["nombre"].'</option>';
                          }
                          else
                          {
                            echo '<option value="0">Seleccione Solicitante</option>';
                          }
                        }
                        else
                        {
                           echo '<option value="0">Seleccione Solicitante</option>';
                        }

                        $item = null;
                        $valor = null;
                        $personas = ControladorPersonas::ctrMostrarPersonas($item, $valor);
                        
                       foreach ($personas as $key => $value){
                                  
                          $item1 = "id";
                          $valor1 = $value["id_area"];
                          $areas = ControladorAreas::ctrMostrarAreas($item1, $valor1);

                          if ($personas["id"] != $value["id"]) 
                          {
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].', '.$areas["nombre"].'</option>';
                          }
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
                      <?php if ($tempDatos["fecha"] != null) { 
                        echo '<input type="date" class="form-control" name="nuevaFechaSolRq" placeholder="dd/mm/AAAA" autocomplete="off" value="'.$tempDatos["fecha"].'" required>';
                      }
                      else
                      {
                        echo '<input type="date" class="form-control" name="nuevaFechaSolRq" placeholder="dd/mm/AAAA" autocomplete="off" required>';
                      }
                      ?>
                    </div>              
                  </div>
                </div>
              </div><!--row-->

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">          
                    <div class="input-group">                   
                      <textarea type="text" class="form-control input-xs" name="observacionRq" placeholder="Observaciones" autocomplete="off" style="width: 500px; height: 69px; resize: none"></textarea>
                    </div>
                   </div>
                </div> 
              </div>
              
              <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-5" style="padding-right:0px">
                  <p class="help-block">Insumo</p> 
                </div>
                <div class="col-xs-2">
                  <p class="help-block">Pedida</p> 
                </div>
                <div class="col-xs-2">
                  <p class="help-block">Entregada</p> 
                </div>
                <br>
              </div>
              <div class="form-group nuevoInsumoAgregadoRq">
              </div>

              <input type="hidden" name="listadoInsumosRq" id="listadoInsumosRq" value>
              <input type="hidden" name="importadoRq" value="1">
                <br>
                <a href="requisiciones">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" style="color: white;" class="btn btn-success pull-right btnGuardarRq">Guardar</button>

                <?php
                  $anexarRq = new ControladorRequisiciones();
                  $anexarRq -> ctrEditarRequisicion($_SESSION["anioActual"]);
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
             <table class="table table-bordered table-striped dt-responsive tablaInsumosNRq" width="100%" data-page-length='14'>
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

