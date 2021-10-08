
$(".tablaPersonas").on("click", ".btnEditarPer", function(){

	var idper = $(this).attr("idper");
	
	var datos = new FormData();
	datos.append("idper", idper);

	$.ajax({

		url:"ajax/personas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$('#editarId').val(respuesta["id"]);
			$('#editarAreaP').val(respuesta["id_area"]);
			$('#editarAreaP').html(respuesta[4]);
			$('#editarPersona').val(respuesta["nombre"]);

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