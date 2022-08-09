<div class="content-wrapper">
  <?php

   if(isset($_GET["idRq"]) )
    {
      if($_GET["idRq"] == null)
      {
        echo'<script> window.location="requisiciones";</script>';

      }
      else
      {
        $item = "id";
        $valor = $_GET["idRq"];
        $requisicion = ControladorRequisiciones::ctrMostrarRequisiciones($item, $valor, $_SESSION["anioActual"]);
      }
    }
    else{

     echo'<script> window.location="requisiciones";</script>';

    }


  ?>
  <section class="content-header">
    <h1>
      Requisición Solicitada 
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
      <li><a href="requisiciones">Requisiciónes</a></li>
      <li class="active">Solicitada</li>
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
          <form role="form" method="post" class="formularioNuevaRq">
              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo Requisición</label>
                    <?php
                      echo ' <input type="text" class="form-control" required value="'.$requisicion["codigoInt"].'" readonly>';
                      echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                    ?>
                  </div>
                </div>

                <div class="col-xs-7">
                  <div class="form-group">
                    <label>Solicitante RQ</label>
                    <select class="form-control" name="id_persona" required>
                      <?php
                        
                          if($requisicion["id_persona"] != null)
                          {
                            $valor1 = $requisicion["id_persona"];
                            $persona = ControladorPersonas::ctrMostrarPersonas("id_usuario", $valor1);
                            $item1 = "id";
                            $valor1 = $requisicion["id_area"];
                            $areas = ControladorAreas::ctrMostrarAreas($item1, $valor1);

                            echo '<option value="'.$requisicion["id_persona"].'">'.$persona["nombre"].', '.$areas["nombre"].'</option>';
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
                      <?php if ($requisicion["fecha_sol"] != null) { 
                        echo '<input type="date" class="form-control" name="nuevaFechaSolRq" placeholder="dd/mm/AAAA" autocomplete="off" value="'.$requisicion["fecha_sol"].'" readonly>';
                      }
                      else
                      {
                        echo '<input type="date" class="form-control" name="nuevaFechaSolRq" placeholder="dd/mm/AAAA" autocomplete="off" readonly>';
                      }
                      ?>
                    </div>              
                  </div>
                </div>
              </div><!--row-->

               <textarea class="form-control" rows="3" name="observacionRq" rows="3" placeholder="Observaciones" autocomplete="off" style="resize: none"></textarea>

               <br>
               <p class="help-block">Observaciones del encargado</p>
               <textarea class="form-control" rows="3" rows="3" placeholder="Observaciones del Encargado" autocomplete="off" style="resize: none" disabled readonly><?php echo $requisicion["observacionE"]; ?></textarea>
              
              <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-6" style="padding-right:0px">
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
                <?php

                  $listaInsumos = json_decode($requisicion["insumos"], true);

                  if(!$listaInsumos == null)
                  {
                    foreach ($listaInsumos as $key => $value) 
                    {
                      $item = "codigo";
                      $valor = $value["codigo"];

                      if (is_integer($valor)) 
                      {
                        $insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);

                        if($insumos != null)
                        {
                          if($insumos["descripcion"] != $value["descripcion"])
                          {
                             $matchError.= '<li><small class="label label-warning">Adv</small><span class="text">El insumo con codigo <b>'.$valor.'</b> aparece como <b>'.$insumos["descripcion"].'</b> pero no como <b>'.$value["descripcion"].'</b>.</span></li>';
                          }

                          if($insumos["stock"] == 0)
                          {
                            $matchError.= '<li><small class="label label-danger">Error</small><span class="text">El Insumo Con codigo <b>'.$valor.'</b> no tiene stock disponible.</span></li>';
                          }
                          else
                          {
                            if($insumos["stock"] < $value["entregar"])
                            {
                              $matchError.= '<li><small class="label label-warning">Adv</small><span class="text">El Insumo Con codigo <b>'.$valor.'</b> solo cuenta con <b>'.$insumos["stock"].'</b> de stock de los <b>'.$value["entregar"].'</b> que solicita.</span></li>';

                              echo '<div class="row" style="padding:5px 15px">
                              <div class="col-xs-5" style="padding-right:0px">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'.$insumos["id"].'"><i class="fa fa-times"></i></button>
                                  </span>
                                <input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'.$insumos["id"].'" value="'.$insumos["descripcion"].'" readonly>
                                </div>
                              </div>
                              <div class="col-xs-3 pedidaRQ">
                                <input type="number" class="form-control nuevaCantidadPedida" stock="'.$insumos["stock"].'"name="nuevaCantidadPedida" min="1" value="'.$value["solicitado"].'" required>
                              </div>
                              <div class="col-xs-3 entregadaRQ">
                                <input type="number" class="form-control nuevaCantidadEntregada" stock="'.$insumos["stock"].'" name="nuevaCantidadEntregada" min="1" value="'.$insumos["stock"].'" required>
                              </div>
                            </div>';
                            }
                            else
                            {
                              echo '<div class="row" style="padding:5px 15px">
                              <div class="col-xs-5" style="padding-right:0px">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'.$insumos["id"].'"><i class="fa fa-times"></i></button>
                                  </span>
                                <input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'.$insumos["id"].'" value="'.$insumos["descripcion"].'" readonly>
                                </div>
                              </div>
                              <div class="col-xs-3 pedidaRQ">
                                <input type="number" class="form-control nuevaCantidadPedida" stock="'.$insumos["stock"].'" name="nuevaCantidadPedida" min="1" value="'.$value["solicitado"].'" required>
                              </div>
                              <div class="col-xs-3 entregadaRQ">
                                <input type="number" class="form-control nuevaCantidadEntregada" stock="'.$insumos["stock"].'" name="nuevaCantidadEntregada" min="1" value="'.$value["entregar"].'" required>
                              </div>
                            </div>';
                            }
                          }
                        }
                        else
                        {
                          $matchError.= '<li><small class="label label-danger">Error</small><span class="text">El Insumo Con codigo <b>'.$valor.'</b> no Existe.</span></li>';
                        }
                      }
                      else
                      {
                        $matchError.= '<li><small class="label label-danger">Error</small><span class="text">El registro con código <b>'.$valor.'</b> no son digitos.</span></li>';
                      }
                    }
                  }

                ?>
              </div>

              <input type="hidden" name="listadoInsumosRq" id="listadoInsumosRq" value>
              <input type="hidden" name="editarRq" value="<?php echo $requisicion['id']?>">
                <br>
                <a href="requisiciones">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <button type="submit" style="color: white;" class="btn btn-success pull-right btnGuardarRq"><?php if($requisicion['aprobado'] == 0){echo 'Aprobar';}else{echo 'Editar';}?></button>

                <?php
                  $editarRq = new ControladorRequisiciones();
                  $editarRq -> ctrEditarRequisicion($_SESSION["anioActual"]);
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

<div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12">
  <div class="box box-warning" style="overflow:scroll; height: 400px">
      <div class="box-header with-border">
        Consola de Importación
      </div>
      <div class="box-body">
        <ul class="todo-list ui-sortable">
          <?php
            $todook = '<li><small class="label label-success">Ok</small><span class="text">Todo en orden</span></li>';
            if ( isset($matchError) ) 
            {
              if($matchError == "")
              {
                echo $todook;
              }
              else
              {
                echo $matchError;
              }
            }
            else
            {
              echo $todook;
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>

