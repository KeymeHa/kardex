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

                  <label for="selectIdProE">*Propietario</label>

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

                  <label for="selectIdArqE">*Arquitectura</label>

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

                  <label for="selectIdMarcaE">*Marca Equipo</label>

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

                  <label for="selectIdModeloE">*Modelo</label>

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

                  <label for="selectIdCPUE">*CPU: Marca</label>

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

                  <label for="selectIdCPUModE">*CPU: Modelo</label>

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
                <label for="selectIdCPUGenE">*CPU: Generación</label>
                <select class="form-control selectIdCPUGenE" id="selectIdCPUGenE" required name="selectIdCPUGenE">

                  <option value="0">No definido</option>
                  <?php
                    for($i = 15 ; $i >= 4 ; $i--)
                    {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pc_cpufre">*CPU: Frecuencia (Ghz)</label>
                <?php

                if (isset($temporalData[0]["inputCPUFreE"]) && intval($temporalData[0]["inputCPUFreE"]) ) 
                {
                 echo '<input type="text" class="form-control pc_cpufre" id="pc_cpufre" placeholder="2.5" value="'.$temporalData[0]["inputCPUFreE"].'" name="inputCPUFreE">';
                }
                else{
                  echo '<input type="text" class="form-control pc_cpufre" id="pc_cpufre" placeholder="2.5" value="0" name="inputCPUFreE">';
                }
                ?>

                
              </div>

              <div class="form-group">
                <label for="pc_ram">*Capacidad RAM (Gb)</label>
                <?php

                if (isset($temporalData[0]["inputRamE"]) && intval($temporalData[0]["inputRamE"]) ) 
                {
                 echo '<input type="number" class="form-control inputRamE" id="pc_ram" min="4" value="'.$temporalData[0]["inputRamE"].'" placeholder="8" required name="inputRamE">';
                }
                else{
                  echo '<input type="number" class="form-control inputRamE" id="pc_ram" min="4" value="8" placeholder="8" required name="inputRamE">';
                }
                ?>
              </div>

              <div class="form-group">
                <label for="pc_ssd">*SSD (Gb)</label>
                <?php

                if (isset($temporalData[0]["inputSSDE"]) && intval($temporalData[0]["inputSSDE"]) ) 
                {
                 echo '<input type="number" class="form-control inputSSDE" id="pc_ssd" min="0" value="'.$temporalData[0]["inputSSDE"].'" placeholder="250" required name="inputSSDE">';
                }
                else{
                  echo '<input type="number" class="form-control inputSSDE" id="pc_ssd" min="0" value="250" placeholder="250" required name="inputSSDE">';
                }
                ?>
              </div>


            </div><!--col-md-6 col-lg-4 col-sm-12-->

<!------------------------------------------------------------------------------------------------->

            <div class="col-md-6 col-lg-4 col-sm-12">
              
              <div class="form-group">
                <label for="pc_hdd">HDD (Gb)</label>
                
                <?php

                if (isset($temporalData[0]["inputHDDE"]) && intval($temporalData[0]["inputHDDE"]) ) 
                {
                 echo '<input type="number" class="form-control inputHDDE" id="pc_hdd" min="0" value="'.$temporalData[0]["inputHDDE"].'" placeholder="1000" name="inputHDDE">';
                }
                else{
                  echo '<input type="number" class="form-control inputHDDE" id="pc_hdd" min="0" value="" placeholder="1000" name="inputHDDE">';
                }
                ?>
              </div>

              <div class="form-group">
                <label for="pc_gpumarca">GPU: Marca</label>
                <?php

                if (isset($temporalData[0]["inputGPUE"]) ) 
                {
                 echo '<input type="text" class="form-control inputGPUE" id="pc_gpumarca" placeholder="NVIDIA, AMD" name="inputGPUE" value="'.$temporalData[0]["inputGPUE"].'">';
                }
                else{
                  echo '<input type="text" class="form-control inputGPUE" id="pc_gpumarca" placeholder="NVIDIA, AMD" name="inputGPUE">';
                }
                ?>
                
              </div>

              <div class="form-group">
                <label for="pc_gpumodelo">GPU: Modelo</label>
                
                <?php

                if (isset($temporalData[0]["inputGPUModE"]) ) 
                {
                 echo '<input type="text" class="form-control inputGPUModE" id="pc_gpumodelo" placeholder="Gforce, Radeon" name="inputGPUModE" value="'.$temporalData[0]["inputGPUModE"].'">';
                }
                else{
                  echo '<input type="text" class="form-control inputGPUModE" id="pc_gpumodelo" placeholder="Gforce, Radeon" name="inputGPUModE">';
                }
                ?>
              </div>

              <div class="form-group">
                <label for="pc_gpucap">GPU: Capacidad (Gb)</label>
                <?php

                if (isset($temporalData[0]["inputGPUCapE"]) && intval($temporalData[0]["inputGPUCapE"]) ) 
                {
                 echo '<input type="number" class="form-control inputGPUCapE" id="pc_gpucap" placeholder="2" name="inputGPUCapE" value="'.$temporalData[0]["inputGPUCapE"].'">';
                }
                else{
                  echo '<input type="number" class="form-control inputGPUCapE" id="pc_gpucap" placeholder="2" name="inputGPUCapE">';
                }
                ?>
                
              </div>

<!------------------------------------------------------------------------------------------------->

              <div class="form-group"><!--btn-addParam-->

                  <label for="selectSOE">*Sistema Operativo</label>

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

                  <label for="selectSOVerE">*Versión SO</label>

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
                    <label for="checkTecladoE">
                    <input type="checkbox" id="checkTecladoE" class="checkTecladoE" name="checkTecladoE">
                    Teclado
                    </label>
                  </div>
                </div>

                <div class="col-md-3 col-lg-2 col-sm-6">
                  <div class="checkbox">
                    <label for="checkMouseE">
                    <input type="checkbox" id="checkMouseE" class="checkMouseE" name="checkMouseE">
                    Mouse
                    </label>
                  </div>
                </div>
              </div>

            <div class="row">

              <div class="col-md-12 col-lg-12 col-sm-12">
                <h4>Responsabilidad</h4>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label for="selectAsignadoE">Asignado a:</label>
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
                  <label for="selectRolE">Rol</label>
                  <select class="form-control selectRolE" id="selectRolE" name="selectRolE">
                    <option value="0">Contratista</option>
                    <option value="1">Empleado</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label for="selectProyectoE">Proyecto:</label>
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
                  <label for="selectLicenciaE">Licencia</label>
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

            <div class="col-md-6 col-lg-6 col-sm-12">
              <div class="form-group">
                <label for="selectIdActaE">*Acta de Ingreso</label>
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

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label for="textObservacionesE">Observaciones</label>
                <textarea class="form-control textObservacionesE" id="textObservacionesE" rows="3" placeholder="Enter ..." name="textObservacionesE"></textarea>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <p>Nota: los campos con el simbolo * son campos requeridos</p>
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
