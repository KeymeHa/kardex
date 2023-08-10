<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Base Datos PC  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Base de Datos PC</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success btn-newEquipo" data-toggle="modal" data-target="#modalAgregarPC"><i class="fa fa-desktop"></i>
          Ingresar Equipo
        </button>
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPCS"><i class="fa fa-desktop"></i>
          Ingreso Masivo
        </button>
      </div>
      <div class="box-body">       
        <table class="table table-bordered table-striped dt-responsive tablaEquipos" width="100%">
          <thead>
           <tr>
             <th style="width:10px">#</th>
             <th>PC</th>
             <th>Serial</th>
             <th>Arquitectura</th>
             <th>Propiedad</th>
             <th>Asignado a</th>
             <th>Área</th>
             <th>Acciones</th>
           </tr> 
          </thead>
        </table> 
      </div>
    </div>

    <?php

    include("reportes/equiposArea.php");
    include("reportes/equiposArquitectura.php");

    ?>

  </section>
</div>



<!--VENTANAS MODALES-->
<div id="modalAgregarPC" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Equipo</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="divAlertError">
              
            </div>

            <div class="col-md-6 col-lg-4 col-sm-12">

              <div class="form-group">
                <label for="pc_serial">*Serial</label>
                <input type="text" class="form-control" id="pc_serial" placeholder="Ingrese número serie" required autocomplete="off" name="inputSerialE">
                 <input type="hidden" required readonly name="inputEquipoAccion" id="inputEquipoAccion" value="0">
              </div>

              <div class="form-group">
                <label for="pc_serialD">Segundo Serial</label>
                <input type="text" class="form-control" id="pc_serialD" placeholder="número de serio opcional" autocomplete="off" name="inputSerialDE">
              </div>

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Propietario</label>

                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success btn-addParam" param="2">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>

                    <select class="form-control" required name="selectIdProE">
                      <?php
                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 2, null);
                        foreach ($paramE as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          # code...
                        }
                      ?>
                    </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Arquitectura</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="1"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control" required name="selectIdArqE">
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 1, null);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Marca Equipo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="3"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control" required name="selectIdMarcaE">
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 3, null);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Modelo</label>

                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success btn-addParam" param="4"><i class="fa fa-plus"></i></button>
                    </div>

                    <select class="form-control" required name="selectIdModeloE">
                      <?php
                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 4, null);
                        foreach ($paramE as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          # code...
                        }
                      ?>
                    </select>
                  </div>



               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->


            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="col-md-6 col-lg-4 col-sm-12">


