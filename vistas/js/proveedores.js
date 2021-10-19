
$(".btnVerProveedor").click(function(){

	var idProv = $(this).attr("idProv");

	window.location = "index.php?ruta=proveedor&idProv="+idProv;

})


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

$("#nuevoNit").change(function(){

	var nit = $(this).val();
	var datos = new FormData();
	datos.append("validarNit", nit);

	$(".alert").remove();

	console.log("datos ", datos);

	$.ajax({

		url:"ajax/proveedores.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			if(respuesta)
			{
				$("#nuevoNit").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> El NIT ya esta registrado.</div>');
	    		$("#nuevoNit").val("");
	    		ocultarAlert();
    		}
	    	
		}

	});


})