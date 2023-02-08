<?php

	$pri_pendi  = ( ( $cuad3 ) / $contarCuadSu)*100;
	$pri_venci = ( ( $cuad4) / $contarCuadSu)*100 ;
	$his_resuelta = ( ( $cuad1) / $contarCuadIn)*100 ;
	$his_extemporanea = ( ( $cuad2) / $contarCuadIn)*100 ;
?>

<div class="box box-success">
	<div class="box-body">
		<div class="col-lg-6">
			<div class="chart" id="kpi-chart1" style="height: 170px; position: relative;">
			
			</div>
		</div>
	
		<div class="col-lg-6">
			<div class="chart" id="kpi-chart2" style="height: 170px; position: relative;">
			
			</div>
		</div>


		
	</div>
</div>


<script type="text/javascript">
	
var donut = new Morris.Donut({
  element: 'kpi-chart1',
  resize: true,
  colors: ["#F7F733", "#FF3300"],
  data: [

  	<?php

  		echo '{label: "Pendientes", value: '.$pri_pendi.' }';
  		echo ',';
    	echo '{label: "Vencidas", value: '.$pri_venci.'}';

  	?>


    
  ],
  hideHover: 'auto'
});




</script>


<script type="text/javascript">
	
var donut = new Morris.Donut({
  element: 'kpi-chart2',
  resize: true,
  colors: ["#0CA678", "#FD7E14"],
  data: [
  	<?php

  		echo '{label: "Resueltas", value: '.$his_resuelta.' }';
  		echo ',';
    	echo'{label: "Extemporaneas", value: '.$his_extemporanea.'}';

  	?>
  ],
  hideHover: 'auto'
});


</script>


