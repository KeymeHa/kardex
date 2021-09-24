$('.tablaInsumosNOC').DataTable( {
    "ajax": "ajax/datatable-nuevaFactura.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ insumos",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando insumos del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando insumos del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ insumos)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

$(".tablaInsumosNOC").on("click", "button.agregarInsumo", function(){

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
			$(".nuevoInsumoAgregado").append(

				'<div class="row" style="padding:5px 15px">'+
                  '<div class="col-xs-3" style="padding-right:0px">'+
                   ' <div class="input-group">'+
                    '  <span class="input-group-addon">'+
                     '   <button type="button" class="btn btn-danger btn-xs quitarInsumo" idInsumo="'+idInsumo+'"><i class="fa fa-times"></i></button>'+
                     ' </span>'+
                    '<input type="text" class="form-control nuevaDescripcionInsumo" idInsumo="'+idInsumo+'" value="'+descripcion+'" title="'+descripcion+'" readonly>'+
                  	'</div>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoCantidad">'+
                   ' <input type="number" class="form-control nuevaCantidadInsumo"  stock="'+stock+'" name="nuevaCantidadInsumo" autocomplete="off" min="1" value="1" required>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
                   ' <div class="input-group">'+
                    '  <span class="input-group-addon">'+
                     '   <i class="ion ion-social-usd"></i>'+
                     ' </span>'+
                     ' <input type="text" class="form-control nuevoPrecioInsumo" min="1" name="nuevoPrecioInsumo" value="'+precio+'" autocomplete="off" required>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-xs-3 ingresoSubT" style="padding-left:0px">'+
                   ' <div class="input-group">'+
                    '  <span class="input-group-addon">'+
                     '   <i class="ion ion-social-usd"></i>'+
                     ' </span>'+
                     ' <input type="text" class="form-control subTotalInsumo" min="1" name="subTotalInsumo" value="'+precio+'" disabled readonly required>'+
                    '</div>'+
                  '</div>'+

                '</div>'
				)

			if($("#cajaToNuOC").children().length == 0)
			{
				$("#cajaToNuOC").append(
					'<div class="row" style="padding:5px 15px">'+
		              '<div class="col-xs-7" style="padding-right:0px">'+
		               	'<div class="input-group" title="SubTotal sin IVA">'+
		                	'<span class="input-group-addon">'+
		                	'<p>Sub T'+
		                	'</p>'+
		                 	'</span>'+
		                	'<input type="text" class="form-control input-lg" id="totalSinIVAOC" value="0" disabled readonly required>'+
		              	'</div>'+
		              '</div>'+
		              '<div class="col-xs-3" style="padding-right:0px">'+
		               	'<div class="input-group" title="IVA">'+
		                	'<input type="number" class="form-control input-lg" id="iva" value="'+imp+'" disabled readonly required>'+
		              		'<span class="input-group-addon">'+
		                	'<p>%'+
		                	'</p>'+
		                 	'</span>'+
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
		                	'<input type="text" class="form-control input-lg" id="totalMasIVA" value="0" disabled readonly required>'+
		              	'</div>'+
		              '</div>'+
                  	'</div>'
					)
			}
			sumarPreciosP();
			listarProductosNOC();
			$(".nuevoPrecioInsumo").number(true, 0);
			$(".subTotalInsumo").number(true, 0);
		}//success
	});//ajax
});

$(".form-group").on("change", "select.selectProv", function(){

	var idProv = $(this).val();

	if(idProv != 0)
	{
		var datos = new FormData();
		datos.append("idProv", idProv);

		$.ajax({

			url:"ajax/ordenes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){	


				if(respuesta[0] === 0)
				{
					$("#codigoInterno").val(1);
				}

				$("#codigoInterno").val( Number(respuesta[0])+1);

			}//success
		});//ajax
	}
	else
	{
		//valor 1
		$("#codigoInterno").val(1);
	}
})

