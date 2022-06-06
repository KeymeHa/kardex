

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
		      title: "Posiblemente bien",
		      type: "success",
		      confirmButtonText: "¡Cerrar!"
		    }).then(function(result) {
		        if (result.value) {
		        	window.location = "radicado";
		        }
			});

		 }

	});

})