function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'actasIngreso') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'actasIngreso');
			$("#btn-RangoActasE span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'actasIngreso');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoActasE span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoActasE span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$('#btn-RangoActasE').daterangepicker(
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
    $('#btn-RangoActasE span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoActasE span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=actasIngreso&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=facturas&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "actasIngreso";
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

    	window.location = "index.php?ruta=actasIngreso&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

$(".btn-nuevaActa").click(function() {
	var elemento = $("#inputActaFecha");
	$("h4.modal-title").html("Ingresar nueva Acta de Ingreso o Devolución");
	$("#inputActaAccion").val(0);
	hoy(elemento)
});

$(".tablaActasEntrega").on("click", "button.btn-actaE", function(){

	$("h4.modal-title").html("Editar Acta");
	$(".btn-submitActasE").html("Editar");
	$("#inputActaAccion").val(1);

	var idActa = $(this).attr("idActa");
	var datos = new FormData();
	datos.append("item", "id");
	datos.append("idActa", idActa);

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	

			$("#inputActaId").val(respuesta["id"]);
			$("#inputActaFecha").val(respuesta["fecha"]);
			$("#inputActaCantidad").val(respuesta["cantidad"]);
			$("#textObsActa").html(respuesta["observaciones"]);
			$("#inputActaDir").val(respuesta["file"]);

			if (respuesta["tipo"] == 0) 
			{
				$("#tipoActa1").prop("checked", true);
			}
			else
			{
				$("#tipoActa2").prop("checked", true);
			}

		}
	});
});

$(".tablaActasEntrega").on("click", "button.btnVerActa", function(){
	var idActa = $(this).attr("idActa");
	window.location = "index.php?ruta=verActaEquipos&idActa="+idActa;
})