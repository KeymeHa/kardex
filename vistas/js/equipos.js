$("#btn-newEquipo").click(function(){
	$("#inputEquipoAccion").val(0);
	var elemento = $("#dateIngresoE");
	hoy(elemento);
});


$("#pc_serial").change(function() {

	var serial = $(this).val();

	var datos = new FormData();
	datos.append("serial", serial);

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	
			if(respuesta)
			{
				$(this).parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i>¡ '+serial+' ya existe! .</div>');
	    		$(this).val("");
	    		ocultarAlert();
    		}	
		}
	});


});
