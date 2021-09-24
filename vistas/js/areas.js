
$(".tablaAreas").on("click", ".btnEditarArea", function(){

	var idArea = $(this).attr("idArea");
	
	var datos = new FormData();
	datos.append("idArea", idArea);

	$.ajax({

		url:"ajax/areas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarArea").val(respuesta["nombre"].replace(/&quot/gi,'"'));
			$("#editarDescripcion").val(respuesta["descripcion"].replace(/&quot/gi,'"'));
			$("#editarID").val(respuesta["id"]);

		}

	});

})

$(".tablaAreas").on("click", ".btnEliminarArea", function(){

	var idArea = $(this).attr("idArea");
	var nomArea = $(this).attr("nomArea");
	
	swal({
		type: "warning",
		title: "¡Estas Seguro de Eliminar el area: "+nomArea+"!",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#149243',
		cancelButtonColor: '#d33',
	}).then((result)=>{

		if (result.value) 
		{

			var datos = new FormData();
			datos.append("idArea2", idArea);

			$.ajax({

				url:"ajax/areas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){
					
					if(respuesta == 0)
					{
						window.location = "index.php?ruta=areas&idArea="+idArea+"&nomArea="+nomArea;
					}//if
					else
					{
						swal({
						  type: "error",
						  title: "El àrea "+nomArea+" tiene "+respuesta+" personas asociadas, debe migrarlos primero a otra, antes de eliminar.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })
					}
				}//respuesta:ajax

			}).fail( function( jqXHR, textStatus, errorThrown ) {

				var msgError = "";

			  if (jqXHR.status === 0) {

			    msgError ='Sin conexión a Internet.';

			  } else if (jqXHR.status == 404) {

			     msgError ='Requerimiento en pagina no encontrada [404]';

			  } else if (jqXHR.status == 500) {

			     msgError ='Error de Servidor Interno [500].';

			  } else if (textStatus === 'parsererror') {

			     msgError ='Fallo la respuesta en JSON';

			  } else if (textStatus === 'timeout') {

			     msgError ='Tiempo Agotado para la respuesta.';

			  } else if (textStatus === 'abort') {

			     msgError ='Requerimiento de ajax Cancelado';

			  } else {

			     msgError ='Uncaught Error: ' + jqXHR.responseText;

			  }

			  swal({
					type: "error",
					title:  msgError,
					text: "Contacte al Usuario root.",
					showCancelButton: false,
					showConfirmButton: true,
					confirmButtonText: "Listo",
					confirmButtonColor: '#149243',
				})

			});





			
		}
	})


})