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
      <div class="col-xs-12 col-md-6 col-lg-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Listado de parametros del Sistema</h3>
          </div>
          <div class="box-body">       
          
            <div class="table-responsive">
             <table class="table">
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
                    <td>Esta información es util para generar actas, Ordenes de compra, Facturas, permite identificar datos basicos como, Representante, Nit, Encargados, direcciones y teléfono.</td>
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
                    <th>Modulos</th>
                    <td>Usted puede habilitar los modulos del sistema.</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="5">Administrar</button></td>
                  </tr>
                  <tr>
                    <th>Festivos</th>
                    <td>Permite importar por medio de un archivo en excel los festivos de un año</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="6">Administrar</button></td>
                  </tr>';
                  }
                  elseif ($_SESSION["perfil"] == '3') {
                    # code...
                  }
                  elseif ($_SESSION["perfil"] == '7') {
                   echo '<tr>
                    <th>Ajustar Terminos</th>
                    <td>Puede Cambiar los terminos y valores de retención de documeentos</td>
                    <td><button type="button" class="btn btn-block btn-success btn-param" sw="7">Administrar</button></td>
                  </tr>';
                  }

                  ?>


                 
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

      <div class="col-xs-12 col-md-6 col-lg-6">
        <div class="box box-success">
          <div class="box-header">
           <span class="titulo-box"></span> 
          </div><!--box-header-->
          <div class="box-body contenido-box">

          </div><!--box-body-->
        </div><!--box box-success-->
      </div><!--col-xs-12 col-md-6 col-lg-6-->
    </div><!--row-->


 
  </section>
</div>