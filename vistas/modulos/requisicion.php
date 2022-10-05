<?php
  if(isset($_GET["idRq"]) )
    {
      if( !is_null($_GET["idRq"]) )
      {
        $item = "id";
        $valor = $_GET["idRq"];
        $requisicion = ControladorRequisiciones::ctrMostrarRequisiciones($item, $valor, $_SESSION["anioActual"]);
      }
    }
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo ( $_SESSION["perfil"] == 3 ) ? 'Nueva' : 'Generar'; ?> Requisición
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <?php echo ( $_SESSION["perfil"] == 3 ) ? '<li><a href="#">Generaciones</a></li>
      <li><a href="requisiciones">Requisición</a></li>
      <li class="active">Nueva Rq</li>' : '<li class="active">Nueva Rq</li>'; ?>
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
                     $val = 4;
                     $parametro = ControladorParametros::ctrMostrarParametros($val);
                      echo ' <input type="text" class="form-control" name="codigoInterno" required value="'.$parametro["codigo"].'" readonly>
                       <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                      echo ( $_SESSION["perfil"] == 3 ) ? '<input type="hidden" class="form-control" id="tipoGen" required value="'.$_SESSION["perfil"].'" readonly required>' : '';
                    ?>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-7">
                  <div class="form-group">
                    <label>Solicitante RQ</label>
                    <select class="form-control" name="id_persona" id="selectPersona">

                      <?php 

                      if ( $_SESSION["perfil"] == 3 ) 
                      {
                        echo '<option value="">Seleccione Encargado</option>';
                        $item = null;
                        $valor = null;
                        $personas = ControladorPersonas::ctrMostrarPersonasOrdenadas($item, $valor);
                        
                       foreach ($personas as $key => $value){
                                  
                          $item1 = "id";
                          $valor1 = $value["id_area"];
                          $areas = ControladorAreas::ctrMostrarAreas($item1, $valor1);

                          echo '<option value="'.$value["id"].'" id_area="'.$valor1.'">'.$value["nombre"].', '.$areas["nombre"].'</option>';
                        }

                      }
                      else
                      {
                        $personas = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $_SESSION["id"]);
                        $personasN = ControladorPersonas::ctrMostrarPersonas("id_usuario", $_SESSION["id"]);
                        $area = ControladorAreas::ctrMostrarAreas("id", $personas["id_area"]);

                        echo '<option value="'.$_SESSION["id"].'" name="idPersona">'.$personasN["nombre"].', '.$area["nombre"].'</option>';
                      }

                      ?>
                    </select>
                  </div>   
                </div>
              </div>

               <div class="row">
                <div class="col-xs-7">
                  <div class="form-group">
                    <label>*Proyecto Asociado</label>
                    <select class="form-control" name="id_proyecto" id="selecProyecto" required>
                      <?php if($_SESSION["perfil"] != 3){
                        $proyecto = ControladorProyectos::ctrMostrarProyectosPorArea($personas["id_area"]);
                        for ($i=0; $i < count($proyecto); $i++) 
                        { 
                          echo '<option value="'.$proyecto[$i]["id"].'">'.$proyecto[$i]["nombre"].'</option>';
                        }
                      }?>
                    </select>
                  </div>   
                </div>
              </div>

              <?php 

                  if ( $_SESSION["perfil"] == 3 ) 
                  {
                    echo '<div class="row">
                     <div class="col-sm-6 col-lg-6 col-md-6">
                      <p class="help-block">*Fecha de Solicitud y Aprobación</p>           
                      <div class="form-group">
                        <div class="input-group">
                          <input type="date" class="form-control" name="fechaAprobacion" id="fechaAprobacion" value="" />
                        <input type="time" id="horaAprobacion" name="horaAprobacion" class="form-control timepicker" value=""/>
                      </div>              
                    </div>
                  </div>
                </div>';
                  }
                  else
                  {
                    echo '';
                  }
                ?>

                

              <textarea class="form-control" rows="3" name="observacionRq" rows="3" name="observacionRq" placeholder="Observaciones" autocomplete="off" style="resize: none"></textarea>

              <?php

              echo ( $_SESSION["perfil"] == 3 ) ? '<div class="row">
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
              </div>' : '<div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-7" style="padding-right:0px">
                  <p class="help-block">Insumo</p> 
                </div>
                <div class="col-xs-4">
                  <p class="help-block">Solicitado</p> 
                </div>
                <br>
              </div>';

              ?>
              <div class="form-group nuevoInsumoAgregadoRq">
                
                <?php

                   if (isset($requisicion["insumos"]) && !is_null($requisicion["insumos"])) 
                  {
                    $listaInsumos = json_decode($requisicion["insumos"], true);
                    $matchError = "";
                    $jsonInsumos = '[';

                    if(!$listaInsumos == null)
                    {
                      

                      foreach ($listaInsumos as $key => $value) 
                      {

                         $insumo = ControladorInsumos::ctrMostrarInsumos("id", $value["id"]);

                         if ($insumo["stock"] == 0) 
                         {
                          $matchError.= $insumo["descripcion"]." con Codigo ".$insumo["codigo"].", no tiene stock.:";
                         }
                         elseif($insumo["stock"] < $value["ped"]) 
                         {
                           $matchError.= $insumo["descripcion"]." con codigo ".$insumo["codigo"].", tiene menor stock al solicitado.:";
                         }

                         $stock = intval($value["ent"]) + $insumo["stock"];

                          echo ( $_SESSION["perfil"] == 3 ) ? '<div class="row" style="padding:5px 15px"><div class="col-xs-6' : '<div class="row" style="padding:5px 15px">
                            <div class="col-xs-7';

                          echo '" style="padding-right:0px">
                              <div class="input-group">
                                <span class="input-group-addon">

                                <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                              <input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'.$value["id"].'" value="'.$value["des"].'" title="'.$value["des"].'" readonly>
                              </div>
                            </div>';

                            echo ( $_SESSION["perfil"] == 3 ) ? '<div class="col-xs-3' : '<div class="col-xs-4';

                            echo'
                             ingresoCantidad">

                             <input type="number" class="form-control nuevaCantidadPedida" stock="'.$value["ped"].'" name="nuevaCantidadPedida" min="1" value="'.$value["ped"].'" required>';

                             if ($_SESSION["perfil"] == 3) 
                             {
                                  $valorStock = 0;

                                  if($insumo["stock"] < $value["ped"] && $insumo["stock"] != 0) 
                                   {
                                    $valorStock = $insumo["stock"];
                                   }
                                   else
                                   {
                                      if ($value["ped"] <= 0 || $insumo["stock"] == 0) 
                                      {
                                        $valorStock = 0;
                                      }
                                      else
                                      {
                                         $valorStock = $value["ped"];
                                      }
                                   }

                                  
                                  echo '</div>
                                  <div class="col-xs-3 ingresoCantidad">
                                    <input type="number" class="form-control nuevaCantidadEntregada" stock="'.$stock.'" name="nuevaCantidadEntregada" min="0" value="'.$valorStock.'">
                                  </div>
                                </div>';

                                $jsonInsumos.= '{"id":"'.$value["id"].'","des":"'.$value["des"].'","ped":"'.$value["ped"].'","ent":'.$valorStock.'},';


                             }//if ($_SESSION["perfil"] == 3) 
                             else
                             {
                               echo '</div></div>';
                             }
                            
                      }

                      if ($_SESSION["perfil"] == 3) 
                      {
                        $jsonInsumos = substr($jsonInsumos, 0 ,-1);
                         $jsonInsumos.= ']';

                        echo "</div>
                          <input type='hidden' name='listadoInsumosRq' id='listadoInsumosRq' value='".$jsonInsumos."'>";
                      }
                      else
                      {
                        foreach ($listaInsumos as $key => $value) 
                        {
                          $jsonInsumos.= '{"id":"'.$value["id"].'","des":"'.$value["des"].'","ped":"'.$value["ped"].'","ent":0},';
                        }
                         $jsonInsumos = substr($jsonInsumos, 0 ,-1);
                         $jsonInsumos.= ']';

                         echo "</div>
                          <input type='hidden' name='listadoInsumosRq' id='listadoInsumosRq' value='".$jsonInsumos."'>";
                      }

                    }
                  }//si esta definido insumos
                  else
                  {
                    echo '</div>
                          <input type="hidden" name="listadoInsumosRq" id="listadoInsumosRq" value>';
                  }

                ?>
                <br>
                <input type="hidden" name="editarRegistro" value="<?php echo (isset($matchError) )? $matchError : '';?>">

                <a href="javascript:history.back()">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                </a>
                <?php

                  echo ( isset($requisicion["insumos"]) && !is_null($requisicion["insumos"]) ) ? '<button type="submit" style="color: white;" class="btn btn-success pull-right btnGuardarRq">Guardar</button>' : '<button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarRq">Guardar</button>';

                  $anexarRq = new ControladorRequisiciones();
                  $anexarRq -> ctrCrearRequisicion($_SESSION["perfil"]);
                ?>

            </form>
          </div>
        </div>
         <?php 
          if (isset($requisicion['aprobado']) ) 
          {
            if (!empty($matchError)) 
            {
              echo '<div class="col-lg-12 col-md-5 col-sm-12">
                  <div class="box box-warning" style="overflow:scroll; height: 200px">
                      <div class="box-header with-border">
                        Consola de Validación
                      </div>
                      <div class="box-body">
                      <ul class="todo-list ui-sortable">';
              $listado = explode(":", $matchError);

              for ($i=0; $i < count($listado)-1 ; $i++) 
              { 
                 echo '<li><small class="label label-warning">Adv</small><span class="text">'.$listado[$i].'</span></li>';
              }

              echo '</ul></div>
                    </div>
                </div>';
            }
          }
        ?>
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
                  <?php  echo ( $_SESSION["perfil"] == 3 ) ? '<th style="width:10px">#</th>' : '';?>
                 <th style="width:10px">Código</th>
                 <th>Descripción</th>
                 <?php  echo ( $_SESSION["perfil"] == 3 ) ? '<th style="width:20px">Stock</th>' : '';?>
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
