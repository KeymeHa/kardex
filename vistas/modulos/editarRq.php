<div class="content-wrapper">
  <?php

  $readonly = ($_SESSION["perfil"] != 3) ? ' readonly ' : '' ;

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

        if (!isset($requisicion["id_persona"])) 
        {
          echo'<script> window.location="requisiciones";</script>';
        }

         echo ($_SESSION["id"] != $requisicion["id_persona"] && $_SESSION["perfil"] != 3) ? '<script> window.location="inicio";</script>' : '';

          echo ($_SESSION["id"] == $requisicion["id_persona"] && ($requisicion["aprobado"] == 0 || $requisicion["aprobado"] == 3)) ? '<script> window.location="noAutorizado";</script>' : '';


      }
    }
    else{

     echo'<script> window.location="requisiciones";</script>';

    }


  ?>
  <section class="content-header">
    <h1>
      Editar Requisición 
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
      <li><a href="requisiciones">Requisiciónes</a></li>
      <li class="active">Nueva Rq</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-5">
        <div class="box <?php if ($requisicion["aprobado"] == 0){ echo 'box-default'; }elseif ($requisicion["aprobado"] == 2){ echo 'box-danger'; }else{ echo 'box-success'; } ?>">
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
                      echo ' <input type="text" class="form-control" required value="'.$requisicion["codigoInt"].'" readonly>
                      <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly>
                       <input type="hidden" id="perEditar" name="perEditar" class="form-control" value="'.$_SESSION["perfil"].'" readonly required>';
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

                        $item = null;
                        $valor = null;
                        $personas = ControladorPersonas::ctrMostrarPersonas($item, $valor);

                        if ($requisicion["gen"] != 1) 
                        {
                          foreach ($personas as $key => $value)
                           { 
                              $item1 = "id";
                              $valor1 = $value["id_area"];
                              $areas = ControladorAreas::ctrMostrarAreas($item1, $valor1);

                              if ($requisicion["id_persona"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].', '.$areas["nombre"].'</option>';
                              }

                            }
                        }
                      ?> 
                    </select>
                  </div>   
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <p class="help-block">*Fecha de Solicitud</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <?php 

                      if ($requisicion["gen"] == 1) 
                      {
                        $fechaSol = ControladorParametros::ctrOrdenFecha($requisicion["fecha_sol"], 3);
                        echo '<input type="text" class="form-control" name="nuevaFechaSolRq" placeholder="dd/mm/AAAA" autocomplete="off" value="'.$fechaSol.'" required readonly>';
                      }
                      else
                      {
                         $fechaSol = ControladorParametros::ctrOrdenFecha($requisicion["fecha_sol"], 6);
                        echo '<input type="date" class="form-control" name="nuevaFechaSolRq" placeholder="dd/mm/AAAA" autocomplete="off" value="'.$fechaSol.'" required />';

                        $fechaSol = ControladorParametros::ctrOrdenFecha($requisicion["fecha_sol"], 5);
                        echo '<input type="time" class="form-control" name="nuevaHoraSolRq" placeholder="08:00 AM" autocomplete="off" value="'.$fechaSol.'" required />';
                      }
                      ?>
                    </div>              
                  </div>
                </div>
              </div><!--row-->

              <?php

                

                if ( $requisicion["aprobado"] == 0 ) 
                {
                  echo ($_SESSION["perfil"] == 3) ? '<div class="row">
                        <div class="col-xs-5">
                          <p class="help-block">*Fecha de Aprobación</p>           
                          <div class="form-group">
                            <div class="input-group">
                               <input type="date" class="form-control" id="fechaAprobacion" name="fechaAprobacion" placeholder="dd/mm/AAAA" autocomplete="off" value="" required'.$readonly.'/>
                               <input type="time" class="form-control" id="horaAprobacion" name="horaAprobacion" placeholder="08:00 AM" autocomplete="off" value required'.$readonly.' />
                            </div>              
                          </div>
                        </div>
                      </div>' : '<i class="fa  fa-calendar-minus-o"></i> Requisición Pendiente de aprobación.<br><br>' ;
                  
                }
                else
                {
                  $textApr = '';
                  if ($requisicion["aprobado"] == 1) 
                  {
                    $textApr = 'Aprobación';
                  }
                  elseif($requisicion["aprobado"] == 2) 
                  {
                     $textApr = 'Anulación';
                  }
                  else
                  {
                    $textApr = 'Aprobación (En espera)';
                  }

                  $fechaApr = ControladorParametros::ctrOrdenFecha($requisicion["fecha"], 6);
                  $horaApr = ControladorParametros::ctrOrdenFecha($requisicion["fecha"], 5);
                  echo '<div class="row">
                        <div class="col-xs-5">
                          <p class="help-block">*Fecha de '.$textApr.'</p>           
                          <div class="form-group">
                            <div class="input-group">
                               <input type="date" class="form-control" name="fechaAprobacion" placeholder="dd/mm/AAAA" autocomplete="off" value="'.$fechaApr.'" required'.$readonly.'/>
                               <input type="time" class="form-control" name="horaAprobacion" placeholder="08:00 AM" autocomplete="off" value="'.$horaApr.'" required'.$readonly.'/>
                            </div>              
                          </div>
                        </div>
                      </div>';
                }
              ?>

                <textarea class="form-control" rows="3" name="observacionRq" rows="3" placeholder="Observaciones de Compras" autocomplete="off" <?php echo($_SESSION["perfil"]!=3) ? 'readonly':'';?> style="resize: none"><?php echo $requisicion["observacion"]; ?></textarea>

               <br>
               <p class="help-block">Observaciones del encargado</p>
               <textarea class="form-control" rows="3" rows="3" placeholder="Observaciones del Encargado" autocomplete="off" style="resize: none" <?php echo($_SESSION["perfil"]==3) ? 'readonly':'';?> ><?php echo $requisicion["observacionE"]; ?></textarea>
              
              
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
                  $matchError = "";

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

                        echo '<div class="row" style="padding:5px 15px">
                          <div class="col-xs-6" style="padding-right:0px">
                            <div class="input-group">
                              <span class="input-group-addon">';
                              if ($requisicion["gen"] == 1 && $requisicion['aprobado'] == 1) 
                              {
                                echo '<button type="button" class="btn btn-success btn-xs genInsumo" idInsumo="'.$value["id"].'"><i class="fa fa-asterisk"></i></button>';
                              }
                              else
                              {
                                if ( $requisicion["gen"] == 1) 
                                {
                                  echo '<button type="button" class="btn btn-success btn-xs genInsumo" idInsumo="'.$value["id"].'"><i class="fa fa-asterisk"></i></button>';
                                }
                                else
                                {
                                  echo '<button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                                }
                                
                              }
                        echo '</span>
                            <input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'.$value["id"].'" value="'.$value["des"].'" title="'.$value["des"].'" readonly>
                            </div>
                          </div>
                          <div class="col-xs-3 ingresoCantidad">';

                           if ($requisicion['gen'] == 1 && $_SESSION["perfil"] != 3) 
                              {
                                echo ' <input type="number" class="form-control nuevaCantidadPedida" stock="'.$value["ped"].'" name="nuevaCantidadPedida" min="1" value="'.$value["ped"].'" required>';
                              }
                              else
                              {
                                echo ' <input type="number" class="form-control nuevaCantidadPedida" stock="'.$value["ped"].'" name="nuevaCantidadPedida" min="1" value="'.$value["ped"].'" required';
                                echo ($requisicion['gen'] == 0) ? '>' : ' readonly>' ;

                               
                              }

                         if($requisicion['aprobado'] == 0)
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
                             echo' </div>
                          <div class="col-xs-3 ingresoCantidad">
                            <input type="number" class="form-control nuevaCantidadEntregada" stock="'.$stock.'" name="nuevaCantidadEntregada" min="0" value="'.$valorStock.'" '.$readonly.'>
                          </div>
                        </div>';
                         }
                         else
                         {

                          $valorStock = 0;

                            if ($_SESSION["perfil"] == 3 && $value["ent"] == 0) 
                            {
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
                            }
                            else
                            {
                                   $valorStock = $value["ent"];
                            }

                           

                              echo' </div>
                          <div class="col-xs-3 ingresoCantidad">
                            <input type="number" class="form-control nuevaCantidadEntregada" stock="'.$stock.'" name="nuevaCantidadEntregada" min="0" value="'.$valorStock.'" '.$readonly.' required>
                          </div>
                        </div>';
                         }
                           
                        
                    }
                  }

                ?>
              </div>

              <input type="hidden" name="listadoInsumosRq" id="listadoInsumosRq" value='<?php echo $requisicion["insumos"]?>'>
              <input type="hidden" name="editarRegistro" value="<?php echo $matchError?>">
              <input type="hidden" name="editarRq" value="<?php echo $requisicion['id']?>">
                <br>

                <button type="button" onclick="history.back()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> <?php if($requisicion['aprobado'] == 2){echo 'Regresar';}else{echo 'Cancelar';}?></button>

                <?php if($requisicion['aprobado'] == 0 && $_SESSION["perfil"] == 3){echo '<button type="submit" style="color: white;" name="btnAnularRq" class="btn btn-warning btnAnularRq"><i class="fa fa-ban"></i> Anular</button> ';}

                  if ($requisicion['aprobado'] != 2) 
                  {
                    echo '<button type="submit" style="color: white;" name="btnGuardarRq"';
                    if($requisicion['aprobado'] == 2){echo 'disabled';} echo 'class="btn btn-success btnGuardarRq"><i class="fa fa-check"></i>';

                    if($requisicion['aprobado'] == 0)
                    { 
                      if($_SESSION["perfil"] == 3)
                        {echo 'Aprobar';}
                        else
                        {echo 'Editar';} 
                    }
                    elseif(($requisicion['aprobado'] == 1))
                    {
                      echo 'Editar';
                    }
                    else
                    { 
                      echo 'Editar';
                    }

                    echo '</button>';
                  }

                  $editarRq = new ControladorRequisiciones();
                  $editarRq -> ctrEditarRequisicion($_SESSION["anioActual"]);
                ?>
            </form>
          </div>
        </div>

        <?php 
          if ($requisicion['aprobado'] == 0) 
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
        <div class="box <?php if ($requisicion["aprobado"] == 0){ echo 'box-default'; }elseif ($requisicion["aprobado"] == 2){ echo 'box-danger'; }else{ echo 'box-success'; } ?>">
          <div class="box-header with-border">
            Seleccionar Insumos
          </div>
          <div class="box-body">
            <?php

              echo ($_SESSION["perfil"] == 3) ? '<table class="table table-bordered table-striped dt-responsive tablaInsumosNRq" width="100%" data-page-length="14">
              <thead>
               <tr>
                <th style="width:10px">#</th>
                 <th style="width:10px">Código</th>
                 <th>Descripción</th>
                 <th style="width:20px">Stock</th>
                 <th style="width:15px">Acciones</th>
               </tr> 
              </thead>
             </table>' : ' <table class="table table-bordered table-striped dt-responsive tablaInsumosNRq" width="100%" data-page-length="14">
              <thead>
               <tr>
                 <th style="width:10px">Código</th>
                 <th>Descripción</th>
                 <th style="width:15px">Acciones</th>
               </tr> 
              </thead>
             </table>';

              ?>
          </div>
        </div><!--box box-success-->
      </div>
    </div><!--div-->
  </section>
</div>

