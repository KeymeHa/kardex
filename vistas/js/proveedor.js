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
	var anioActual = $('#inputPagCarAnioActual').val();

	$("#carpetaElegida").html(nomCar);
	$("#idCarpetaSelec").val(idCar);
	$('button.btn-NewAnexo').attr("disabled", false);	

	if(localStorage.getItem("idCarpeta") != null)
	{
		validarTablaAnexo();
		aparecerTablaAnexo();
		localStorage.setItem("idCarpeta", idCar);
	}
	else	
	{
		validarTablaAnexo();
		aparecerTablaAnexo();
		localStorage.setItem("idCarpeta", idCar);
	}

	paginaCargada(20, 0, 0, 0, anioActual);

})

function validarTablaAnexo()
{
	$('button.btn-NewAnexo').attr("disabled", true);

	if($('.tablaDivAnexo').find("table").length)
	{
	 	$('.tablaDivAnexo').children().remove();
	 	
	}
}

function aparecerTablaAnexo()
{
	$('button.btn-NewAnexo').attr("disabled", false);
	$('.tablaDivAnexo').append(
 	'<table class="table table-bordered table-striped dt-responsive tablaAnexos" width="100%">'+
    '<thead>'+
     '<tr>'+
       '<th style="width:10px">#</th>'+
       '<th>Nombre</th>'+
       '<th>Fecha</th>'+
       '<th style="width:100px">Acciones</th>'+
     '</tr>'+
    '</thead>'+
   '</table>'
   )
}

$(".tablaCarpeta").on("click", "button.btnEditarCarpeta", function(){

	var idCar = $(this).attr("id_carpeta");
	
	var datos = new FormData();
	datos.append("idCar", idCar);

	$.ajax({

		url:"ajax/anexos.ajax.php",
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
	    		$("#editarCarpetaProv").val(respuesta['nombre']);
	    		$("#idCarEditada").val(idCar);
    		}	
		}
	});

})

$(".tablaCarpeta").on("click", "button.btnEliminarCarpeta", function(){

	var idCar = $(this).attr("id_carpeta");
	var nomCar = $(this).attr("nombre_carpeta");
	var queryString = window.location.search;
	var urlParam = new URLSearchParams(queryString);
	var idProv = urlParam.get('idProv');

	swal({
		type: "warning",
		title: "¡Estas Seguro de Eliminar la carpeta: "+nomCar+"!",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#d33',
		cancelButtonColor: '#149243',
	}).then((result)=>{

		if (result.value) 
		{
			var datos = new FormData();
			datos.append("idCarElim", idCar);

			$.ajax({

				url:"ajax/anexos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){

					if(respuesta[0] == 0)
					{
						validarTablaAnexo();
						$("#idCarpetaSelec").val("");
						window.location = "index.php?ruta=proveedor&idProv="+idProv+"&idCar="+idCar;		
					}//if
					else
					{
						swal({
							type: "warning",
							title: "¡Esta Carpeta tiene "+respuesta[0]+" archivos, si la elimina, estos se perderán!",
							text: "Esta acción no podra revertirse.",
							showCancelButton: true,
							showConfirmButton: true,
							confirmButtonText: "Eliminar",
							cancelButtonText: "Cancelar",
							confirmButtonColor: '#d33',
							cancelButtonColor: '#149243',
						}).then((result)=>{
							if (result.value) 
							{
								validarTablaAnexo();
								$("#idCarpetaSelec").val("");
								window.location = "index.php?ruta=proveedor&idProv="+idProv+"&idCar="+idCar;
							}
						})
					}
				}//respuesta:ajax

			});//ajax
		
		}//if
	})//swal eliminar
	
})




//------------				ANEXOS
$(".tablaDivAnexo").on("click", "button.btnEditarAnexo", function(){


	var idAnexo = $(this).attr("id_anexo");
	
	var datos = new FormData();
	datos.append("idAnexo", idAnexo);

	$.ajax({

		url:"ajax/anexos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
	    		$("#editarAnexoCar").val(respuesta['nombre']);
	    		$("#idAnexoEditada").val(idAnexo);
		}
	});

})

$(".tablaDivAnexo").on("click", "button.btnEliminarAnexo", function(){

	var idAnexo = $(this).attr("id_anexo");
	var nomAnexo = $(this).attr("nombre_anexo");
	var id_usr = $('#idusrAnexo').val();
	var queryString = window.location.search;
	var urlParam = new URLSearchParams(queryString);
	var idProv = urlParam.get('idProv');

	swal({
		type: "warning",
		title: "¡Estas Seguro de Eliminar "+nomAnexo+"!",
		text: "Esta acción no podra revertirse una vez realizada.",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#d33',
		cancelButtonColor: '#149243',
	}).then((result)=>{

		if (result.value) 
		{
			var datos = new FormData();
			datos.append("idAnexoElim", idAnexo);
			datos.append("id_usr", id_usr);

			$.ajax({

				url:"ajax/anexos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta)
				{
					swal({
						type: "success",
						title: "¡Archivo eliminado!",
						showConfirmButton: true,
						confirmButtonColor: "#149243",
						confirmButtonText: "Cerrar"
					}).then((result)=>{
						if (result.value) 
						{
							window.location = "index.php?ruta=proveedor&idProv="+idProv;
						}
					})
					
				}//respuesta:ajax

			});
		
		}//if
	})//swal eliminar
	
})
