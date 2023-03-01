<?php
  $anio = ControladorParametros::ctrVerAnio();
?>


<div class="btn-group">
  <button type="button" class="btn btn-success btn-flat">Año: <?php if($_SESSION["anioActual"] == 0) 
  {echo'Todos';}else{echo $_SESSION["anioActual"];}?></button>
  <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" id="selectAnio">
    <?php 
    for($i = 0; $i < count($anio); $i++)
    {
      if ($_SESSION["anioActual"] != $anio[$i]["anio"]) 
      {
        echo'<li><a href="#" anio="'.$anio[$i]["anio"].'" actual="'.$_SESSION["anioActual"].'">'.$anio[$i]["anio"].'</a></li>';
      } 
    }

      echo'<li><a href="#" anio="0" actual="'.$_SESSION["anioActual"].'">Todos</a></li>';

    ?>
  </ul>
</div>