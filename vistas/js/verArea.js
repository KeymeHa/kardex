
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