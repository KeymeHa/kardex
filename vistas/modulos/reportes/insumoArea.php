<?php
     $insumoArea = ControladorRequisiciones::ctrContarInsumoAreaPersona(1, $fechaInicial, $fechaFinal, $_SESSION["anioActual"], $_GET["idInsumo"]);
 ?>

<div class="col-lg-12">

<div class="box box-with-border">
	<div class="box-header">
		<h3 class="box-title">Consumo según área</h3>
	</div>
	<div class="box-body">
		<div class="col-lg-8">
			<div class="chart" id="bar-chart-InsumoArea" style="height: 250px;"></div>
		</div>
		<div class="col-lg-4">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Área</th>
						<th>Cantidad</th>
					</tr>
				</thead>
				<tbody>
					<?php

						if ( $insumoArea != 0) 
						{

							$contarInsumo = 0;

							foreach ($insumoArea as $key => $value) {

								$contarInsumo += $value["ent"];
								echo "<tr>
									<td>".($key+1)."</td>
									<td>".$value["nombre"]."</td>
									<td>".$value["ent"]."</td>
								</tr>";
							}

							echo "<tr>
									<td colspan='2'><b>Total</b></td>
									<td>".$contarInsumo."</td>
								</tr>";
						}

						

					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer">

	</div>
</div>

</div>


<script>

 var data = [
     <?php
   if($insumoArea != 0)
    {
        $ykeys = "";

        foreach ($insumoArea as $key => $value) {

         $ykeys.= "{ y: '".$value["nombre"]."', Cantidad: ".$value["ent"]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Cantidad: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Cantidad'],
      labels: ['Cantidad'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-InsumoArea';
  Morris.Bar(config);


</script>
