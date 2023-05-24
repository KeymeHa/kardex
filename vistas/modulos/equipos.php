<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

?>


<div class="content-wrapper">
    <?php
    include "bannerConstruccion.php";
  ?>
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
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPC"><i class="fa fa-desktop"></i>
          Ingresar Equipo
        </button>
      </div>
      <div class="box-body">       
      
      </div>
    </div>
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

            <div class="col-md-6 col-lg-4 col-sm-12">

              <div class="form-group">
                <label for="pc_serial">*Serial</label>
                <input type="text" class="form-control" id="pc_serial" placeholder="Ingrese número serie " required autocomplete="off" >
              </div>

              <div class="form-group">
                <label for="pc_serialD">Segundo Serial</label>
                <input type="text" class="form-control" id="pc_serialD" placeholder="número de serio opcional" autocomplete="off">
              </div>

              <div class="form-group">
                <label>*Propietario</label>
                <select class="form-control" required>
                  <?php
                    $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 2);
                    foreach ($paramE as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      # code...
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>*Arquitectura</label>
                <select class="form-control" required>
                  <?php
                    $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 1);
                    foreach ($paramE as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      # code...
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>*Marca Equipo</label>
                <select class="form-control" required>
                  <?php
                    $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 3);
                    foreach ($paramE as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      # code...
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>*Modelo</label>
                <select class="form-control" required>
                  <?php
                    $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 4);
                    foreach ($paramE as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      # code...
                    }
                  ?>
                </select>
              </div>

            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="col-md-6 col-lg-4 col-sm-12">

              <div class="form-group">
                <label>*CPU: Marca</label>
                <select class="form-control" required>
                  <?php
                    $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 5);
                    foreach ($paramE as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      # code...
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>*CPU: Modelo</label>
                <select class="form-control" required>
                  <?php
                    $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 6);
                    foreach ($paramE as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      # code...
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pc_cpufre">*CPU: Frecuencia (Ghz)</label>
                <input type="text" class="form-control" id="pc_cpufre" placeholder="2.5" required>
              </div>

              <div class="form-group">
                <label for="pc_ram">*Capacidad RAM (Gb)</label>
                <input type="number" class="form-control" id="pc_ram" min="4" value="8" placeholder="8" required>
              </div>

              <div class="form-group">
                <label for="pc_ssd">*SSD (Gb)</label>
                <input type="number" class="form-control" id="pc_ssd" min="120" value="250" placeholder="250" required>
              </div>

              <div class="form-group">
                <label for="pc_hdd">HDD (Gb)</label>
                <input type="number" class="form-control" id="pc_hdd" min="120" value="" placeholder="1000">
              </div>

            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="col-md-6 col-lg-4 col-sm-12">
              <div class="form-group">
                <label for="pc_gpumarca">GPU: Marca</label>
                <input type="text" class="form-control" id="pc_gpumarca" placeholder="NVIDIA, AMD">
              </div>

              <div class="form-group">
                <label for="pc_gpumodelo">GPU: Modelo</label>
                <input type="text" class="form-control" id="pc_gpumodelo" placeholder="Gforce, Radeon">
              </div>

              <div class="form-group">
                <label for="pc_gpucap">GPU: Capacidad (Gb)</label>
                <input type="number" class="form-control" id="pc_gpucap" placeholder="2">
              </div>

              <div class="form-group">

                <div class="col-md-6 col-lg-6 col-sm-12">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox">
                    Teclado
                    </label>
                  </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12">
                  <div class="checkbox">
                    <label>
                    <input type="checkbox">
                    Mouse
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label>*Sistema Operativo</label>
                  <select class="form-control" required>
                    <?php
                      $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 7);
                      foreach ($paramE as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        # code...
                      }
                    ?>
                  </select>
                </div>

                  <div class="form-group">
                    <label>*Versión SO</label>
                    <select class="form-control" required>
                      <?php
                        $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 8);
                        foreach ($paramE as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          # code...
                        }
                      ?>
                    </select>
                  </div>

              </div>


            </div><!--col-md-6 col-lg-4 col-sm-12-->

            <div class="col-lg-12 col-md-12 col-sm-12">
              <h4>Ingreso</h4>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Fecha Ingreso:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" required>
                  </div>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>*Acta de Ingreso</label>
                  <select class="form-control" required>
                    <option>18/05/2023</option>
                    <option>20/05/2023</option>
                  </select>
                </div>
              </div><!--col-md-6 col-lg-6 col-sm-12-->

            </div><!--col-lg-12 col-md-12 col-sm-12-->

            <div class="col-lg-12 col-md-12 col-sm-12">

              <h4>Responsabilidad</h4>

              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Responsable</label>
                  <select class="form-control">
                    <option>Perensejo Perez</option>
                  </select>
                </div>
              </div>


              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Asignado a:</label>
                  <select class="form-control">
                    <option>Juancho Rodriguez</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Nota: los campos con el simbolo * , son campos requeridos</label>
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

      </form>
    </div>
  </div>
</div>