
$(".tablaPersonas").on("click", ".btnEditarPer", function(){
	$('#editarAreaP').children().remove();
	var idper = $(this).attr("idper");
	var idAr = $(this).attr("idAr");
	var datosD = new FormData();
	datosD.append("traer", 0);

	$('#editarId').val(idper);

	$.ajax({

		url:"ajax/areas.ajax.php",
		method: "POST",
		data: datosD,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuestaD){	
			
			for (var i = 0; i < respuestaD.length; i++) 
			{
				if (respuestaD[i]['id'] == idAr) 
				{
					$('#editarAreaP').append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['nombre']+'</option>');
				}

			}

			for (var i = 0; i < respuestaD.length; i++) 
			{
				if (respuestaD[i]['id'] != idAr) 
				{
					$('#editarAreaP').append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['nombre']+'</option>');
				}

			}
		}

	});

})

$(".tablaPersonas").on("click", ".btnEliminarPer", function(){

	var idPer = $(this).attr("idper");
	var nomPer = $(this).attr("nomper");

	swal({
			type: "warning",
			title: "¡Estas Seguro de Eliminar este registro "+nomPer+"!",
			showCancelButton: true,
			showConfirmButton: true,
			confirmButtonText: "Eliminar",
			cancelButtonText: "Cancelar",
			confirmButtonColor: '#149243',
			cancelButtonColor: '#d33',
		}).then((result)=>{

			if (result.value) 
			{
				window.location = "index.php?ruta=personas&idPer="+idPer;
			}
		})
	


})

function llamarPersonas()
{

	$('#nuevaPersona').children().remove();

	var datosDos = new FormData();
		datosDos.append("llamar", 1);
		$.ajax({
			url:"ajax/personas.ajax.php",
			method: "POST",
			data: datosDos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{	

				$('#nuevaPersona').append('<option value="">Seleccione Encargado</option>');

				for (var i = 0; i < respuesta.length; i++) 
				{
					$('#nuevaPersona').append('<option value="'+respuesta[i]['id']+'">'+respuesta[i]['nombre']+'</option>');
				}


			}
	});
}
$("#btn-nuevaPersona").click(function(){
	llamarPersonas();

})


function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'personas') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'personas');
			$("#btn-RangoPersonas span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'personas');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoPersonas span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoPersonas span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}


$('#btn-RangoPersonas').daterangepicker(
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
    $('#btn-RangoPersonas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoPersonas span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=personas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=personas&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "personas";
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

    	window.location = "index.php?ruta=personas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
