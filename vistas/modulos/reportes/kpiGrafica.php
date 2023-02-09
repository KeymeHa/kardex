<?php

  $pri_pendi = 0;
  $pri_venci = 0;
  $his_resuelta = 0;
  $his_extemporanea = 0;

  if (($cuad3+$cuad4) != 0) 
  {
      $pri_pendi  = bcdiv( ($cuad3/($cuad3+$cuad4)) *100, '1', 2);              
      $pri_venci = bcdiv( ($cuad4/($cuad3+$cuad4)) *100, '1', 2);    
  }

   if (($cuad1+$cuad2) != 0) 
  {
      $his_resuelta = bcdiv( ($cuad1/($cuad1+$cuad2)) *100, '1', 2);              
      $his_extemporanea = bcdiv( ($cuad2/($cuad1+$cuad2)) *100, '1', 2); 
  }

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