<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*CPU: Marca</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="5"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control" required name="selectIdCPUE">
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 5, null);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*CPU: Modelo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="6"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control" required name="selectIdCPUModE">
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 6, null);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

              <div class="form-group">
                <label>*CPU: Generación</label>
                <select class="form-control" required name="selectIdCPUGenE">
                  <?php
                    for($i = 14 ; $i >= 4 ; $i--)
                    {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pc_cpufre">*CPU: Frecuencia (Ghz)</label>
                <input type="text" class="form-control" id="pc_cpufre" placeholder="2.5" value="0" name="inputCPUFreE">
              </div>

              <div class="form-group">
                <label for="pc_ram">*Capacidad RAM (Gb)</label>
                <input type="number" class="form-control" id="pc_ram" min="4" value="8" placeholder="8" required name="inputRamE">
              </div>

              <div class="form-group">
                <label for="pc_ssd">*SSD (Gb)</label>
                <input type="number" class="form-control" id="pc_ssd" min="120" value="250" placeholder="250" required name="inputSSDE">
              </div>


            </div><!--col-md-6 col-lg-4 col-sm-12-->

<!------------------------------------------------------------------------------------------------->

            <div class="col-md-6 col-lg-4 col-sm-12">
              
              <div class="form-group">
                <label for="pc_hdd">HDD (Gb)</label>
                <input type="number" class="form-control" id="pc_hdd" min="120" value="" placeholder="1000" name="inputHDDE">
              </div>

              <div class="form-group">
                <label for="pc_gpumarca">GPU: Marca</label>
                <input type="text" class="form-control" id="pc_gpumarca" placeholder="NVIDIA, AMD" name="inputGPUE">
              </div>

              <div class="form-group">
                <label for="pc_gpumodelo">GPU: Modelo</label>
                <input type="text" class="form-control" id="pc_gpumodelo" placeholder="Gforce, Radeon" name="inputGPUModE">
              </div>

              <div class="form-group">
                <label for="pc_gpucap">GPU: Capacidad (Gb)</label>
                <input type="number" class="form-control" id="pc_gpucap" placeholder="2" name="inputGPUCapE">
              </div>

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Sistema Operativo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="7"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control" required name="selectSOE">
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 7, null);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->


              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Versión SO</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="8"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control" required name="selectSOVerE">
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 8, null);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->
            
            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="form-group">

                <div class="col-md-3 col-lg-2 col-sm-6">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" name="checkTecladoE">
                    Teclado
                    </label>
                  </div>
                </div>

                <div class="col-md-3 col-lg-2 col-sm-6">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" name="checkMouseE">
                    Mouse
                    </label>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Ingreso</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Fecha Ingreso:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control" name="dateIngresoE" id="dateIngresoE" value="" />
                  </div>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Acta de Ingreso</label>
                  <select class="form-control" required name="selectIdActaE">
                    <?php

                    $actasIngreso = ControladorEquipos::ctrMostrarActasDis();
                    foreach ($actasIngreso as $key => $value) 
                    {
                      echo '<option value="'.$value["id"].'">'.$value["codigo"].' / '.$value["fecha"].' PC '.$value["cantidadUso"].'/'.$value["cantidad"].' </option>';
                    }
                    ?>
                  </select>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

            </div><!--col-lg-12 col-md-12 col-sm-12-->

            <div class="row">


              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Responsabilidad</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
             
             
                <div class="form-group">
                  <label>Responsable</label>
                  <select class="form-control" name="selectResponsableE">
                    <option value="0">Seleccione Responsable</option>
                    <?php
                    $responsable = ControladorPersonas::ctrMostrarPersonas("sw", 1);
                    foreach ($responsable as $key => $value) :
                      $areaR = ControladorAreas::ctrMostrarAreas("id", $value["id_area"]);
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].' - '.$areaR["nombre"].'</option>';
                    endforeach;
                    ?>
                  </select>
                </div>
              </div>


              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Asignado a:</label>
                  <select class="form-control" name="selectAsignadoE">
                    <option value="0">Seleccione Asignado</option>
                    <?php

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

                    foreach ($usuarios as $key => $value) 
                    {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    }

                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Rol</label>
                  <select class="form-control" name="selectRolE">
                    <option value="0">Contratista</option>
                    <option value="1">Empleado</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Proyecto:</label>
                  <select class="form-control" name="selectProyectoE">
                    <?php

                    $proyectos = ControladorProyectos::ctrMostrarProyectos(null, null);

                    foreach ($proyectos as $key => $value) 
                    {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    }

                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Licencia</label>
                  <select class="form-control" name="selectLicenciaE">
                    <option value="">Sin Asignar</option>
                    <?php

                    $licencias = ControladorEquipos::ctrMostrarLicenciaDis();
                    foreach ($licencias as $key => $value) 
                    {
                      echo '<option value="'.$value["id"].'">'.$value["usuario"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

            </div><!--row-->



            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="textObservacionesE"></textarea>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Nota: los campos con el simbolo * son campos requeridos</label>
              </div>
            </div>            


          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Ingresar</button>
        </div>

        <?php

        $accionEquipo = new ControladorEquipos();
        $accionEquipo -> ctrAccionEquipo($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>