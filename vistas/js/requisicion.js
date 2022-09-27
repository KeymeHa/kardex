$(".tablaInsumosNRq").on("click", "button.agregarInsumo", function(){

	var idInsumo = $(this).attr("idInsumo");

	$(this).removeClass('btn-success agregarInsumo');

	$(this).addClass('btn-default');

	var datos = new FormData();
	datos.append("idInsumo", idInsumo);

	$.ajax({

		url:"ajax/insumos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	
			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];

			if( $("#tipoGen").length > 0 )
			{
				$(".nuevoInsumoAgregadoRq").append(

				'<div class="row" style="padding:5px 15px">'+
                  '<div class="col-xs-6" style="padding-right:0px">'+
                   ' <div class="input-group">'+
                    '  <span class="input-group-addon">'+
                     '   <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'+idInsumo+'"><i class="fa fa-times"></i></button>'+
                     ' </span>'+
                    '<input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'+idInsumo+'" value="'+descripcion+'" readonly>'+
                  	'</div>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoCantidad">'+
                   ' <input type="number" class="form-control nuevaCantidadPedida" stock="'+stock+'" name="nuevaCantidadPedida" min="1" value="1" required>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoCantidad">'+
                   ' <input type="number" class="form-control nuevaCantidadEntregada" stock="'+stock+'" name="nuevaCantidadEntregada" min="1" value="1" required>'+
                  '</div>'+
                '</div>'
				)
			}
			else
			{
				$(".nuevoInsumoAgregadoRq").append(

				'<div class="row" style="padding:5px 15px">'+
                  '<div class="col-xs-7" style="padding-right:0px">'+
                   ' <div class="input-group">'+
                    '  <span class="input-group-addon">'+
                     '   <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'+idInsumo+'"><i class="fa fa-times"></i></button>'+
                     ' </span>'+
                    '<input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'+idInsumo+'" value="'+descripcion+'" readonly>'+
                  	'</div>'+
                  '</div>'+
                  '<div class="col-xs-4 ingresoCantidad">'+
                   ' <input type="number" class="form-control nuevaCantidadPedida" stock="'+stock+'" name="nuevaCantidadPedida" min="1" value="1" required>'+
                  '</div>'+
                '</div>'
				)
			}
			listarProductosRq();
		}
	});
});


$(".tablaInsumosNRq").on("draw.dt", function(){
	if(localStorage.getItem("quitarInsumo") != null){
		var listaIdInsumos = JSON.parse(localStorage.getItem("quitarInsumo"));
		for(var i = 0; i < listaIdInsumos.length; i++)
		{
			$("button.RegresarBoton[idInsumo='"+listaIdInsumos[i]["idInsumo"]+"']").removeClass('btn-default');
			$("button.RegresarBoton[idInsumo='"+listaIdInsumos[i]["idInsumo"]+"']").addClass('btn-success agregarInsumo');	
		}
	}
})

$(".tablaInsumosNRq").on("click", "button.agregarInsumo", function(){
        
        if( $("button.btnGuardarRq").hasClass("btn-success") == false )
        {
        	$("button.btnGuardarRq").addClass("btn-success");
        	$('button.btnGuardarRq').attr("disabled", false);
        }
    listarProductosRq();
})

//EDITAR


var idQuitarInsumo = [];
localStorage.removeItem("quitarInsumo");

$(".formularioNuevaRq").on("click", "button.quitarInsumo", function(){

	$(this).parent().parent().parent().parent().remove();

	var idInsumo = $(this).attr("idInsumo");

	if(localStorage.getItem("quitarInsumo") == null)
	{ idQuitarInsumo = []; 
	}
	else
	{ idQuitarInsumo.concat(localStorage.getItem("quitarInsumo"));}

	if($('.nuevoInsumoAgregadoRq').find(".row").length)
	{
        
    }else
    {
    	$("button.btnGuardarRq").removeClass("btn-success");
    	$("button.btnGuardarRq").addClass("btn-default");
    	$('button.btnGuardarRq').attr("disabled", true);
    }

	idQuitarInsumo.push({"idInsumo":idInsumo});
	localStorage.setItem("quitarInsumo", JSON.stringify(idQuitarInsumo));

	$("button.RegresarBoton[idInsumo='"+idInsumo+"']").removeClass("btn-default");
	$("button.RegresarBoton[idInsumo='"+idInsumo+"']").addClass("btn-success agregarInsumo");

	listarProductosRq();

})

