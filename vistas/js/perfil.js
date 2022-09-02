
$("#btn-editar-usr").click( function(){

	var idUsuario = $(this).attr("idusr");
	var datos = new FormData();
	$("#editarPerfil").children().remove();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarId").val(respuesta["id"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#actualPassword").val(respuesta["password"]);
			$("#editarFoto").val(respuesta["foto"]);
			$("#editarCorreo").val(respuesta["correo"]);
			$("#editarPerfil").append(
			'<option value="'+respuesta["perfil"]+'">'+respuesta["nomperfil"]+'</option>'
			);	

		}

	});

})

function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'perfil') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'perfil');
			$("#btn-RangoPerfil span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'perfil');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoPerfil span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoPerfil span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$('#btn-RangoPerfil').daterangepicker(
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
    $('#btn-RangoPerfil span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoPerfil span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=perfil&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=perfil&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "perfil";
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

    	window.location = "index.php?ruta=perfil&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
