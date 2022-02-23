
$("#btn-editarProyecto").click(function(){

	var idProy = $(this).attr("idProyecto");
	var datos = new FormData();
	datos.append("idProy", idProy);

	$.ajax({

		url:"ajax/proyectos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarIDProyecto").val(respuesta["id"]);
			$("#editarProyecto").val(respuesta["nombre"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarFechaInicio").val(respuesta["fecha_inicio"]);
			$("#editarFechaFin").val(respuesta["fecha_fin"]);

		}

	});

})

$(".tablaproyectoArea").on("click", "button.btnAddArea", function(){

	var idArea = $(this).attr("idArea");
	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	var idProy = urlParams.get('idProy');
	var datos = new FormData();
	datos.append("idArea", idArea);
	datos.append("idProy", idProy);

	if ($(this).hasClass("btn-success") == false) 
	{
		datos.append("sw", "out");
	}
	else
	{
		datos.append("sw", "in");
	}

	if( $(this).hasClass("btn-success") == false )
    {
    	$(this).removeClass("btn-danger");
	    $(this).addClass("btn-success");
	    $(this).children("i").removeClass("fa-close");
	    $(this).children("i").addClass("fa-plus");
	    $(this).attr("title", "Desasociar");
    }
    else
    {
    	$(this).removeClass("btn-success");
	    $(this).addClass("btn-danger");
	    $(this).children("i").removeClass("fa-plus");
	    $(this).children("i").addClass("fa-close");
	    $(this).attr("title", "Asociar");
    }

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
			
		}
	});

});

var idQuitarInsumo = [];
localStorage.removeItem("AddArea");

$(".tablaproyectoArea").on("draw.dt", function(){
	if(localStorage.getItem("AddArea") != null){
		var listaArea = JSON.parse(localStorage.getItem("AddArea"));
		for(var i = 0; i < listaArea.length; i++)
		{
			$("button.RegresarBoton[idArea='"+listaArea[i]["idArea"]+"']").removeClass('btn-default');
			$("button.RegresarBoton[idArea='"+listaArea[i]["idArea"]+"']").addClass('btn-success agregarInsumo');	
		}
	}
})
