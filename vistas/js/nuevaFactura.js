$("#codigoFactura").change(function(){

	var factura = $(this).val();
	var datos = new FormData();
	datos.append("validarFactura", factura);

	$(".alert").remove();

	console.log("datos ", datos);

	$.ajax({

		url:"ajax/nuevaFactura.ajax.php",
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
					$("#codigoFactura").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> Ya Existe una Factura con el mismo Codigo.</div>');
		    		$("#codigoFactura").val("");
	    		}
	    	
		}

	});


})

$(".tablaInsumosNFactura").on("click", "button.agregarInsumo", function(){

	var idInsumo = $(this).attr("idInsumo");
	var imp = $("#valorImpuesto").val();

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
			var precio = respuesta["precio_compra"];
			var contenido = respuesta["contenido"];
			$(".nuevoInsumoAgregado").append(

				'<div class="row" style="padding:5px 15px">'+
                  '<div class="col-xs-1">'+
				   ' <div class="input-group-btn">'+
				        '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Mas Opciones"><i class="fa fa-plus"></i></button>'+
				        '<ul class="dropdown-menu">'+
				          '<li><a href="#"><input type="number" class="form-control nuevoImpuesto" value="0" min="0" title="impuesto personalizado"></a>'+
				          '</li>'+
				         ' <li >'+
				            '<a href="#" idInsumo="'+idInsumo+'" class="quitarInsumo"><i class="fa fa-times"></i> Eliminar</a>'+
				          '</li>'+
				        '</ul>'+
				      '</div>'+
				  '</div>'+
				  '<div class="col-xs-2" style="padding-right:0px">'+
				   ' <div class="input-group">'+
				    '<input type="text" class="form-control nuevaDescripcionInsumo" title="'+descripcion+'" idInsumo="'+idInsumo+'" value="'+descripcion+'" readonly>'+
				    '</div>'+
				  '</div>'+
				  '<div class="col-xs-2 ingresoCantidad">'+
				   ' <input type="number" class="form-control nuevaCantidadInsumo"  stock="'+stock+'" autocomplete="off" min="1" value="1" required>'+
				  '</div>'+
				  '<div class="col-xs-2 ingresoContenido">'+
				   ' <input type="number" class="form-control nuevoContenido" autocomplete="off" min="1" value="'+contenido+'" required>'+
				  '</div>'+
				  '<div class="col-xs-2 ingresoPrecio" style="padding-left:0px">'+
				   ' <div class="input-group">'+
				     ' <input type="text" class="form-control nuevoPrecioInsumo" min="1" value="'+precio+'" autocomplete="off" required>'+
				    '</div>'+
				  '</div>'+
				  '<div class="col-xs-3 ingresoSubT" style="padding-left:0px">'+
				   ' <div class="input-group">'+
				     ' <input type="text" class="form-control subTotalInsumo" min="1" name="subTotalInsumo" readonly value="'+precio+'" required>'+
				    '</div>'+
				  '</div>'+
                '</div>'
				)

			if($("#cajaToNuFa").children().length == 0)
			{
				$("#cajaToNuFa").append(
					'<div class="row" style="padding:5px 15px">'+
		              '<div class="col-xs-7" style="padding-right:0px">'+
		               	'<div class="input-group" title="SubTotal sin IVA">'+
		                	'<span class="input-group-addon">'+
		                	'<p>Sub T'+
		                	'</p>'+
		                 	'</span>'+
		                	'<input type="text" class="form-control input-lg" id="totalSinIVA" value readonly required>'+
		              	'</div>'+
		              '</div>'+
		              '<div class="col-xs-4" style="padding-right:0px">'+
		               	'<div class="input-group" title="IVA">'+
		                	'<input type="number" class="form-control input-lg" id="iva" value="'+imp+'" readonly required>'+
		              		'<span class="input-group-addon">'+
		                	'<p>%'+
		                	'</p>'+
		                 	'</span>'+
		              	'</div>'+
		              '</div>'+
		            '</div>'+
		            '<div class="row" style="padding:5px 15px">'+
		              '<div class="col-xs-7" style="padding-right:0px">'+
		               	'<div class="input-group" title="IVA">'+
		                	'<span class="input-group-addon">'+
		                	'<p>Total IVA'+
		                	'</p>'+
		                 	'</span>'+
		                	'<input type="text" class="form-control input-lg" id="totalIVA" value="0"  readonly required>'+
		              	'</div>'+
		              '</div>'+
                  	'</div>'+
                  	'<div class="row" style="padding:5px 15px">'+
		              '<div class="col-xs-7" style="padding-right:0px">'+
		               	'<div class="input-group" title="Otros impuestos">'+
		                	'<span class="input-group-addon">'+
		                	'<p>Total Otros'+
		                	'</p>'+
		                 	'</span>'+
		                	'<input type="text" class="form-control input-lg" id="totaIMP" value="0"  readonly required>'+
		              	'</div>'+
		              '</div>'+
                  	'</div>'+
		            '<div class="row" style="padding:5px 15px">'+
		              '<div class="col-xs-7" style="padding-right:0px">'+
		               	'<div class="input-group" title="Total+IVA">'+
		                	'<span class="input-group-addon">'+
		                	'<p>Total'+
		                	'</p>'+
		                 	'</span>'+
		                	'<input type="text" class="form-control input-lg" id="totalMasIVA" value="0"  readonly required>'+
		              	'</div>'+
		              '</div>'+
                  	'</div>'
					)
			}
			sumarPreciosNF();
			listarInsumosNF();
			$(".nuevoPrecioInsumo").number(true, 0);
			$(".subTotalInsumo").number(true, 0);
		}//success
	});//ajax
});

