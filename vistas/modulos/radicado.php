<?php

if ($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 6) 
{
  echo '<script> window.location = "inicio"; </script>';
}

date_default_timezone_set('America/Bogota');
$fechaActual = date("Y-m-d H:i:s");
$fechaCorregida = ControladorParametros::ctrOrdenFecha($fechaActual, 3);

$porcion = explode(" ", $_SESSION["nombre"]);
$recibido = "";

for ($i=0; $i < count($porcion); $i++) 
{ 
  $tam = strlen($porcion[$i]);
  $cortar = (-1*$tam)+1;
  $recibido.= substr($porcion[$i], 0, $cortar);
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Panel de Radicados  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="correspondencia">Correspondencia</a></li>     
      <li class="active">Radicados</li>  
    </ol>
  </section>
  <section class="content">

    <div class="row">
      <div class="col-lg-12">
         <div class="box box-success">
          <div class="box-header with-border">
           <h3 class="box-title">Nuevo Radicado</h3> 
          </div>
          <div class="box-body">     
            <form role="form" method="post" enctype="multipart/form-data">


                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Num. Radicado</label>
                    <?php
                     $val = 28;
                     $parametro = ControladorParametros::ctrMostrarParametros($val);
                      echo ' <input type="text" class="form-control" id="codigoInterno" name="codigoInterno" required value="'.$parametro["codigo"].'" readonly>';
                       echo ' <input type="hidden" class="form-control" name="idUsuario" required value="'.$_SESSION["id"].'" readonly required>';
                    ?>
                  </div><!--form-group-->
                </div><!--col-lg-2 col-md-2 col-xs-2-->

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Fecha Actual</label>
                    <input type="text" class="form-control pull-right" id="datepicker" title="Fecha y Hora Actual" value="<?php echo $fechaCorregida;?>" disabled>
                    <input type="hidden" name="fechaRad" value="<?php echo $fechaActual;?>" required>
                  </div><!--form-group-->
                </div><!--col-lg-2 col-md-2 col-xs-2-->

                <?php

                 $tablasRad = [ ["accion" , "Acción"],
                                ["pqr" , "Tipo PQR"],
                                ["articulo" , "Tipo Articulo"],
                                ["objeto" , "Objeto"] ];

                  for ($i=0; $i < count($tablasRad) ; $i++) 
                  { 

                      $response = ControladorParametros::ctrmostrarRegistros($tablasRad[$i][0], null, null);

                      if (count($response) != 0) 
                      {

                        echo '<div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">'.$tablasRad[$i][1].'</label>
                      <select class="form-control" name="id_'.$tablasRad[$i][0].'" required>
                        <option value="">Seleccione una Opción</option>';

                        foreach ($response as $key => $value) 
                        {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }

                        echo '</select>
                        </div><!--form-group-->
                      </div><!--col-lg-3 col-md-3 col-xs-3-->';

                      }
                  }
                ?>

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Asunto</label>
                    <input type="text" name="asunto" class="form-control pull-right" id="datepicker" title="Digite Asunto" required>
                  </div><!--form-group-->
                </div><!--col-lg-2 col-md-2 col-xs-2-->

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Remitente</label>
                    <div class="col-lg-4 col-md-4 col-xs-4"><button type="button" id="btnRemitente" class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#modalRemitentes"><i class="fa fa-plus"></i></button></div>
                    <div class="col-lg-12"><input type="text" name="remitente" class="form-control pull-right" id="inputRemitente" title="Digite o seleccione un remitente" required>
                    <input type="hidden" name="remitenteID" id="inputRemitenteId" value="0" required></div>
                    
                  </div><!--form-group-->
                </div><!--col-lg-2 col-md-2 col-xs-2-->

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Área</label>
                      <select class="form-control" name="id_area" required>
                        <option value="">Seleccione área</option>
                         <?php

                            $item = null;
                            $valor = null;

                            $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

                            foreach ($areas as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                            ?>
                      </select>
                  </div><!--form-group-->
                </div><!--col-lg-3 col-md-3 col-xs-3-->

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad</label>
                       <input type="number" name="cantidad" class="form-control pull-right" id="datepicker" title="Cantidad de articulos" min="1" value="1" required>
                  </div><!--form-group-->
                </div><!--col-lg-3 col-md-3 col-xs-3-->

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Recibido Por</label>
                       <input type="text" name="recibido" class="form-control pull-right" id="datepicker" title="Cantidad de articulos" value="<?php echo $recibido;?>" required>
                  </div><!--form-group-->
                </div><!--col-lg-3 col-md-3 col-xs-3-->

                <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Observaciones</label>
                       <input type="text" name="observaciones" class="form-control pull-right" id="datepicker" title="Observaciones">
                  </div><!--form-group-->
                </div><!--col-lg-3 col-md-3 col-xs-3-->
          </div><!--box-body-->
          <div class="box-footer">

            <div class="col-lg-2 col-md-2 col-xs-2">
                 <div class="form-group">
                  <label for="exampleInputFile">Soportes en PDF</label>
                    <input type="file" name="soporteRadicado">
                </div><!--form-group-->
              </div><!--col-lg-3 col-md-3 col-xs-3-->

             <button type="submit" style="color: white;" class="btn btn-success btn-lg pull-right"><i class="fa fa-plus"></i>  Radicar</button>
          </div><!--box-footer-->
          <?php

          $radicar = new ControladorRadicados();
          $radicar -> ctrRadicar();

          ?>
           </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
         <div class="box box-success">
          <div class="box-header with-border">
           <h3 class="box-title">Listado de Radicados</h3> 
          </div>
          <div class="box-body">       
             <table class="table table-bordered table-striped dt-responsive tablaRadicados" width="100%">
              <thead>
               <tr>
                 <th style="width:10px">#</th>
                 <th>Fecha</th>
                 <th>Num. Radicado</th>
                 <th>Acción</th>
                 <th>Tipo PQR</th>
                 <th>Objeto</th>
                 <th>Asunto</th>
                 <th>Remitente</th>
                 <th>Área</th>
                 <th>Acciones</th>
               </tr> 
              </thead>
              </table>
          </div>
          <div class="box-footer">
            <button style="color: white;" class="btn btn-success pull-right btn-corte"><i class="fa fa-scissors"></i>  Realizar Corte</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div id="modalRemitentes" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lista de Remitentes</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->   

            <div class="form-group"> 
              <div class="row">
                <div class="col-md-6">      
                  <div class="input-group">          
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg" id="nuevoRemitente" placeholder="Ingresar nombre">
                  </div>
                </div>
              </div>
            </div>

            <div class="row"> 
               <div class="col-md-3">
                <span type="button" id="addRemitente" class="btn btn-block btn-success"><i class="fa fa-plus"></i>Añadir</span>
              </div>
            </div>
           
            <br class="style4">

            <div class="row">
                <h4>Listado de Remitentes</h4>
            </div>

            <div class="row" id="divTablaRem">
              
            </div>

            

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
        </div>

      </form>
    </div>
  </div>
</div>


<?php

  include "modal/modalEditarRadicado.php";

?>