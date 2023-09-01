$(".tablaEquipos").on("click", "button.agregarPC", function(){

	var idPC = $(this).attr("idPC");

	$(this).removeClass('btn-danger agregarPC');

	$(this).addClass('btn-default');

	var datos = new FormData();
	datos.append("idPC", idPC);

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	
			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			var valEnt = 1;

			if( $("#perEditar").val() != 3 )
			{
				valEnt = 0;
			}

			$(".nuevoInsumoAgregadoRq").append(

				'<div class="row" style="padding:5px 15px">'+
                  '<div class="col-xs-6" style="padding-right:0px">'+
                   ' <div class="input-group">'+
                    '  <span class="input-group-addon">'+
                     '   <button type="button" class="btn btn-danger btn-xs quitarInsumo" idPC="'+idPC+'"><i class="fa fa-times"></i></button>'+
                     ' </span>'+
                    '<input type="text" class="form-control nuevaDescripcionInsumo" idPC="'+idPC+'" value="'+descripcion+'" readonly>'+
                  	'</div>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoCantidad">'+
                   ' <input type="number" class="form-control nuevaCantidadPedida" stock="'+stock+'" name="nuevaCantidadPedida" min="1" value="1" required>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoCantidad">'+
                   ' <input type="number" class="form-control nuevaCantidadEntregada" stock="'+stock+'" name="nuevaCantidadEntregada" min="0" value="'+valEnt+'" required>'+
                  '</div>'+
                '</div>'
			)

			if( $("#perEditar").val() != 3 )
			{
				$("input.nuevaCantidadEntregada").attr("readonly","");
			}

			listarProductosRq();
		}
	});
});


$(".tablaEquipos").on("draw.dt", function(){
	if(localStorage.getItem("quitarInsumo") != null){
		var listaidPCs = JSON.parse(localStorage.getItem("quitarInsumo"));
		for(var i = 0; i < listaidPCs.length; i++)
		{
			$("button.RegresarBoton[idPC='"+listaidPCs[i]["idPC"]+"']").removeClass('btn-default');
			$("button.RegresarBoton[idPC='"+listaidPCs[i]["idPC"]+"']").addClass('btn-success agregarPC');	
		}
	}
})

$(".tablaEquipos").on("click", "button.agregarPC", function(){
        
        if( $("button.btn-guardarDevPC").hasClass("btn-success") == false )
        {
        	$("button.btn-guardarDevPC").addClass("btn-success");
        	$('button.btn-guardarDevPC').attr("disabled", false);
        }
    listarProductosRq();
})

//EDITAR


var idQuitarInsumo = [];
localStorage.removeItem("quitarInsumo");

$(".formDevPC").on("click", "button.quitarInsumo", function(){

	$(this).parent().parent().parent().parent().remove();

	var idPC = $(this).attr("idPC");

	if(localStorage.getItem("quitarInsumo") == null)
	{ idQuitarInsumo = []; 
	}
	else
	{ idQuitarInsumo.concat(localStorage.getItem("quitarInsumo"));}

	if($('.nuevoInsumoAgregadoRq').find(".row").length)
	{
        
    }else
    {
    	$("button.btn-guardarDevPC").removeClass("btn-success");
    	$("button.btn-guardarDevPC").addClass("btn-default");
    	$('button.btn-guardarDevPC').attr("disabled", true);
    }

	idQuitarInsumo.push({"idPC":idPC});
	localStorage.setItem("quitarInsumo", JSON.stringify(idQuitarInsumo));

	$("button.RegresarBoton[idPC='"+idPC+"']").removeClass("btn-default");
	$("button.RegresarBoton[idPC='"+idPC+"']").addClass("btn-danger agregarPC");

	listarProductosRq();

})


$(document).ready(function() {
    $(".formDevPC").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

	var elemento = $("#dateIngresoE");
	hoy(elemento);

});



function listarProductosRq(){

	var listaInsumosRq = [];
	var num_serial = $(".nuevaDescripcionInsumo");

	for(var i = 0; i < num_serial.length; i++){
		listaInsumosRq.push({ "id" : $(num_serial[i]).attr("idPC"), 
							  "des" : $(num_serial[i]).val()})
	}

	console.log(listaInsumosRq);

	$("#listadoInsumosRq").val(JSON.stringify(listaInsumosRq)); 

}


function quitaragregarPC(){
	var idPC = $(".quitarInsumo");
	var idPC2 = $(".genInsumo");
	var botonesTabla = $(".tablaEquipos tbody button.agregarPC");

	if(idPC.length == 0)
	{
		$("button.btn-guardarDevPC").removeClass("btn-success");
    	$("button.btn-guardarDevPC").addClass("btn-default");
    	$('button.btn-guardarDevPC').attr("disabled", true);
	}

	if(idPC2.length > 0)
	{
		$("button.btn-guardarDevPC").removeClass("btn-default");
    	$("button.btn-guardarDevPC").addClass("btn-success");
    	$('button.btn-guardarDevPC').attr("disabled", false);
	}

	
	for(var i = 0; i < idPC2.length; i++){
		var boton = $(idPC2[i]).attr("idPC");
		for(var j = 0; j < botonesTabla.length; j ++){
			if($(botonesTabla[j]).attr("idPC") == boton){
				$(botonesTabla[j]).removeClass("btn-success agregarPC");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}

	for(var i = 0; i < idPC.length; i++){
		var boton = $(idPC[i]).attr("idPC");
		for(var j = 0; j < botonesTabla.length; j ++){
			if($(botonesTabla[j]).attr("idPC") == boton){
				$(botonesTabla[j]).removeClass("btn-success agregarPC");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}
}

$('.tablaEquipos').on('draw.dt', function(){
	quitaragregarPC();
	listarProductosRq();
})