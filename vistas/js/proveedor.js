$(".col-md-4").on("click", ".btnEditarProveedor", function(){

	var idProv = $(this).attr("idProv");
	
	var datos = new FormData();
	datos.append("idProv", idProv);

	$.ajax({

		url:"ajax/proveedores.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarProveedor").val(respuesta["razonSocial"]);
			$("#editarNomComercial").val(respuesta["nombreComercial"]);
			$("#editarNit").val(respuesta["nit"]);
			$("#editarDigito").val(respuesta["digitoNit"]);
			$("#editarTelefono").val(respuesta["telefono"]);
			$("#editarCorreoP").val(respuesta["correo"]);

			if(respuesta["descripcion"] != null)
			{
				$("#editarDescripcion").val(respuesta["descripcion"].replace(/"/gi,'&quot'));
			}

			if(respuesta["direccion"] != null)
			{
				$("#editarDireccion").val(respuesta["direccion"].replace(/"/gi,'&quot'));
			}

			if(respuesta["contacto"] != null)
			{
				$("#editarContacto").val(respuesta["contacto"].replace(/"/gi,'&quot'));
			}

			if(respuesta["correo"] != null)
			{
				$("#editarCorreoP").val(respuesta["correo"].replace(/"/gi,'&quot'));
			}



		}

	});

})


$(".tablaCarpeta").on("click", "button.btnVerArchivos", function(){
	var idCar = $(this).attr("id_carpeta");
	var nomCar = $(this).attr("nombre_carpeta");
	//var datos = new FormData();
	//datos.append("idCar", idCar);

	$("#carpetaElegida").html(nomCar);

	/*
	$.ajax({
		url:"ajax/insumos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{		
		}
	});*/
})
