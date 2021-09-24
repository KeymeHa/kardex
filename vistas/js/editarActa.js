$(".formularioNuevaActa").on("click", "span.agregarInsumo", function(){

	$(".nuevoInsumoAgregado").append(
		'<div class="row" style="padding:5px 15px">'+
	      '<div class="col-xs-3" style="padding-right:0px">'+
	       ' <div class="input-group">'+
	        '  <span class="input-group-addon">'+
	         '   <button type="button" class="btn btn-danger btn-xs quitarBN" title="Eliminar Esta Fila"><i class="fa fa-times"></i></button>'+
	         ' </span>'+
	        '<input type="text" class="form-control newSerial" placeholder="XGFR456">'+
	      	'</div>'+
	      '</div>'+
	      '<div class="col-xs-2">'+
	       ' <input type="text" class="form-control newMarca"  autocomplete="off"required placeholder="Marca">'+
	      '</div>'+
	      '<div class="col-xs-3">'+
	       ' <input type="text" class="form-control newDes"  autocomplete="off"required placeholder="Computador">'+
	      '</div>'+
	      '<div class="col-xs-2" style="padding-left:0px">'+
	       ' <div class="input-group">'+
	         ' <input type="number" class="form-control newCan"  min="1" value="1" autocomplete="off" required placeholder="2">'+
	        '</div>'+
	      '</div>'+
	      '<div class="col-xs-2" style="padding-left:0px">'+
	       ' <div class="input-group">'+
	         ' <input type="text" class="form-control newOb" autocomplete="off" placeholder="Opcional">'+
	        '</div>'+
	      '</div>'+
	    '</div>'
		)

		if(!$('#validarBN').find(".hijovalidarBN").length)
		{
	 	$("#validarBN").append(
	  '<div>'+
        '<br>'+
        '<h5 style="text-align: center;">Por Favor Añadir bienes o insumos.</h5>'+
      '</div>')}


		$("#validarBN").children().remove();
		$("button.btnGuardarACT").removeClass("btn-default");
		$("button.btnGuardarACT").addClass("btn-success");
		$('button.btnGuardarACT').attr("disabled", false);

		listarinsumosACT();
});


$(".formularioNuevaActa").on("change", "input.newSerial", function(){
		listarinsumosACT();
})
$(".formularioNuevaActa").on("change", "input.newMarca", function(){
		listarinsumosACT();
})
$(".formularioNuevaActa").on("change", "input.newDes", function(){
		listarinsumosACT();
})
$(".formularioNuevaActa").on("change", "input.newCan", function(){
		listarinsumosACT();
})
$(".formularioNuevaActa").on("change", "input.newOb", function(){
		listarinsumosACT();
})


$(".formularioNuevaActa").on("click", "button.quitarBN", function(){

	$(this).parent().parent().parent().parent().remove();

	if($('.nuevoInsumoAgregado').find(".row").length)
	{
    }else
    {
    	deshabilitarCrearACT();
    }

    listarinsumosACT();

});

function deshabilitarCrearACT(){

	if(!$('#validarBN').find(".hijovalidarBN").length)
		{
	 $("#validarBN").append(
	  '<div>'+
        '<br>'+
        '<h5 style="text-align: center;">Por Favor Añadir bienes o insumos.</h5>'+
      '</div>')}

	$("button.btnGuardarACT").removeClass("btn-success");
	$("button.btnGuardarACT").addClass("btn-default");
	$('button.btnGuardarACT').attr("disabled", true);

}

function listarinsumosACT(){

	var listaInsumos = [];
	var serial = $(".newSerial");
	var marca = $(".newMarca");
	var descripcion = $(".newDes");
	var cantidad = $(".newCan");
	var observacion = $(".newOb");
	var obs = "";
	for(var i = 0; i < serial.length; i++){

		if( $(observacion[i]).val() == "" )
			{obs = "N/A";}else{obs = $(observacion[i]).val().replace(/"/gi,'&quot');}

		listaInsumos.push({   "sn" : $(serial[i]).val().replace(/"/gi,'&quot'),
							  "mc" : $(marca[i]).val().replace(/"/gi,'&quot'), 
							  "des" : $(descripcion[i]).val().replace(/"/gi,'&quot'),
							  "can" : $(cantidad[i]).val().replace(/"/gi,'&quot'),
							  "obs" : obs})

	}

	console.log(listaInsumos);

	$("#listaInsumos").val(JSON.stringify(listaInsumos)); 

}
$(document).ready(function(){
	listarinsumosACT();
	if(!$('#validarBN').find(".hijovalidarBN").length)
		{
	 	$("#validarBN").append(
	  '<div>'+
        '<br>'+
        '<h5 style="text-align: center;">Por Favor Añadir bienes o insumos.</h5>'+
      '</div>')}


	$("#validarBN").children().remove();
	$("button.btnGuardarACT").removeClass("btn-default");
	$("button.btnGuardarACT").addClass("btn-success");
	$('button.btnGuardarACT').attr("disabled", false);
});