$(".form-group").on("change", "select.selectProvEdit", function(){

	var idProv = $(this).val();
	var idProvAnt = $(this).attr("idprovant");
	var codigo = $(this).attr("codigo");

	if (idProv === idProvAnt) 
	{
		$("#codigoInterno").val(codigo);
	}
	else
	{
		var datos = new FormData();
		datos.append("idProv", idProv);

		$.ajax({

			url:"ajax/ordenes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){	


				if(respuesta[0] === 0)
				{
					$("#codigoInterno").val(1);
				}

				$("#codigoInterno").val( Number(respuesta[0])+1);

			}//success
		});//ajax
	}
	
})

$(".tablaInsumosNOC").on("draw.dt", function(){
	if(localStorage.getItem("quitarInsumo") != null){
		var listaIdInsumos = JSON.parse(localStorage.getItem("quitarInsumo"));
		for(var i = 0; i < listaIdInsumos.length; i++)
		{
			$("button.RegresarBoton[idInsumo='"+listaIdInsumos[i]["idInsumo"]+"']").removeClass('btn-default');
			$("button.RegresarBoton[idInsumo='"+listaIdInsumos[i]["idInsumo"]+"']").addClass('btn-success agregarInsumo');	
		}
	}
})

$(".tablaInsumosNOC").on("click", "button.agregarInsumo", function(){
        
    if( $("button.btnGuardarOC").hasClass("btn-success") == false )
    {
    	$("button.btnGuardarOC").addClass("btn-success");
    	$('button.btnGuardarOC').attr("disabled", false);
    }

    sumarPreciosP();

    listarProductosNOC();
})


var idQuitarInsumo = [];
localStorage.removeItem("quitarInsumo");

$(".formularioNuevaOC").on("click", "button.quitarInsumo", function(){

	$(this).parent().parent().parent().parent().remove();

	var idInsumo = $(this).attr("idInsumo");

	//Si no hay una elemento llamado quitarInsumo que es una clase de un boton 
	//Si no hay nada o no esta definido, crea un array llamado idQuitar Insumo sin cantidad
	//de elementos definidos.
	//en caso de no cumplir la anterior condicion,
	//lo que hace es concatenar el elemento obtenido de quitar insumo
	//y lo almacena en localStorage en el array idQuitarInsumo
	if(localStorage.getItem("quitarInsumo") == null)
	{ idQuitarInsumo = []; 
	  //$("button.btnGuardarOC").removeClass("btn-success");
	  //$("button.btnGuardarOC").addClass("btn-default");
	  //$("button.btnGuardarOC").removeAttr("type");
	}
	else
	{ idQuitarInsumo.concat(localStorage.getItem("quitarInsumo"));
	  //$("button.btnGuardarOC").removeClass("btn-default");
	  // $("button.btnGuardarOC").addClass("btn-success");
	}

	if($('.nuevoInsumoAgregado').find(".row").length)
	{
        
    }else
    {
    	$("#cajaToNuOC").children().remove();
    	$("button.btnGuardarOC").removeClass("btn-success");
    	$("button.btnGuardarOC").addClass("btn-default");
    	$('button.btnGuardarOC').attr("disabled", true);

    	if ( $("#totalSinIVAOC").length > 0 ) 
    	{
    		$("#totalSinIVAOC").val(0);
		}

    }

	idQuitarInsumo.push({"idInsumo":idInsumo});
	localStorage.setItem("quitarInsumo", JSON.stringify(idQuitarInsumo));

	$("button.RegresarBoton[idInsumo='"+idInsumo+"']").removeClass("btn-default");
	$("button.RegresarBoton[idInsumo='"+idInsumo+"']").addClass("btn-success agregarInsumo");

	sumarPreciosP();
	listarProductosNOC();

})

