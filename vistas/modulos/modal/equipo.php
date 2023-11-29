<!--VENTANAS MODALES-->
<div id="modalEquipo" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title titulo-modal">Nuevo Equipo</h4>
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
                 <input type="hidden" required readonly name="inputEquipoAccion" id="inputEquipoAccion" value="0" readonly="false">
              </div>

              <div class="form-group">
                <label for="pc_serialD">Segundo Serial</label>
                <input type="text" class="form-control inputSerialDE" id="pc_serialD" placeholder="número de serie opcional" id="inputSerialDE" autocomplete="off" name="inputSerialDE">
              </div>


              <div class="form-group">
                <label for="pc_nombreE">*Nombre PC</label>
                <input type="text" class="form-control" id="pc_nombreE" placeholder="EDU-000" autocomplete="off" name="inputNombreE">
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

                    <select class="form-control selectIdProE" id="selectIdProE" required name="selectIdProE">
                      <?php

                        if (isset($temporalData[0]["selectIdProE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectIdProE"], 1);
                         echo '<option value="'.$temporalData[0]["selectIdProE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 2, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectIdProE"])) 
                            {
                              if ($temporalData[0]["selectIdProE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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

                  <select class="form-control selectIdArqE" id="selectIdArqE" required name="selectIdArqE">
                    <?php
                      if (isset($temporalData[0]["selectIdArqE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectIdArqE"], 1);
                         echo '<option value="'.$temporalData[0]["selectIdArqE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 1, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectIdArqE"])) 
                            {
                              if ($temporalData[0]["selectIdArqE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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

                  <select class="form-control selectIdMarcaE" id="selectIdMarcaE" required name="selectIdMarcaE">
                    <?php
                      if (isset($temporalData[0]["selectIdMarcaE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectIdMarcaE"], 1);
                         echo '<option value="'.$temporalData[0]["selectIdMarcaE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 3, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectIdMarcaE"])) 
                            {
                              if ($temporalData[0]["selectIdMarcaE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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

                    <select class="form-control selectIdModeloE" id="selectIdModeloE" required name="selectIdModeloE">
                      <?php
                        if (isset($temporalData[0]["selectIdModeloE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectIdModeloE"], 1);
                         echo '<option value="'.$temporalData[0]["selectIdModeloE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 4, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectIdModeloE"])) 
                            {
                              if ($temporalData[0]["selectIdModeloE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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

                  <select class="form-control selectIdCPUE" id="selectIdCPUE" required name="selectIdCPUE">
                    <?php
                      if (isset($temporalData[0]["selectIdCPUE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectIdCPUE"], 1);
                         echo '<option value="'.$temporalData[0]["selectIdCPUE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 5, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectIdCPUE"])) 
                            {
                              if ($temporalData[0]["selectIdCPUE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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

                  <select class="form-control selectIdCPUModE" id="selectIdCPUModE" required name="selectIdCPUModE">
                    <?php
                      if (isset($temporalData[0]["selectIdCPUModE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectIdCPUModE"], 1);
                         echo '<option value="'.$temporalData[0]["selectIdCPUModE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 6, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectIdCPUModE"])) 
                            {
                              if ($temporalData[0]["selectIdCPUModE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
                          # code...
                        }

                    ?>
                  </select>
                  </div>

               <div class="div-add"></div>

              </div><!--form-group--><!--btn-addParam-->

              <div class="form-group">
                <label>*CPU: Generación</label>
                <select class="form-control selectIdCPUGenE" id="selectIdCPUGenE" required name="selectIdCPUGenE">
                  <?php
                    for($i = 11 ; $i >= 4 ; $i--)
                    {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pc_cpufre">*CPU: Frecuencia (Ghz)</label>
                <input type="text" class="form-control pc_cpufre" id="pc_cpufre" placeholder="2.5" value="0" name="inputCPUFreE">
              </div>

              <div class="form-group">
                <label for="pc_ram">*Capacidad RAM (Gb)</label>
                <input type="number" class="form-control inputRamE" id="pc_ram" min="4" value="8" placeholder="8" required name="inputRamE">
              </div>

              <div class="form-group">
                <label for="pc_ssd">*SSD (Gb)</label>
                <input type="number" class="form-control inputSSDE" id="pc_ssd" min="0" value="250" placeholder="250" required name="inputSSDE">
              </div>


            </div><!--col-md-6 col-lg-4 col-sm-12-->

<!------------------------------------------------------------------------------------------------->

            <div class="col-md-6 col-lg-4 col-sm-12">
              
              <div class="form-group">
                <label for="pc_hdd">HDD (Gb)</label>
                <input type="number" class="form-control inputHDDE" id="pc_hdd" min="0" value="" placeholder="1000" name="inputHDDE">
              </div>

              <div class="form-group">
                <label for="pc_gpumarca">GPU: Marca</label>
                <input type="text" class="form-control inputGPUE" id="pc_gpumarca" placeholder="NVIDIA, AMD" name="inputGPUE">
              </div>

              <div class="form-group">
                <label for="pc_gpumodelo">GPU: Modelo</label>
                <input type="text" class="form-control inputGPUModE" id="pc_gpumodelo" placeholder="Gforce, Radeon" name="inputGPUModE">
              </div>

              <div class="form-group">
                <label for="pc_gpucap">GPU: Capacidad (Gb)</label>
                <input type="number" class="form-control inputGPUCapE" id="pc_gpucap" placeholder="2" name="inputGPUCapE">
              </div>

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="exampleInputEmail1">*Sistema Operativo</label>

                  <div class="input-group">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-success btn-addParam" param="7"><i class="fa fa-plus"></i></button>
                  </div>

                  <select class="form-control selectSOE" id="selectSOE" required name="selectSOE">
                    <?php

                      if (isset($temporalData[0]["selectSOE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectSOE"], 1);
                         echo '<option value="'.$temporalData[0]["selectSOE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 7, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectSOE"])) 
                            {
                              if ($temporalData[0]["selectSOE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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

                  <select class="form-control selectSOVerE" id="selectSOVerE" required name="selectSOVerE">
                    <?php
                      if (isset($temporalData[0]["selectSOVerE"])) 
                        {
                          $nomParam = ControladorEquipos::ctrMostrarParametrosNombre("id", $temporalData[0]["selectSOVerE"], 1);
                         echo '<option value="'.$temporalData[0]["selectSOVerE"].'">'.$nomParam.'</option>';
                        }

                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 8, null);
                        foreach ($paramE as $key => $value) {

                           if (isset($temporalData[0]["selectSOVerE"])) 
                            {
                              if ($temporalData[0]["selectSOVerE"] != $value["id"]) 
                              {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
                            }
                            else
                            {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }

                          
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
                    <input type="checkbox" class="checkTecladoE" name="checkTecladoE">
                    Teclado
                    </label>
                  </div>
                </div>

                <div class="col-md-3 col-lg-2 col-sm-6">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" class="checkMouseE" name="checkMouseE">
                    Mouse
                    </label>
                  </div>
                </div>
              </div>

            <div class="row">

                 <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Acta de Ingreso</label>
                  <select class="form-control selectIdActaE" id="selectIdActaE" required name="selectIdActaE">
                    <?php

                     $actasIngreso = ControladorEquipos::ctrMostrarActasDis();

                    if (count($actasIngreso) > 0 && isset($actasIngreso[0]["codigo"])) 
                    {

                      echo '<option value="0">Seleccione una opción</option>';

                       foreach ($actasIngreso as $key => $value) 
                      {
                        echo '<option value="'.$value["id"].'">'.$value["codigo"].' / '.$value["fecha"].' PC '.$value["cantidadUso"].'/'.$value["cantidad"].' </option>';
                      }
                    }
                    else
                    {
                      echo '<option value="0">No hay actas disponibles</option>';
                    }

                   
                    ?>
                  </select>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->



              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Responsabilidad</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
             
             
                <div class="form-group">
                  <label>Responsable</label>
                  <select class="form-control selectResponsableE" id="selectResponsableE" name="selectResponsableE">
                    <option value="0">Seleccione Responsable</option>
                    <?php
                    echo '<option value="0">Seleccione una opción</option>';
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
                  <select class="form-control selectAsignadoE" id="selectAsignadoE" name="selectAsignadoE">
                    <option value="0">Seleccione Asignado</option>
                    <?php

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

                      echo '<option value="0">Seleccione una opción</option>';

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
                  <select class="form-control selectRolE" id="selectRolE" name="selectRolE">
                    <option value="0">Contratista</option>
                    <option value="1">Empleado</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Proyecto:</label>
                  <select class="form-control selectProyectoE" id="selectProyectoE" name="selectProyectoE">
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
                  <select class="form-control selectLicenciaE" id="selectLicenciaE" name="selectLicenciaE">
                    <option value="">Sin Asignar o Propia</option>
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
                <textarea class="form-control textObservacionesE" rows="3" placeholder="Enter ..." name="textObservacionesE"></textarea>
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
          <button type="submit" class="btn btn-success btn-modal">Ingresar</button>
        </div>

        <?php

        $accionEquipo = new ControladorEquipos();
        $accionEquipo -> ctrAccionEquipo($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>
