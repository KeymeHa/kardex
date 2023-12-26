<?php

  if(isset($_GET["idInsumo"]) )
  {
    if($_GET["idInsumo"] == null)
    {
      echo'<script> window.location="insumos";</script>';
    }
    else
    {
      $insumo = ControladorInsumos::ctrMostrarInsumos("id", $_GET["idInsumo"]);
      $categoria = ControladorCategorias::ctrMostrarNombreCategoria("id", $insumo["id_categoria"]);
      $uniEnt = ControladorParametros::ctrMostrarUnidad($insumo["unidad"]);
      $uniSal = ControladorParametros::ctrMostrarUnidad($insumo["unidadSal"]);

      if (isset($_GET["fechaInicial"])) 
      {
        if (is_null($_GET["fechaInicial"])) 
        {
          $arrayInfo = ControladorInsumos::ctrInforStock($insumo["id"], null, null, $_SESSION["anioActual"]);
        }
        else
        {
          $arrayInfo = ControladorInsumos::ctrInforStock($insumo["id"], $_GET["fechaInicial"], $_GET["fechaFinal"], $_SESSION["anioActual"]);
        }
      }
      else
      {
         $arrayInfo = ControladorInsumos::ctrInforStock($insumo["id"], null, null, $_SESSION["anioActual"]);
      }
    }
  }
  else
  {
   echo'<script> window.location="insumos";</script>';
  }

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Insumo : <?php echo $insumo["descripcion"];?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="inventario">Inventario</a></li>

      <li><a href="insumos">Insumos</a></li>
      
      <li class="active"><?php echo $insumo["descripcion"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="insumos">
        <button class="btn btn-success">
          <i class="fa fa-arrow-left"></i>
          Regresar
        </button></a>
        <?php 
            include "anios.php";
          ?>


          <button type="button" class="btn btn-success pull-right" id="btn-RangoVerInsumo">    
              <span>
                <i class="fa fa-calendar"></i> Rango de fecha
              </span>
              <i class="fa fa-caret-down"></i>
          </button>

          <button type="button" class="btn btn-success" idInsumo="<?php echo $_GET['idInsumo']; ?>" id="btn-HisInsumo">   
              <i class="fa fa-bars"></i> Historial movimientos
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 col-lg-6 col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Información</h3>
            <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
          </div>
          <div class="box-body">

            <div class="row">
              <div class="col-sm-12 col-lg-7 col-md-7">
                <dl class="dl-horizontal">
                  <dt>Codigo</dt>
                  <dd><?php echo $insumo["codigo"];?></dd>
                  <dt>Asociada a Categoria</dt>
                  <dd><?php echo $categoria[0];?>
                  <dt>Precio Unidad</dt>
                  <dd>$ <span  class="cantidadEfectivo"><?php echo $insumo["precio_compra"];?></span></dd>
                  <dt>estante</dt>
                  <dd><?php echo $insumo["estante"];?></dd>
                  <dt>Nivel</dt>
                  <dd><?php echo $insumo["nivel"];?></dd>
                  <dt>Sección</dt>
                  <dd><?php echo $insumo["seccion"];?></dd>
                  <?php if($insumo["observacion"] != ""){echo "<dt>Observación</dt><dd>".$categoria[0]."</dd>";}?>
                  <dt>Total invertido</dt>
                  <dd>$ <span  class="cantidadEfectivo"><?php echo $arrayInfo["inv"];?></span></dd>
                  
                </dl>
              </div>

               <div class="col-sm-12 col-lg-5 col-md-5">
                <?php 

                if (!is_null($insumo["imagen"])) {
                  echo '<img class="img-responsive" src="vistas/img/productos/default/anonymous.png" alt="Photo">';
                }
                else
                {
                  if ($insumo["imagen"] != "") 
                  {
                    echo '<img class="img-responsive" src="'.$insumo["imagen"].'" alt="Photo">';
                  }
                  else
                  {
                     echo '<img class="img-responsive" src="vistas/img/productos/default/anonymous.png" alt="Photo">';
                  }
                }

                ?>
                
              </div>
            </div>


            
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-lg-6 col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Movimientos</h3>
            <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
          </div>
          <div class="box-body">
            <dl class="dl-horizontal">
            <dt>Stock Actual</dt>
            <dd><?php echo $insumo["stock"]." ".ControladorParametros::ctrMostrarUnidad($insumo["unidadSal"])."s";?></dd>
            <dt>Requerido</dt>
            <dd><?php if($arrayInfo["rq"] == 1){echo $arrayInfo["rq"]." Vez";}else{echo $arrayInfo["rq"]." Veces";}?></dd>
            <dt>Ingresado</dt>
            <dd><?php if($arrayInfo["ing"] == 1){echo $arrayInfo["ing"]." Vez";}else{echo $arrayInfo["ing"]." Veces";}?></dd>
            <dt>Stock Total Ingresado</dt>
            <dd><?php if($arrayInfo["ing_t"] == 1){echo $arrayInfo["ing_t"]." ".$uniEnt;}else{echo $arrayInfo["ing_t"]." ".$uniEnt."s";}?></dd>
            <dt>Stock Total Entregado</dt>
            <dd><?php if($arrayInfo["ing_e"] == 1){echo $arrayInfo["ing_e"]." ".$uniSal;}else{echo $arrayInfo["ing_e"]." ".$uniSal."s";}?></dd>
            <dt>Unidad de Entrada</dt>
            <dd><?php echo $uniEnt;?></dd>
            <dt>Unidad de Salida</dt>
            <dd><?php echo $uniSal;?></dd>
            </dd>
            </dl>
          </div>
        </div>
      </div>
    </div> <!--row-->


    <div class="row">
      <div class="col-sm-12 col-lg-6 col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Remisiones</h3>
            <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
          </div>
          <div class="box-body">  
              <table class="table table-bordered table-striped dt-responsive tablaEntradas" width="100%" data-page-length="10">       
                <thead>      
                 <tr>
                  <th style="width:10px">#</th>
                   <th>Código Remisión</th>
                   <th>Cantidad</th>
                   <th>Fecha</th>
                   <th>Acciones</th>
                 </tr>
                </thead>
                </table>
          </div>
        </div>
      </div>
       <div class="col-sm-12 col-lg-6 col-md-6">
        <div class="box">
           <div class="box-header with-border">
            <h3 class="box-title">Requisiciones</h3>
            <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
          </div>
          <div class="box-body"> 
          <table class="table table-bordered table-striped dt-responsive tablaSalidas" width="100%" data-page-length="10">       
            <thead>      
             <tr>
              <th style="width:10px">#</th>
              <th>Código Requisición</th>
               <th>Cantidad</th>
               <th>Fecha</th>
               <th>Acciones</th>
             </tr>
            </thead>
            </table> 
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <?php

      if (isset($_GET["fechaInicial"])) 
      {
        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
      }
      else
      {
        $fechaInicial = null;
        $fechaFinal = null;
      }


        include "reportes/insumoArea.php";
        include "reportes/insumoPersona.php";
      ?>
    </div>

    <div class="row">
      <?php
        include "reportes/historiaValores.php";
      ?>
    </div>

  
  </section>
</div>