$(".formularioNuevaOC").on("change", "input.nuevaCantidadInsumo", function(){

	precio = $(this).parent().parent().children('.ingresoPrecio').children().children('.nuevoPrecioInsumo');
	subTotal = $(this).parent().parent().children('.ingresoSubT').children().children('.subTotalInsumo');

	var mulPrecio = $(this).val() * precio.val();

	subTotal.val(mulPrecio);

	sumarPreciosP();
	listarProductosNOC();
})


$(".formularioNuevaOC").on("change", "input.nuevoPrecioInsumo", function(){

	cantidad = $(this).parent().parent().parent().children('.ingresoCantidad').children('.nuevaCantidadInsumo');
	subTotal2 = $(this).parent().parent().parent().children('.ingresoSubT').children().children('.subTotalInsumo');

	var mulCan = $(this).val() * cantidad.val();

	subTotal2.val(mulCan);

	sumarPreciosP();
	listarProductosNOC();

	//$(this).parent().parent().children('.ingresoSubT').children().children('subTotalInsumo');
})

function sumarPreciosP(){

	var precioItem = $(".subTotalInsumo");
	
	var sumP = [];  

	for(var i = 0; i < precioItem.length; i++){

		 sumP.push(Number($(precioItem[i]).val())); 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaSubT = sumP.reduce(sumaArrayPrecios);
	
	var iva = Number($("#iva").val());

	var valorIva = Math.round( ( iva / 100 ) * sumaSubT );

 	var totalconIVA = valorIva + sumaSubT;


	$("#totalSinIVAOC").val(sumaSubT);
	$("#totalMasIVA").val(totalconIVA);
	$("#valorIva").val(valorIva);
	$("#valorSub").val(sumaSubT);

	$("#totalSinIVAOC").number(true, 0);
	$("#totalMasIVA").number(true, 0);


}

$(document).ready(function() {
	//$("button.btnGuardarOC").removeClass("btn-success");
    $(".formularioNuevaOC").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    $('.subTotalInsumo').on('keydown', function (e)
    {
        try {                
            if ((e.keyCode == 8 || e.keyCode == 46))
                return false;
            else
                return true;               
        }
        catch (Exception)
        {
            return false;
        }
    });

});

/*
	LISTADO DE PRODUCTOS INGRESADOS A LA FACTURA
*/

function listarProductosNOC(){

	var listaInsumos = [];

	var descripcion = $(".nuevaDescripcionInsumo");

	var cantidad = $(".nuevaCantidadInsumo");

	var precio = $(".nuevoPrecioInsumo");

	var subTItem = $(".subTotalInsumo");

	for(var i = 0; i < descripcion.length; i++){

		listaInsumos.push({ "id" : $(descripcion[i]).attr("idInsumo"), 
							  "des" : $(descripcion[i]).val().replace(/"/gi,'&quot'),
							  "can" : $(cantidad[i]).val(),
							  "pre" : $(precio[i]).val(),
							  "sub" : $(subTItem[i]).val()})

	}

	console.log(listaInsumos);

	$("#listaInsumos").val(JSON.stringify(listaInsumos)); 

}

function quitarAgregarInsumoNOC(){
	var idInsumo = $(".quitarInsumo");
	var botonesTabla = $(".tablaInsumosNOC tbody button.agregarInsumo");

	if(idInsumo.length == 0)
	{
		$("button.btnEditarOC").removeClass("btn-success");
    	$("button.btnEditarOC").addClass("btn-default");
    	$('button.btnEditarOC').attr("disabled", true);
	}
	else
	{
		$("button.btnEditarOC").removeClass("btn-default");
    	$("button.btnEditarOC").addClass("btn-success");
    	$('button.btnEditarOC').attr("disabled", false);
	}

	for(var i = 0; i < idInsumo.length; i++){
		var boton = $(idInsumo[i]).attr("idInsumo");
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idInsumo") == boton)
			{
				$(botonesTabla[j]).removeClass("btn-success agregarInsumo");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}
}


$('.tablaInsumosNOC').on('draw.dt', function(){
	quitarAgregarInsumoNOC();
	//listarProductosNF();
})