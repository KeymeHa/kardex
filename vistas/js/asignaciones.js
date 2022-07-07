
$(".tablaPersonas").on("click", ".btnActivarUsr", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");
	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	var modulo = urlParams.get('p');

	var datos = new FormData();
	 	datos.append("id", idUsuario);
	  	datos.append("modulo", modulo);

	 if(estadoUsuario == 0)
	 {
	 	datos.append("accion", 1);
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoUsuario',1);

  	}else{
  		datos.append("accion", 0);
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoUsuario',0);

  	}
	  	$.ajax({

		  url:"ajax/asignaciones.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
	      contentType: false,
	      processData: false,
	      success: function(respuesta){

	      }//respuesta

	  	})
})