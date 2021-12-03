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

        <a href="categorias">
        <button class="btn btn-success">
          <i class="fa fa-arrow-left"></i>
          Regresar
        </button></a>
      </div>

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