$(".tablaInsumosNFactura").on("draw.dt", function(){
	if(localStorage.getItem("quitarInsumo") != null){
		var listaIdInsumos = JSON.parse(localStorage.getItem("quitarInsumo"));
		for(var i = 0; i < listaIdInsumos.length; i++)
		{
			$("button.RegresarBoton[idInsumo='"+listaIdInsumos[i]["idInsumo"]+"']").removeClass('btn-default');
			$("button.RegresarBoton[idInsumo='"+listaIdInsumos[i]["idInsumo"]+"']").addClass('btn-success agregarInsumo');	
		}
	}
})

$(".tablaInsumosNFactura").on("click", "button.agregarInsumo", function(){
        
    if( $("button.btnGuardarFac").hasClass("btn-success") == false )
    {
    	$("button.btnGuardarFac").addClass("btn-success");
    	$('button.btnGuardarFac').attr("disabled", false);
    }

    sumarPreciosNF();

    listarInsumosNF();
})


var idQuitarInsumo = [];
localStorage.removeItem("quitarInsumo");

$(".formularioNuevaFactura").on("click", "a.quitarInsumo", function(){

	$(this).parent().parent().parent().parent().parent().remove();

	var idInsumo = $(this).attr("idInsumo");

	if(localStorage.getItem("quitarInsumo") == null)
	{ idQuitarInsumo = []; 

	}
	else
	{ 
		idQuitarInsumo.concat(localStorage.getItem("quitarInsumo"));
	}

	if($('.nuevoInsumoAgregado').find(".row").length)
	{
        
    }else
    {
    	deshabilitarCrearNF();

    }

	idQuitarInsumo.push({"idInsumo":idInsumo});
	localStorage.setItem("quitarInsumo", JSON.stringify(idQuitarInsumo));

	$("button.RegresarBoton[idInsumo='"+idInsumo+"']").removeClass("btn-default");
	$("button.RegresarBoton[idInsumo='"+idInsumo+"']").addClass("btn-success agregarInsumo");

	sumarPreciosNF();
	listarInsumosNF();

})

function deshabilitarCrearNF(){

	$("#cajaToNuFa").children().remove();
	$("button.btnGuardarFac").removeClass("btn-success");
	$("button.btnGuardarFac").addClass("btn-default");
	$('button.btnGuardarFac').attr("disabled", true);

	if ( $("#totalSinIVA").length > 0 ) 
	{
		$("#totalSinIVA").val(0);
	}
}

$(".formularioNuevaFactura").on("change", "input.nuevaCantidadInsumo", function(){

	precio = $(this).parent().parent().children('.ingresoPrecio').children().children('.nuevoPrecioInsumo');
	subTotal = $(this).parent().parent().children('.ingresoSubT').children().children('.subTotalInsumo');

	var mulPrecio = $(this).val() * precio.val();

	subTotal.val(mulPrecio);

	sumarPreciosNF();
	listarInsumosNF();
})

