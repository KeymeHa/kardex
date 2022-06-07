

$(".btn-corte").click(function(){

	var datos = new FormData();
	datos.append("corte", 1);

	$.ajax({

		url:"ajax/radicados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			swal({
		      title: "Se ha generado una nueva Planilla",
		      type: "success",
		      confirmButtonText: "¡Cerrar!"
		    }).then(function(result) {
		        if (result.value) {
		        	window.location = "cortes";
		        }
			});

		 }

	});

})


$(".tablaRadicados").on("click", "button.btnEditarRadicado", function(){

	var id_rad = $(this).attr("id_rad");

	var datos = new FormData();
	datos.append("edit", 1);
	datos.append("id", id_rad);

	$.ajax({

		url:"ajax/radicados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#numRadEdit").val(respuesta["radicado"]);
			$("#id_radEdit").val(respuesta["id"]);
			$("#fechaEdit").val(respuesta["fecha"]);
			$("#remitEdit").val(respuesta["id_remitente"]);
			$("#cantEdit").val(respuesta["cantidad"]);
			$("#cantEdit").val(respuesta["cantidad"]);

			var myIds = [ 'accionEdit', 'pqrEdit', 'objetoEdit', 'articuloEdit', 'areaEdit' ];
			/*
			for (var i = 0; i < myIds.length; i++) 
			{
				
			}*/

			/*
				accionEdit
				pqrEdit
				objetoEdit
				articuloEdit
				areaEdit
				recEdit
				terminosEdit
				fecha_vEdit
				obsEdit
				soporteRadicadoEdit
			*/

		}//respuesta
	});//ajax

})//click


