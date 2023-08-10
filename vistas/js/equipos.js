$("button.btn-newEquipo").click(function(){
	$("#inputEquipoAccion").val(0);
	var elemento = $("#dateIngresoE");
	hoy(elemento);
});


$("#pc_serial").change(function() {

	var n_serie = $(this).val();

	var datos = new FormData();
	datos.append("n_serie", n_serie);

	$(".alert").remove();

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
				$("#pc_serial").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> '+n_serie+' ya existe ! .</div>');
	    		$("#pc_serial").val("");
	    		ocultarAlert();
    		}	
		}
	});


});


$("table.tablaEquipos").on('click', 'button.btn-verPC', function() 
{
	var idPC = $(this).attr("idPC");
	window.location = "index.php?ruta=verpc&idpc="+idPC;
});

$("button.btn-addParam").click(function(){
	var param = $(this).attr("param");
	$(this).parent().parent().parent().children('div.div-add').children().remove();
	$(this).parent().parent().parent().children('div.div-add').append('<div class="col-lg-12 col-md-12 col-sm-12">'+
                  '<div class="form-group form-groupAlert'+param+'" >'+
                    '<label class="control-label"><i class="fa fa-pencil"></i> Nuevo Valor</label>'+
                    '<input type="text" id="inputParam'+param+'" value="" class="form-control inputParam" placeholder="Enter ..." param="'+param+'">'+
                    '<div class="btn-group">'+
                      '<button type="button" class="btn btn-xs btn-success btn-saveParam"  param="'+param+'"><i class="fa fa-save"></i> Guardar</button>'+
                      '<button type="button" class="btn btn-xs btn-danger btn-cancelParam"><i class="fa fa-close"></i> Cancelar</button>'+
                    '</div>'+
                    '</div>'+
                '</div>');
});

$("form").on('click', 'button.btn-saveParam', function(){
	
	var tipo = $(this).attr("param");
	var valor = $(this).parent().parent().children('input.form-control').val();
	var idSession = $("#inputPagCarAnioActual").attr("idSession");

	//buscar si existe

		if(valor != "")
		{
			$("div.divAlertError > div.alert-warning").remove();
			var datos = new FormData();
			datos.append("valor", valor);
			datos.append("tipo", tipo);
			datos.append("idSession", idSession);

			$.ajax({

				url:"ajax/equipos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){	

					if(respuesta == 1)
					{
						$("div.form-groupAlert"+tipo).addClass('has-error');
						$("div.divAlertError").append('<div class="alert alert-warning"><i class="fa  fa-info"></i> El Parametro ya existe.</div>');
		    			$("#inputParam"+tipo).val("");
		    			ocultarAlert();
		    		}	
		    		else
		    		{
		    			var selectAdd = $("#inputParam"+tipo).parent().parent().parent().parent().children('div.input-group').children('select.form-control');//ok
		    			$("#inputParam"+tipo).val("");//ok
		    			$(selectAdd).children().remove();//ok
		    			$("#inputParam"+tipo).parent().parent().remove();//ok
	    			
						

						var datosDos = new FormData();
						datosDos.append("addParam", 1);
						datosDos.append("valor", valor);
						datosDos.append("tipo", tipo);
						datosDos.append("idSession", idSession);
						$.ajax({
							url:"ajax/equipos.ajax.php",
							method: "POST",
							data: datosDos,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function(respuestaD)
							{	

								for (var i = 0; i < respuestaD.length; i++) 
								{
									if (valor == respuestaD[i]['nombre']) 
									{
										$(selectAdd).append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['nombre']+'</option>');
									}

								}

								for (var i = 0; i < respuestaD.length; i++) 
								{
									if (valor != respuestaD[i]['nombre']) 
									{
										$(selectAdd).append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['nombre']+'</option>');
									}

								}
							}
						});
		    			//quitar opcion del select
		    			//traer todos los parametros de ese tipo
		    			//agregar primer option el valor ingresado
		    			//agregar los demas valores si no es el valor anteriormente ingresado
						
		    		}
				}
			});
		}//if(valor != "")
	//mostrar mensaje de error
});

$("form").on('click', 'button.btn-cancelParam', function(){
	$(this).parent().parent().parent().remove();
});


$("form").on('change', 'input.inputParam', function(){
	var valor = $(this).val();
	var tipo = $(this).attr("param");

	//buscar si existe

		$(".alert").remove();

		var datos = new FormData();
		datos.append("valor", valor);
		datos.append("tipo", tipo);

		$.ajax({

			url:"ajax/equipos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){	

				if(respuesta == 1)
				{
					$("div.form-groupAlert"+tipo).addClass('has-error');
					$("div.divAlertError").append('<div class="alert alert-warning"><i class="fa  fa-info"></i> El Parametro ya existe.</div>');
	    			$("#inputParam"+tipo).val("");
	    			ocultarAlert();
	    		}
			}
		});

		

	//mostrar mensaje de error
});