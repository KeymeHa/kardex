<?php
  $anio = ControladorParametros::ctrVerAnio(false);
?>


<div class="btn-group">
  <button type="button" class="btn btn-success btn-flat">Año: <?php if($anio[0]["anio"] == 0) 
  {echo'Todos';}else{echo $anio[0]["anio"];}?></button>
  <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" id="selectAnio">
    <?php 
    for($i = 1; $i < count($anio); $i++)
    {
      echo'<li><a href="#" anio="'.$anio[$i]["anio"].'" actual="'.$anio[0]["anio"].'">'.$anio[$i]["anio"].'</a></li>';
    }

      echo'<li><a href="#" anio="0" actual="'.$anio[0]["anio"].'">Todos</a></li>';

    ?>
  </ul>
</div>