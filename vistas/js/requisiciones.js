function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'requisiciones') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'requisiciones');
			$("#btn-RangoRequisicion span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'requisiciones');
	}
}

$(".tablaRqs").on("click", "button.btnVerRq", function(){
	var idRq = $(this).attr("idRq");
	window.location = "index.php?ruta=verRequisicion&idRq="+idRq;
})

$(".tablaRqsAppr").on("click", "button.btnVerSoli", function(){
	var idRq = $(this).attr("idRq");
	window.location = "index.php?ruta=verRequisicionS&idRq="+idRq;
})


$(".tablaRqs").on("click", "button.btnEditarRq", function(){
	var idRq = $(this).attr("idRq");
	window.location = "index.php?ruta=editarRq&idRq="+idRq;
})

$(".tablaRqs").on("click", "button.btnEliminarRq", function(){

	var idRq = $(this).attr("idRq");
	swal({
		type: "warning",
		title: "¡Estas Seguro de Eliminar Esta Requisición",
		text: "Esta acción no podra revertirse.",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#149243',
		cancelButtonColor: '#d33',
	}).then((result)=>{

		if (result.value) 
		{
			window.location = "index.php?ruta=requisiciones&idRq="+idRq;
		}
	})

})

if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoRequisicion span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoRequisicion span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}


$('#btn-RangoRequisicion').daterangepicker(
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
    $('#btn-RangoRequisicion span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoRequisicion span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=requisiciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=facturas&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "requisiciones";
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

    	window.location = "index.php?ruta=requisiciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
