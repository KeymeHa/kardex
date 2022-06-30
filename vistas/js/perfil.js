
$("#btn-editar-usr").click( function(){

	var idUsuario = $(this).attr("idusr");
	var datos = new FormData();
	$("#editarPerfil").children().remove();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarId").val(respuesta["id"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#actualPassword").val(respuesta["password"]);
			$("#editarFoto").val(respuesta["foto"]);
			$("#editarCorreo").val(respuesta["correo"]);
			$("#editarPerfil").append(
			'<option value="'+respuesta["perfil"]+'">'+respuesta["nomperfil"]+'</option>'
			);	

		}

	});

})