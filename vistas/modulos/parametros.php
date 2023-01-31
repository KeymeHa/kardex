<?php

if ($_SESSION["perfil"] != '1' && $_SESSION["perfil"] != '2' && $_SESSION["perfil"] != '7') 
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
      Parametros
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Parametros</li>  
    </ol>
  </section>
  <section class="content">

    <div class="row">
      <?php

      echo '<input type="hidden" value="'.$_SESSION["perfil"].'" id="perUsr" readonly>';

      ?>
      <div class="col-xs-12 col-md-5 col-lg-5">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Listado de parametros del Sistema</h3>
          </div>
          <div class="box-body">   

            <table class="table table-bordered table-striped dt-responsive tablas" width="100%" >
              <thead>
               <tr>
                 <th style="width:10px">Modulo</th>
                 <th>Descripción</th>
                 <th style="width: 50px">Acciones</th>
               </tr>
              </thead>
              <tbody>
                <?php

                  if ($_SESSION["perfil"] == '1' || $_SESSION["perfil"] == '2') 
                  {
                    echo ' <tr>
                    <th>Nombre de unidades de Insumos</th>
                    <td>Pertenece al nombre de las unidades para identificar la cantidad de unidades entrantes de las salientes.</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="1">Editar</button></td>
                  </tr>
                  <tr>
                    <th>Datos Generales de la empresa</th>
                    <td>Esta información es util para generar actas, Ordenes de compra, Remisiones, permite identificar datos basicos como, Representante, Nit, Encargados, direcciones y teléfono.</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="2">Editar</button></td>
                  </tr>
                  <tr>
                    <th>Margenes de Stock</th>
                    <td>Establece limites minimos, moderados y altos, permitiendo generar un aviso para solicitar stock.</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="3">Editar</button></td>
                  </tr>
                  <tr>
                    <th>Impuestos</th>
                    <td>Permite Agregar, modificar y eliminar impuestos del sistema, para tener estandarizado estos valores y evitar errores de facturación y ordenes de compras.</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="4">Editar</button></td>
                  </tr>
                   <tr>
                    <th>Módulos</th>
                    <td>Usted puede habilitar los modulos del sistema.</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="5">Administrar</button></td>
                  </tr>
                  <tr>
                    <th>Festivos</th>
                    <td>Permite importar por medio de un archivo en excel los festivos de un año</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="6">Administrar</button></td>
                  </tr><tr>
                    <td>Objeto</td>
                    <td>Puede Cambiar los terminos y valores de retención de documeentos</td>
                    <td>  
                        <div class="btn-group">
                          <div class="col-md-4">
                            <button class="btn btn-warning" title="Ver y Editar" onclick="verTerminos()">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Correspondencia</td>
                    <td>Filtrado de  correspondencia, puedes marcar todo aquello que necesites llevar la trazabilidad</td>
                    <td>  
                        <div class="btn-group">
                          <div class="col-md-4">
                            <button class="btn btn-warning" title="Ver y Editar" onclick="verPQR()">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </div>
                        </div>
                    </td>
                  </tr>';
                  }
                  elseif ($_SESSION["perfil"] == '3') {
                    # code...
                  }
                  elseif ($_SESSION["perfil"] == '7') {
                   echo '<tr>
                    <td>Objeto</td>
                    <td>Puede Cambiar los terminos y valores de retención de documeentos</td>
                    <td>  
                        <div class="btn-group">
                          <div class="col-md-4">
                            <button class="btn btn-warning" title="Ver y Editar" onclick="verTerminos()">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Correspondencia</td>
                    <td>Filtrado de  correspondencia, puedes marcar todo aquello que necesites llevar la trazabilidad</td>
                    <td>  
                        <div class="btn-group">
                          <div class="col-md-4">
                            <button class="btn btn-warning" title="Ver y Editar" onclick="verPQR()">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </div>
                        </div>
                    </td>
                  </tr>';
                  }

                  ?>
              </tbody>
            </table>  
            <?php

            $traer_filtro = ControladorParametros::ctrMostrarFiltroPQR("id_per", 7);
            $id_pqr = json_decode($traer_filtro["id_pqr"], true);

            echo $id_pqr[2]["id"];            

            //var_dump($id_pqr);

            ?>
              
          </div><!--<div class="box-body">-->
          
        </div>
      </div>

      <div class="col-xs-12 col-md-7 col-lg-7">
        <div class="box box-success">
          <div class="box-header">
           <h3 class="titulo-box"></h3> 
          </div><!--box-header-->

          <div class="box-body">

            <div class="row">
              <div class="contenido-box-1">
                <div class="form-group col-lg-6">
                <label>Select</label>
                  <select class="form-control" id="selectPer">
                  </select>
                </div>
              </div><!--contenido-box-1-->
            </div><!--row-->

            <div class="row">
              <div class="col-lg-12">
                <div class="contenido-box" id="tabla-Div-Tab-FiltroPQR">
                </div><!--contenido-box-->
              </div>
            </div><!--row-->

          </div><!--box-body-->

        </div><!--box box-success-->
      </div><!--col-xs-12 col-md-6 col-lg-6-->
    </div><!--row-->


 
  </section>
</div>