$(".formularioNuevaRq").on("change", "input.nuevaCantidadPedida", function(){
	
	if(Number($(this).val()) === 0)
	{
		$(this).val(Number(1));
		swal({

			type: "error",
			title: "¡la Cantidad minima para solicitar tiene que ser igual o superior a 1!",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		})
	}else if (Number($(this).val()) < 0)
	{
		$(this).val(Number(1));
		swal({

			type: "error",
			title: "¡la Cantidad minima para solicitar tiene que ser igual o superior a 1!",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		})
	}

	listarProductosRq();

})

$(".formularioNuevaRq").on("change", "input.nuevaCantidadEntregada", function(){

	if(Number($(this).val()) > Number($(this).attr("stock")))
	{
		$(this).val(Number($(this).attr("stock")));

		swal({

			type: "error",
			title: "¡No hay esa Cantidad de Stock Disponible!",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		})
	}else
	
	if(Number($(this).val()) === 0)
	{
		$(this).val(Number(1));
	}else if (Number($(this).val()) < 0)
	{
		$(this).val(Number(1));
	}

	listarProductosRq();

})

$(document).ready(function() {

	var elemento = $("#fechaAprobacion");
    var elemento2 = $("#horaAprobacion");

	 if ( $("#fechaAprobacion") ) 
    {
    	hoy(elemento);
    }

    if ( $("#horaAprobacion") ) 
    {
    	ahora(elemento2);
    }

    $(".formularioNuevaRq").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});

$('#selectPersona').on('change', function() {
  
	$("#selecProyecto").children().remove();

	var id_persona = $(this).val();

	var dates = new FormData();
	dates.append("traerId_Area", id_persona);

	$.ajax({

		url:"ajax/personas.ajax.php",
		method: "POST",
		data: dates,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuestaD)
		{
			var datos = new FormData();
			datos.append("traerProyecto", respuestaD["id_area"]);

			$.ajax({

				url:"ajax/proyectos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta)
				{
					if(respuesta != '')
					{
						for (var i = 0; i < respuesta.length; i++) 
						{
							$("#selecProyecto").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
						}
					}
				}
			});
		}
	});

});



function listarProductosRq(){

	var listaInsumosRq = [];
	var descripcionRq = $(".nuevaDescripcionInsumo");
	var pedidaRq = $(".nuevaCantidadPedida");

	if( $(".nuevaCantidadEntregada").length > 0 )
	{
		var entregadaRq = $(".nuevaCantidadEntregada").val();
	}
	else
	{
		var entregadaRq = 0;
	}


	for(var i = 0; i < descripcionRq.length; i++){
		listaInsumosRq.push({ "id" : $(descripcionRq[i]).attr("idInsumo"), 
							  "des" : $(descripcionRq[i]).val(),
							  "ped" : $(pedidaRq[i]).val(),
							  "ent" : entregadaRq})
	}

	console.log(listaInsumosRq);

	$("#listadoInsumosRq").val(JSON.stringify(listaInsumosRq)); 

}

function quitarAgregarInsumo(){
	var idInsumo = $(".quitarInsumo");
	var idInsumo2 = $(".genInsumo");
	var botonesTabla = $(".tablaInsumosNRq tbody button.agregarInsumo");

	if(idInsumo.length == 0)
	{
		$("button.btnGuardarRq").removeClass("btn-success");
    	$("button.btnGuardarRq").addClass("btn-default");
    	$('button.btnGuardarRq').attr("disabled", true);
	}

	if(idInsumo2.length > 0)
	{
		$("button.btnGuardarRq").removeClass("btn-default");
    	$("button.btnGuardarRq").addClass("btn-success");
    	$('button.btnGuardarRq').attr("disabled", false);
	}

	
	for(var i = 0; i < idInsumo2.length; i++){
		var boton = $(idInsumo2[i]).attr("idInsumo");
		for(var j = 0; j < botonesTabla.length; j ++){
			if($(botonesTabla[j]).attr("idInsumo") == boton){
				$(botonesTabla[j]).removeClass("btn-success agregarInsumo");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}

	for(var i = 0; i < idInsumo.length; i++){
		var boton = $(idInsumo[i]).attr("idInsumo");
		for(var j = 0; j < botonesTabla.length; j ++){
			if($(botonesTabla[j]).attr("idInsumo") == boton){
				$(botonesTabla[j]).removeClass("btn-success agregarInsumo");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}
}

$('.tablaInsumosNRq').on('draw.dt', function(){
	quitarAgregarInsumo();
	listarProductosRq();
})