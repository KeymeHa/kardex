<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Lista de Categorias
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Inventario</a></li>
      <li class="active">Categorias</li>
    </ol>

  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCategoria"><i class="fa fa-plus"></i>
          Agregar Categoria
        </button>

         <button class="btn btn-success" data-toggle="modal" data-target="#modalMigrarInsumos"><i class="fa fa-circle-o-notch"></i>
          Migrar
        </button>

        <?php

          $canCategorias = ControladorCategorias::ctrContarCategorias(null, null);

          if ($canCategorias != 0) 
          {
            echo '<a href="vistas/modulos/reportes/excelReport.php?r=r"><button class="btn btn-success"><i class="fa  fa-download"></i>
            Exportar</button></a>';
          }


        ?>
        
      </div>

      <div class="box-body">   
       <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%" data-page-length='25'>
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Categoria</th>
           <th>Descripción</th>
           <th>Cantidad Insumos</th>
           <th>Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>

    <?php

    include "reportes/categoriaGrafica.php";

    ?>

  </section>
</div>


<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear Categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE LA CATEGORIA-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar Categoria" id="nuevaCategoria" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRICPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripción" id="nuevaDescripcion">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar Categoria</button>

        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE LA CATEGORIA-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>
                <input type="hidden" class="form-control input-lg" name="editarIdCategoria" id="editarIdCategoria" required value="">

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRICPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Modificar</button>

        </div>

        <?php

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--    MIGRAR INSUMOS A OTRA CATEGORIA -->

<div id="modalMigrarInsumos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Migrar Categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE LA CATEGORIA-->


            <div class="form-group">
              
              <div class="input-group">
              
          
                <h4>Una Vez migrada los insumos a otra categoria, no se puede revertir la acción.</h4>
              </div>

            </div>
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                 <select class="form-control input-lg" id="categoriaOrigen" name="categoriaOrigen" required>

                    <option>Categoria Origen</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    foreach ($categorias as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                    }
                    ?>
                  </select>
              </div>

            </div>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <select class="form-control input-lg" id="categoriaDestino" name="categoriaDestino" required> 

                      <option value="0">Categoria Destino</option>        
                      <?php
                      $item = null;
                      $valor = null;
                      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                      foreach ($categorias as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                      }
                      ?>       
                  </select>

              </div>

            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Migrar</button>

        </div>

        <?php

          $migrarCat = new ControladorCategorias();
          $migrarCat -> ctrMigrarCategoria();

        ?>

      </form>

    </div>

  </div>

</div>


<?php
  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria($_SESSION["id"]);

  $expCategorias = new ControladorCategorias();
  $expCategorias -> ctrExportarCategorias();
?>

