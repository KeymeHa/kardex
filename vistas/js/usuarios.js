$("#nuevoUsuario").change(function(){

	var idUsuario = $(this).val();
	var datos = new FormData();
	datos.append("validarUsuario", idUsuario);

	$(".alert").remove();

	console.log("datos ", datos);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
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
					$("#nuevoUsuario").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> Ya Existe ese Usuario.</div>');
		    		$("#nuevoUsuario").val("");
		    		ocultarAlert();
	    		}
	    	
		}

	});


})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".btnEliminarUsuario").click(function(){

	var idUsuario = $(this).attr("idUsuario");
	var nombreUsuario = $(this).attr("nombreUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
	var accionId = $(this).attr("accionId");
	if (idUsuario != accionId) 
	{
		if (idUsuario == 1) 
		{
			swal({
					type: "error",
					title: "¡Este Usuario no se puede eliminar!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){		
						window.location = "usuarios";
					}

				});
		}
		else
		{
			swal({
				type: "warning",
				title: "¡Estas Seguro de Eliminar el Usuario de "+nombreUsuario+"!",
				showCancelButton: true,
				showConfirmButton: true,
				confirmButtonText: "Eliminar",
				cancelButtonText: "Cancelar",
				confirmButtonColor: '#149243',
				cancelButtonColor: '#d33',
			}).then((result)=>{

				if (result.value) 
				{
					window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario+"&nombreusr="+nombreUsuario+"&accionId="+accionId;
				}
			})

		}
	}
	else
	{
		swal({
			type: "error",
			title: "¡No puedes auto Eliminarte!",
			text:"Debes hacerlo desde otro usuario Administrador",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function(result){

			if(result.value){
			
				window.location = "usuarios";

			}

		});

	}


})

$(".tablas").on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
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
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarFoto").val(respuesta["foto"]);

		}

	});

})

$(".tablas").on("click", ".btnActivarUsr", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	if( idUsuario != 1 )
	{
		var datos = new FormData();
	 	datos.append("activarId", idUsuario);
	  	datos.append("activarUsuario", estadoUsuario);

	  	$.ajax({

		  url:"ajax/usuarios.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
	      contentType: false,
	      processData: false,
	      success: function(respuesta){

	      		if(window.matchMedia("(max-width:767px)").matches){

		      		 swal({
				      title: "El usuario ha sido actualizado",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    }).then(function(result) {
				        if (result.value) {

				        	window.location = "usuarios";

				        }


					});

		      	}

	      }

	  	})

	  	if(estadoUsuario == 0){

	  		$(this).removeClass('btn-success');
	  		$(this).addClass('btn-danger');
	  		$(this).html('Desactivado');
	  		$(this).attr('estadoUsuario',1);

	  	}else{

	  		$(this).addClass('btn-success');
	  		$(this).removeClass('btn-danger');
	  		$(this).html('Activado');
	  		$(this).attr('estadoUsuario',0);

	  	}
	}
	else
	{
		swal({

			type: "error",
			title: "¡Este Usuario No Se puede Deshabilitar!",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function(result){

			if(result.value){
			
				window.location = "usuarios";

			}

		});
	}


})