$(".formularioNuevaFactura").on("change", "input.nuevoContenido", function(){
	sumarPreciosNF();
	listarInsumosNF();
})

$(".formularioNuevaFactura").on("change", "input.nuevoImpuesto", function(){
	sumarPreciosNF();
	listarInsumosNF();
})


$(".formularioNuevaFactura").on("change", "input.nuevoPrecioInsumo", function(){

	cantidad = $(this).parent().parent().parent().children('.ingresoCantidad').children('.nuevaCantidadInsumo');
	subTotal2 = $(this).parent().parent().parent().children('.ingresoSubT').children().children('.subTotalInsumo');

	var mulCan = $(this).val() * cantidad.val();

	subTotal2.val(mulCan);

	sumarPreciosNF();
	listarInsumosNF();

	//$(this).parent().parent().children('.ingresoSubT').children().children('subTotalInsumo');
})

function sumarPreciosNF(){

	var precioItem = $(".subTotalInsumo");
	var impItem = $(".nuevoImpuesto");
	var sumaSubT = 0;//sub total para contabilizar iva

	var sumaSubTo = 0; //sub total para contabilizar otros

	var IMPSubTo = 0;//valor contabilizado por otros

	for(var i = 0; i < precioItem.length; i++){

		if( Number($(impItem[i]).val()) == 0 ) 
		{
			sumaSubT+= Number($(precioItem[i]).val());
		}
		else
		{
			sumaSubTo+= Number($(precioItem[i]).val());
			IMPSubTo+= Number($(precioItem[i]).val())*(Number($(impItem[i]).val()))/100 ;
			
		}
	}
	var iva = Number($("#iva").val());

	var valorIva = ( iva / 100 ) * sumaSubT;
	sumaSubT+= sumaSubTo;
 	var totalconIVA = valorIva + sumaSubTo + IMPSubTo;

 	//Valor sub total
 	//valor iva del subtotal
 	//valor otros impuestos
 	//Valor con iva
 	//Total = iva + sub + otros

 	$("#totaIMP").val(IMPSubTo);//ok
	$("#totalSinIVA").val(sumaSubT);//ok
	$("#totalMasIVA").val(totalconIVA);
	$("#totalIVA").val(valorIva);//ok
	
	$("#valorIva").val(valorIva);//ok
	$("#valorSub").val(sumaSubT+IMPSubTo);//ok

	$("#totaIMP").number(true, 0);
	$("#totalSinIVA").number(true, 0);//ok
	$("#totalMasIVA").number(true, 0);
	$("#totalIVA").number(true, 0);//ok

}

$(document).ready(function() {
	//$("button.btnGuardarFac").removeClass("btn-success");
    $(".formularioNuevaFactura").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});

/*
	LISTADO DE PRODUCTOS INGRESADOS A LA FACTURA
*/

function listarInsumosNF(){

	var listaInsumos = [];

	var descripcion = $(".nuevaDescripcionInsumo");

	var cantidad = $(".nuevaCantidadInsumo");

	var contenido = $(".nuevoContenido");

	var precio = $(".nuevoPrecioInsumo");

	var subTItem = $(".subTotalInsumo");

	var impTItem = $(".nuevoImpuesto");

	for(var i = 0; i < descripcion.length; i++){

		if ( $(impTItem[i]).val() != 0 ) 
		{
			listaInsumos.push({ "id" : $(descripcion[i]).attr("idInsumo"), 
							  "des" : $(descripcion[i]).val().replace(/"/gi,'&quot'),
							  "can" : $(cantidad[i]).val(),
							  "con" : $(contenido[i]).val(),
							  "pre" : $(precio[i]).val(),
							  "sub" : $(subTItem[i]).val(),
							  "imp" : $(impTItem[i]).val()})
		}
		else
		{
			listaInsumos.push({ "id" : $(descripcion[i]).attr("idInsumo"), 
							  "des" : $(descripcion[i]).val().replace(/"/gi,'&quot'),
							  "can" : $(cantidad[i]).val(),
							  "con" : $(contenido[i]).val(),
							  "pre" : $(precio[i]).val(),
							  "sub" : $(subTItem[i]).val()})
		}

	}

	console.log(listaInsumos);

	$("#listaInsumos").val(JSON.stringify(listaInsumos)); 

}
