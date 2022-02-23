$(".tablaproyectos").on("click", ".btnVerProyecto", function(){
	var idProyecto = $(this).attr("idProyecto");
	window.location = "index.php?ruta=verProyecto&idProy="+idProyecto;
})



$("#btn-nuevoProyecto").click(function(){
	var elemento = $("#fechaInicio");
	hoy(elemento);
})


$(".tablaproyectos").on("click", ".btnEditarProyecto", function(){

	var idProy = $(this).attr("idProyecto");
	var datos = new FormData();
	datos.append("idProy", idProy);

	$.ajax({

		url:"ajax/proyectos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarIDProyecto").val(respuesta["id"]);
			$("#editarProyecto").val(respuesta["nombre"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarFechaInicio").val(respuesta["fecha_inicio"]);
			$("#editarFechaFin").val(respuesta["fecha_fin"]);

		}

	});

})
