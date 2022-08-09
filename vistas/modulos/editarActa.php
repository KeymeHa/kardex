<?php
    if(isset($_GET["idActa"]) )
    {
      if($_GET["idActa"] == null)
      {
        echo'<script> window.location="actas";</script>';

      }
      else
      {
        $item = "id";
        $valor = $_GET["idActa"];
        $acta = Controladoractas::ctrMostrarActas($item, $valor, $_SESSION["anioActual"]);
        $listaInsumos = json_decode($acta["listainsumos"],true);
      }
    }
    else{

     echo'<script> window.location="actas";</script>';

    }
?>
<div class="content-wrapper">
  <section class="content-header"> 
    <h1>   
      Acta de <?php if($acta["tipo"] == 1){ echo 'Salida';}elseif($acta["tipo"] == 2){ echo 'Entrada';}else{echo 'Asignación';}?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="actas">Actas</a></li>
      <li class="active"><?php echo $acta["codigoInt"];?></li>
    </ol>
  </section>
  <section class="content">
    <form role="form" method="post" class="formularioNuevaActa">
    <div class="row">
      <div class="col-lg-4">
        <div class="box box-success">

          <div class="box-header with-border">
            Datos del acta de <?php if($acta["tipo"] == 1){ echo 'salida';}elseif($acta["tipo"] == 2){ echo 'entrada';}else{echo 'Asignación';}?>.
          </div>

          <div class="box-body">
            
              <div class="row">
                <div class="col-xs-5">
                  <label for="exampleInputEmail1" style="margin-top: 8px">Codigo Interno</label>
                  <div class="form-group">
                    <?php
                      echo '<input type="text" class="form-control" value="'.$acta["codigoInt"].'" readonly>';
                       echo '<input type="hidden" class="form-control" value="'.$_SESSION["id"].'" readonly>';
                    ?>  
                    <input type="hidden" name="edtActa" class="form-control" value="<?php echo $valor;?>" readonly>     
                  </div>
                </div>

                <div class="col-xs-6">
                  <label for="exampleInputEmail1" style="margin-top: 8px">Tipo de Acta</label>
                  <select class="form-control" name="tipoActa">
                    <?php if($acta["tipo"] == 1){ echo '<option value="1">Salida</option>';}elseif($acta["tipo"] == 2){ echo'<option value="2">Entrada</option>';}else{echo '<option value="3">Asignación</option>';}?>
                  </select>

                </div>

              </div>

              <div class="row">
                <div class="col-xs-5">
                  <p class="help-block">Fecha de <?php if($acta["tipo"] == 1){echo 'Salida</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" value="'.$acta["fechaSal"].'" autocomplete="off" readonly disabled>
                    </div>              
                  </div>
                </div>
                <div class="col-xs-5">
                  <p class="help-block">*Fecha de Entrada</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" value="'.$acta["fechaEnt"].'"  name="nuevaFecha" placeholder="dd/mm/AAAA" autocomplete="off" required>
                    </div>              
                  </div>
                </div>';}elseif($acta["tipo"] == 2){echo 'Entrada</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" value="'.$acta["fechaEnt"].'" autocomplete="off" readonly disabled>
                    </div>              
                  </div>
                </div>
                <div class="col-xs-5">
                  <p class="help-block">*Fecha de Salida</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" value="'.$acta["fechaSal"].'"  name="nuevaFecha" placeholder="dd/mm/AAAA" autocomplete="off" required>
                    </div>              
                  </div>
                </div>';}else{echo 'Asignación</p>           
                  <div class="form-group">
                    <div class="input-group">
                      <input type="date" class="form-control" value="'.$acta["fechaEnt"].'" autocomplete="off" readonly disabled>
                    </div>              
                  </div>
                </div>';}?>
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
                      <input type="text" class="form-control input-xs" value="<?php echo $acta['autorizado'] ;?>" name="nuevoAutorizador" placeholder="Autorizado" autocomplete="off" required>
                    </div>
                  </div>
                </div>

                <div class="col-xs-5">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" value="<?php echo $acta['dependencia'] ;?>" name="nuevaDependencia" placeholder="Dependencia" autocomplete="off" required>
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
                      <input type="text" class="form-control input-xs" value="<?php echo $acta['responsable'] ;?>" name="nuevoResponsable" placeholder="Responsable" autocomplete="off" required>
                    </div>
                  </div>
                </div>

                <div class="col-xs-5">
                  <div class="form-group">              
                    <div class="input-group">               
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control input-xs" value="<?php echo $acta['dependenciaR'] ;?>" name="nuevaDependenciaR" placeholder="Dependencia" autocomplete="off" required>
                    </div>
                  </div>
                </div>
              </div><!--row-->

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label>*Motivo de <?php if($acta["tipo"] == 1){ echo 'salida';}elseif($acta["tipo"] == 2){ echo 'entrada';}else{ echo 'Asignación';}?></label>
                    <select class="form-control" name="selecMotivo" required>
                      <?php 
                      $arrayMotivo = array( 1 => array( 1 => "Prestamo"), 2 => array( 2 => "Entrega"), 3 => array( 3 => "Devolución"), 4 => array( 4 => "Manto. o Reparación"), 5 => array( 5 => "Traslado"));
                        echo '<option value="'.$acta["motivo"].'">'.$arrayMotivo[$acta["motivo"]][$acta["motivo"]].'</option>';
                        for ($i=1; $i < 6; $i++) 
                        { 
                          if ( $i != $acta["motivo"] ) 
                          {
                            echo '<option value="'.$i.'">'.$arrayMotivo[$i][$i].'</option>';
                          }
                        }
                      ?>
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
              <button type="submit" disabled style="color: white;" class="btn btn-default pull-right btnGuardarACT">Editar</button>
            
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
              <?php

              

              if(!$listaInsumos == null)
              {
                foreach ($listaInsumos as $key => $value) 
                {
                  echo'<div class="row" style="padding:5px 15px">
                    <div class="col-xs-3" style="padding-right:0px">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <button type="button" class="btn btn-danger btn-xs quitarBN" title="Eliminar Esta Fila"><i class="fa fa-times"></i></button>
                        </span>
                      <input type="text" class="form-control newSerial" value="'.$value["sn"].'" placeholder="XGFR456">
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <input type="text" class="form-control newMarca" value="'.$value["mc"].'"  autocomplete="off"required placeholder="Marca">
                    </div>
                    <div class="col-xs-3">
                      <input type="text" class="form-control newDes" value="'.$value["des"].'" autocomplete="off" required placeholder="Computador">
                    </div>
                    <div class="col-xs-2" style="padding-left:0px">
                      <div class="input-group">
                        <input type="number" class="form-control newCan" value="'.$value["can"].'"  min="1" value="1" autocomplete="off" required placeholder="2">
                      </div>
                    </div>
                    <div class="col-xs-2" style="padding-left:0px">
                      <div class="input-group">
                        <input type="text" class="form-control newOb" value="'.$value["obs"].'" autocomplete="off" placeholder="Opcional">
                      </div>
                    </div>
                  </div>';
                }
              }
              ?>
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
        $editarActa = new ControladorActas();
        $editarActa -> ctrEditarActa();
      ?>
    </form>
  </section>
</div>