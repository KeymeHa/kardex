$(".tablaLicencias").on("click", "button.btnEditarLicencia", function(){

	$("h4.modal-title").html("Editar Licencia");
	$(".btn-submitLicencia").html("Editar");
	$("#inputlicenciaTipo").val(1);

	var idLicencia = $(this).attr("idLicencia");
	var datos = new FormData();
	datos.append("idLicencia", idLicencia);
	datos.append("item", "id");

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	

			$("#inputlicenciaUser").val(respuesta["usuario"]);
			$("#inputlicenciaPass").val(respuesta["password"]);
			$("#inputlicenciaPro").val(respuesta["productos"]);
			$("#inputlicenciaid").val(respuesta["id"]);

		}
	});
});

$(".btn-nuevaLicencia").click( function(){

	$("h4.modal-title").html("Añadir nueva licencia");
	$(".btn-submitLicencia").html("Añadir");
	$("#inputlicenciaTipo").val(0);
	$("#inputlicenciaUser").val("");
	$("#inputlicenciaPass").val("");
	$("#inputlicenciaPro").val("");
	$("#inputlicenciaid").val("");
});

$(".tablaLicencias").on("click", "button.btnEliminarLicencia", function(){

	var nombre = $(this).attr("nombre");
	var id = $(this).attr("idLicencia");

	swal({
		type: "warning",
		title: "¡Estas Seguro de Eliminar el Usuario de "+nombre+"!",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#d33',
		cancelButtonColor: '#149243',
	}).then((result)=>{

		if (result.value) 
		{
			window.location = "index.php?ruta=equiposlicencias&id="+id+"&del=true";
		}
	})

});