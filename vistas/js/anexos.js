$(".tablas").on("click", ".btnVerArchivos", function(){

	var id_carpeta = $(this).attr("id_carpeta");

	var nombre_carpeta = $(this).attr("nombre_carpeta");

	//$(".id_carpetaElegida").attr("id_carpetaElegida", id_carpeta);
	$(".id_carpetaElegida").val(id_carpeta);

	$("#carpetaElegida").html(nombre_carpeta);
	
	var datos = new FormData();
	datos.append("id_carpeta", id_carpeta);

	$.ajax({

		url:"ajax/datatable-archivos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{	
			$("#TablaArchivos").html( respuesta.tabladeArchivos);

			console.log("la tabla", respuesta["tabladeArchivos"]);
		}
		,
		error: function(respuesta)
		{	
			console.log("Error en ajax mostrar archivos en la tabla", respuesta);
		}

	});

})
