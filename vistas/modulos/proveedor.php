<?php

  if(isset($_GET["idProv"]) )
  {
    if($_GET["idProv"] == null)
    {
      echo'<script> window.location="proveedores";</script>';

    }
    else
    {
      $item = "id";
      $valor = $_GET["idProv"];
      $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);     
    }
  }
  else{

   echo'<script> window.location="proveedores";</script>';

  }

?>

<div class="content-wrapper">
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
    Este Modulo se encuentra en Construcción.
  </div>

  <section class="content-header">
    
    <h1>
      
      Proveedor: <b><?php echo $proveedores["razonSocial"];?></b>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="proveedores"> Proveedores</a></li>
      
      <li class="active"><?php echo $proveedores["razonSocial"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      <div class="col-md-6">
        <div class="box">

          <div class="box-header with-border">

            <a href="proveedores">
              <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
                Regresar
              </button>
            </a>

          </div>

          <div class="box-body">
            <div class="col-md-8">
              <dl class="dl-horizontal">
                <dt>Nombre Comercial: </dt>
                <dd><?php echo $proveedores["nombreComercial"];?></dd>
                <dt>Razón Social: </dt>
                <dd><?php echo $proveedores["razonSocial"];?></dd>
                <dt>Nit: </dt>
                <dd><?php echo $proveedores["nit"]." - ".$proveedores["digitoNit"];?></dd>
                <dt>Descripción:</dt>
                <dd><?php echo $proveedores["descripcion"];?></dd>
                <dt>Contacto:</dt>
                <dd><?php echo $proveedores["contacto"];?></dd>
                <dt>Telefono:</dt>
                <dd><?php echo $proveedores["telefono"];?></dd>
                <dt>Dirección:</dt>
                <dd><?php echo $proveedores["direccion"];?></dd>
              </dl>
            </div>

            <div class="col-md-4"> 
              <div class="btn-group">
                <button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#modalEditarProveedor" title="Editar Proveedor" idProv='<?php echo $proveedores["id"];?>'><i class="fa fa-pencil"></i>
                </button>
              </div>
            </div>        
          </div><!---->

        </div>

        <div class="box">

          <div class="box-header with-border">

            <div class="btn-group">
              <button type="button" class="btn btn-success btn-xs" title="Ver Contenido" data-toggle="modal" data-target="#modalCrearCarpeta"><i class="fa fa-folder"> </i> Crear Carpeta</button>
            </div>

          </div>

          <div class="box-body">

             <table class="table table-bordered table-striped dt-responsive tablas" width="100%" >
                 
                <thead>
                 
                 <tr>
                   
                   <th style="width:10px">#</th>
                   <th>Carpeta</th>
                   <th>Archivos</th>
                   <th>Fecha</th>
                   <th style="width: 130px">Acciones</th>

                 </tr> 

                </thead>

                <tbody> 

                    <?php
                    $item2 = "id_prov";
                    $carpetas = ControladorAnexos::ctrMostrarCarpetas($item2, $valor);

                    $itemC = "id_carpeta";
                    $itemCP = "id_proveedor";

                    $cCarpeta = 0;

                   foreach ($carpetas as $key => $value){

                      $cantidadArchivos = (ControladorAnexos::ctrMostrarCantidadArchivos($itemC, $value["id"],$itemCP,$valor));
                     
                      echo ' <tr>
                                <td>'.($key+1).'</td>
                                <td>'.$value["nombre"].'</td>
                                <td>'.$cantidadArchivos[0].'</td>
                                <td>'.$value["fecha"].'</td>
                                <td>
                                  <div class="btn-group">
                                    <button class="btn btn-success btnVerArchivos" title="Ver Archivos" id_carpeta="'.$value["id"].'" nombre_carpeta="'.$value["nombre"].'"><i class="fa fa-folder"></i></button>
                                    <button class="btn btn-warning" title="Editar"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger" title="Eliminar"><i class="fa fa-trash"></i></button>
                                  </div>
                                </td>
                              </tr>';
                              $cCarpeta++;
                        }
                      ?> 
                </tbody>

               </table>                 
                          
          </div><!---->

        </div>
        
      </div>

       <div class="col-md-6">

          <div class="box">

              <div class="box-header">

                  <div class="row">
                    <div class="col-md-9">
                      <h3 class="box-title">Carpeta: <b id="carpetaElegida"></b></h3>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-success btn-xs" title="Agregar Archivo" data-toggle="modal" data-target="#modalAgregarArchivo"><i class="fa fa-plus"></i> Añadir Archivo</button>
                    </div>
                  </div>
              </div>

              <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                     
                    <thead>
                     
                     <tr>
                       
                       <th style="width:10px">#</th>
                       <th>Nombre</th>
                       <th>Fecha</th>
                       <th style="width:100px">Acciones</th>

                     </tr> 

                    </thead>

                    <tbody id="TablaArchivos">

                    </tbody>

                   </table>

                
              </div><!---->

        </div>
        
      </div>
    </div>

  </section>

</div>


<?php 

include "modalEditarProveedor.php";

?>

  <div id="modalCrearCarpeta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Nueva Carpeta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-folder"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCarpeta" placeholder="Nombre Carpeta" autocomplete="off" required>

                <input type="hidden" class="form-control input-lg" name="contadorC" value='<?php echo $cCarpeta;?>'>

              </div>

            </div>

          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Crear Carpeta</button>

        </div>

        <?php

          $crearCarpeta = new ControladorAnexos();
          $crearCarpeta -> ctrCrearCarpeta();

        ?>

      </form>

    </div>

  </div>

</div>



  <div id="modalAgregarArchivo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Adjuntar Archivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-folder"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreArchivo" placeholder="Nombre archivo" autocomplete="off" required>

                <input type="hidden" class="form-control input-lg" name="idProveedor" value='<?php echo $proveedores["id"];?>'>
                <!--
                      <input type="text" class="form-control input-lg id_carpetaElegida" id_carpetaElegida="" name="contadorC" value='<?php echo $cCarpeta;?>' readonly>
                -->
                <input type="hidden" class="form-control input-lg id_carpetaElegida" value="" name="nuevoIdCarArchi">

              </div>

                <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Descripción">

                  </div>

                </div>


                <div class="form-group">
                
                  <div class="panel">*archivo</div>

                  <input type="file" name="nuevoArchivo" required>

              </div>

            </div>

          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Adjuntar</button>

        </div>

        <?php
          //$crearArchivo = new ControladorAnexos();
          //$crearArchivo -> ctrCrearArchivo();
        ?>

      </form>

    </div>

  </div>

</div>
