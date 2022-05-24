

$("#nuevoID").change(function(){

	var sid = $(this).val();
	var datos = new FormData();
	datos.append("validarCliente", idUsuario);
	datos.append("sid", sid);

	$(".alert").remove();

	$.ajax({

		url:"ajax/clientes.ajax.php",
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
					$("#nuevoID").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> Ya Existe este ID en sistema.</div>');
		    		$("#nuevoID").val("");
		    		ocultarAlert();
	    		}	
		}
	});
})