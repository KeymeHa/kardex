function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'cortes') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'cortes');
			$("#btn-RangoCortes span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'cortes');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoCortes span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoCortes span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$(".tablaCortes").on("click", "button.btnVerCorte", function(){
	var idCorte = $(this).attr("idCorte");
	window.location = "index.php?ruta=verCorte&idCorte="+idCorte;

})

$(".tablaCortes").on("click", "button.btnEditarCorte", function(){
	var idCorte = $(this).attr("idCorte");
	window.location = "index.php?ruta=editarCorte&idCorte="+idCorte;

})

$(".col-xs-2").on("click", "#generarPdfFAc", function(){

	var codigoInt = $(this).attr("codigoInt");
	window.open("extensiones/TCPDF-main/examples/corte.php?codigoInt="+codigoInt, "_blank");

})

$(".tablaCortes").on("click", "button.btnImpCorte", function(){

	var idC = $(this).attr("idCorte");

	window.open("extensiones/TCPDF-main/examples/planillaImp.php?idC="+idC, "_blank");

})


$('#btn-RangoCortes').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#btn-RangoCortes span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoCortes span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=cortes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=cortes&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "cortes";
})

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anio = d.getFullYear();

		if(mes < 10){

			var fechaInicial = anio+"-0"+mes+"-"+dia;
			var fechaFinal = anio+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = anio+"-"+mes+"-0"+dia;
			var fechaFinal = anio+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = anio+"-0"+mes+"-0"+dia;
			var fechaFinal = anio+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = anio+"-"+mes+"-"+dia;
	    	var fechaFinal = anio+"-"+mes+"-"+dia;

		}	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=cortes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
