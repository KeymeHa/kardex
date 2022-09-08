<?php

  if(isset($_GET["idCategoria"]) )
  {
    if($_GET["idCategoria"] == null)
    {
      echo'<script> window.location="categorias";</script>';
    }
    else
    {
      $item = "id";
      $valor = $_GET["idCategoria"];
      $categoria = ControladorCategorias::ctrMostrarCategoriasConFiltro($item, $valor);
      $item = "id_categoria";
      $canInsumos = ControladorCategorias::ctrContarInsumos("id_categoria", $valor);
      $stockTotal = ControladorInsumos::ctrContarStockTotal($item, $valor);
      $insuEscasos = ControladorInsumos::ctrVerificarInsEscasos($item, $valor);
      $insuAgotado = ControladorInsumos::ctrVerificarInsAgotados($item, $valor);
    }
  }
  else
  {
   echo'<script> window.location="categorias";</script>';
  }

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Categoria : <?php echo $categoria["categoria"];?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="inventario">Inventario</a></li>

      <li><a href="categorias">Categorias</a></li>
      
      <li class="active"><?php echo $categoria["categoria"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" onclick="history.back()">
          <i class="fa fa-arrow-left"></i>
          Regresar
        </button>
      </div>
    </div>

    <div class="box box-success collapsed-box">
      <div class="box-header with-border">
          <i class="fa fa-check-circle-o"></i> <h3 class="box-title">Permisos de Esta Categoria</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
          <i class="fa fa-plus" id="activarTablaPCat" idCar="<?php echo $_GET['idCategoria']; ?>"></i></button>
        </div>
      </div>
      <div class="box-body">

        <p>Para Habilitar que un área especifica pueda ver los insumos pertenecientes a esta categoria, debe hacer clic en el botón junto al nombre del área hasta que este se coloque en Rojo.</p>

        <br>

        <div id="tablaDivTabPermisoCat"></div>
      </div>
    </div>

    <div class="box">

      <div class="box-body">  

        <?php include "accionId.php";?>  

        <div class="row">
          <div class="col-sm-3 col-xs-3">
            <div class="description-block border-right">
              <h5 class="description-header">Agotados</h5>
              <span class="description-text"><?php echo $insuAgotado;?></span>
            </div>
          </div>

          <div class="col-sm-3 col-xs-3">
            <div class="description-block border-right">
              <h5 class="description-header">Escasos</h5>
              <span class="description-text"><?php echo $insuEscasos;?></span>
            </div>
          </div>

          <div class="col-sm-3 col-xs-3">
            <div class="description-block border-right">
              <h5 class="description-header">Insumos Asociados</h5>
              <span class="description-text"><?php echo $canInsumos;?></span>
            </div>
          </div>

           <div class="col-sm-3 col-xs-3">
            <div class="description-block border-right">
              <h5 class="description-header">Stock Total</h5>
              <span class="description-text">
                <?php if ($stockTotal != null) 
                {echo $stockTotal;}else{echo "0";} ?></span>
            </div>
          </div>
        </div>

        <br>
        <?php include "tablas/tablaInsumos.php"; ?>
      </div>
    </div>

    <?php

    include "reportes/insumosCat.php";

    ?>


  </section>
</div>

<?php

  include "modalEditarInsumos.php";
  $borrarInsumo = new ControladorInsumos();
  $borrarInsumo -> ctrBorrarInsumo();

?>