
$('.sidebar-menu').tree();

$( document ).ready(function() {

    $(".cantidadEfectivo").number(true, 0);

    if(typeof validarRuta === 'function') 
	{
    	validarRuta();
	}
});



function hoy(elemento)
{
	var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anio = d.getFullYear();

		if(mes < 10 && dia < 10){

			var fecha = anio+"-0"+mes+"-0"+dia;

		}else if(mes < 10 && dia > 9){

			var fecha = anio+"-0"+mes+"-"+dia;

		}else if(mes > 9 && dia < 10){

			var fecha = anio+"-"+mes+"-0"+dia;

		}else{

			var fecha = anio+"-"+mes+"-"+dia;

		}	

	$(elemento).val(fecha);
}

function ahora(elemento)
{
	var dt = new Date();
	var hora = 0;
	var min = 0;
	if (dt.getHours() <= 9) 
	{
		hora = "0"+dt.getHours();
	}
	else
	{
		hora = dt.getHours();
	}

	if (dt.getMinutes() <= 9) 
	{
		min = "0"+dt.getMinutes();
	}
	else
	{
		min = dt.getMinutes();
	}

	var time = hora + ":" + min;

	$(elemento).val(time);
}


$("#selectAnio").on("click", "li a", function(){

	if (localStorage.getItem("capturarRango")) 
	{
		localStorage.removeItem("capturarRango");
		localStorage.clear();
	}

	
	
	var anio = $(this).attr("anio");
	var actual = $(this).attr("actual");

	if(anio !== actual)
	{
		var datos = new FormData();
		datos.append("anio", anio);

		$.ajax({

			url:"ajax/parametros.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				 location.reload();
			}

		});
	}
})

$(".tablas").DataTable({

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
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

});


$(".btnNotificaciones").click(function(){
	
	var valor = $(this).attr("valor");
	var bodyNoti = $('#bodyNotificaciones');
	var titleNoti = $('#tituloNotificaciones');
	var anioActual = $('#inputPagCarAnioActual').val();
	if(valor == 1)
	{

		titleNoti.text("Listado Insumos Agotados");

		if(bodyNoti.has('table'))
		{
			bodyNoti.children().remove();
		}

		bodyNoti.append(
			'<table class="table table-bordered table-striped dt-responsive tablaInsumos" width="100%" data-page-length="25">'+       
			'<thead>'+      
			 '<tr>'+           
			  '<th style="width:10px">#</th>'+
			   '<th>Imagen</th>'+
			   '<th>Código</th>'+
			   '<th>Descripción</th>'+
			   '<th>Categoría</th>'+
			   '<th title="Estante">Est</th>'+
			   '<th title="Nivel">Nvl</th>'+
			   '<th title="Sección">Secc</th>'+
			 '</tr> '+
			'</thead>'+
			'</table>'
		)

		paginaCargada(12, 0, 0, anioActual, 0, 0, 0);
	}
	else if(valor == 2)
	{
		if(bodyNoti.has('table'))
		{
			bodyNoti.children().remove();
			titleNoti.text("Listado Insumos Escasos");
		}

		bodyNoti.append(
			'<table class="table table-bordered table-striped dt-responsive tablaInsumos" width="100%" data-page-length="25">'+       
			'<thead>'+      
			 '<tr>'+           
			  '<th style="width:10px">#</th>'+
			   '<th>Imagen</th>'+
			   '<th>Código</th>'+
			   '<th>Descripción</th>'+
			   '<th>Categoría</th>'+
			   '<th>Stock</th>'+
			   '<th title="Estante">Est</th>'+
			   '<th title="Nivel">Nvl</th>'+
			   '<th title="Sección">Secc</th>'+
			 '</tr> '+
			'</thead>'+
			'</table>'
		)

		paginaCargada(13, 0, 0, anioActual, 0, 0);
		
	}

})


$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
});


function paginaCargada(pagina, id, per, anioActual, dato, dato2){

	if(pagina != 0)
	{
		var tablaElegida = "";
		var tablaAjax = "";
		var variable = "";
		var orden = "asc";
		var columna = 0;
		if(pagina == 1)
		{
			tablaElegida =  $('.tablaCategorias');
			tablaAjax = 'categorias';
		}//Pagina Insumos
		else if(pagina == 2)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idCategoria = urlParams.get('idCategoria');
			tablaElegida =  $('.tablaInsumos');
			tablaAjax = 'insumos';
			variable = "?idCategoria="+idCategoria;
			
		}//Pagina Insumos
		else if(pagina == 3)
		{
			tablaElegida =  $('.tablaInsumos');
			tablaAjax = 'insumos';
		}//Pagina Insumos
		else if(pagina == 4)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaOrdenes');
			tablaAjax = 'ordenes';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}


		}//Pagina Insumos
		else if(pagina == 5)
		{

			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaFacturas');
			tablaAjax = 'facturas';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}

			
		}
		else if(pagina == 8)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaRqs');
			tablaAjax = 'requisiciones';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}
			tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden);
			variable+= "&appr=0";
			tablaElegida =  $('.tablaRqsAppr');
			tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden);


		}
		else if(pagina == 10)
		{
			tablaElegida =  $('.tablaInsumosNFactura');
			tablaAjax = 'nuevaFactura';

		}
		else if(pagina == 11)
		{
			tablaElegida =  $('.tablaInsumosNRq');
			tablaAjax = 'nuevaRq';
			if (per != 3 ) 
			{
				variable = "?gen=1&iduser="+id;
			}
		}
		else if(pagina == 12)
		{
			tablaElegida =  $('.tablaInsumos');
			tablaAjax = 'insumos';
			variable = "?agotados=12";
		}
		else if(pagina == 13)
		{
			tablaElegida =  $('.tablaInsumos');
			tablaAjax = 'insumos';
			variable = "?escasos=13";
		}
		else if(pagina == 14)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaActas');
			tablaAjax = 'actas';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}
		}
		else if(pagina == 15)
		{
			tablaElegida =  $('.tablaAreas');
			tablaAjax = 'areas';
			variable = "?actual="+anioActual;
		}
		else if(pagina == 16)
		{
			
			tablaAjax = 'personas';
			variable = "?actual="+anioActual;

			if(dato == 4)
			{
			  variable = "?sw="+dato;
			  tablaElegida =  $('.tablaPersonasReg');
			}
			else
			{
				tablaElegida =  $('.tablaPersonas');
			}
		}
		else if(pagina == 17)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaInsuRQReporte');
			tablaAjax = 'reporteRqInsu';
			//columna = 4;
			//orden = "desc";
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			}
			else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}
		}
		else if(pagina == 18)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idArea = urlParams.get('idArea');
			tablaElegida =  $('.tablaPersonas');
			tablaAjax = 'personas';
			variable = "?idArea="+idArea;
		}
		else if(pagina == 19)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idProv = urlParams.get('idProv');
			tablaElegida =  $('.tablaCarpeta');
			tablaAjax = 'carpetas';
			variable = "?idProv="+idProv;
		}
		else if(pagina == 20)
		{
			tablaElegida =  $('.tablaAnexos');
			tablaAjax = 'anexos';

			if(localStorage.getItem("idCarpeta") != null)
			{
				variable  = "?idCar="+localStorage.getItem("idCarpeta");
			}
			else
			{
				variable = "?idCar=0";
			}

			
		}
		else if(pagina == 21)
		{
			tablaElegida =  $('.tablaEntradas');
			tablaAjax = 'stock';

			if(localStorage.getItem("idStock") != null)
			{
				variable  = "?idInsumo="+localStorage.getItem("idStock")+"&tipoStock=in";
			}
			else
			{
				variable = "?idInsumo=0&tipoStock=in";
			}
		}
		else if(pagina == 22)
		{
			tablaElegida =  $('.tablaSalidas');
			tablaAjax = 'stock';

			if(localStorage.getItem("idStock") != null)
			{
				variable  = "?idInsumo="+localStorage.getItem("idStock")+"&tipoStock=out";
			}
			else
			{
				variable = "?idInsumo=0&tipoStock=out";
			}

			
		}
		else if(pagina == 23)
		{

			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaFacturas');
			tablaAjax = 'facturas';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&inv=1&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&inv=1"+"&actual="+anioActual;
			}

			
		}
		else if(pagina == 24)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaInver');
			tablaAjax = 'inversion';

			if(localStorage.getItem("idInver") != null)
			{
				variable = "?idInsumo="+localStorage.getItem("idInver");
			}
			else
			{
				variable = "?idInsumo=0";
			}
			
			if(fechaInicial == null)
			{
			  variable+="&fechaInicial=null&actual="+anioActual;
			} 
			else 
			{
			  variable+="&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&inv=1"+"&actual="+anioActual;
			}	
		}
		else if(pagina == 26)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idInsumo = urlParams.get('idInsumo');
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			var variableD = "";
			tablaElegida =  $('.tablaEntradas');
			tablaAjax = 'stock';

			if (idInsumo != null) 
			{
				if (fechaInicial != null) 
				{variableD = "&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;}
				else
				{variableD = "&fechaInicial=0&fechaFinal=0&actual="+anioActual;}

				variable = "?idInsumo="+idInsumo+variableD+"&tipoStock=in";
				tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden);
				validarTabla(tablaElegida, tablaAjax, variable, columna, orden);
				tablaElegida =  $('.tablaSalidas');
				variable = "?idInsumo="+idInsumo+variableD+"&tipoStock=out";
				tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden);
				validarTabla(tablaElegida, tablaAjax, variable, columna, orden);
			}
			else
			{
				variable = "?tipoStock=0";
				validarTabla(tablaElegida, tablaAjax, variable, columna, orden);
			}
		}
		else if(pagina == 27)
		{
			tablaElegida =  $('.tablaproyectos');
			tablaAjax = 'proyectos';
		}
		else if(pagina == 28)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idProy = urlParams.get('idProy');
			if(idProy != null)
			{
			  variable ="?idProy="+idProy;
			}
			tablaElegida =  $('.tablaproyectoArea');
			tablaAjax = 'areas';
		}
		else if(pagina == 29)
		{
			tablaElegida =  $('.tablaInsumosNRq');
			tablaAjax = 'nuevaRq';
			variable = "?gen=1&iduser="+id;
		}
		else if(pagina == 30)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			var iduser = urlParams.get('iduser');
			tablaElegida =  $('.tablaRqs');
			tablaAjax = 'solRequisiciones';
			variable = "?iduser="+iduser;
			if(fechaInicial == null)
			{
			  variable+= "&fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable+= "&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}
			tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden);
		}
		else if(pagina == 31)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaVentas');
			tablaAjax = 'ventas';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}


		}
		else if(pagina == 32)
		{
			tablaElegida =  $('.tablaClientes');
			tablaAjax = 'clientes';
		}
		else if(pagina == 33)
		{
			tablaElegida =  $('.tablaInsumosNVenta');
			tablaAjax = 'nuevaFactura';
		}
		else if(pagina == 34)
		{
			tablaElegida =  $('.tablaModulos');
			tablaAjax = 'parametros';
			 variable = "?verMod=1";
		}
		else if(pagina == 35)
		{
			tablaElegida =  $('.tablaRadicados');
			tablaAjax = 'radicados';
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idc = urlParams.get('idCorte');

			if(idc != null)
			{
			  variable = "?idCorte="+idc;
			}
		}
		else if(pagina == 36)
		{

			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			tablaElegida =  $('.tablaCortes');
			tablaAjax = 'cortes';
			
			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}

			
		}
		else if(pagina == 37)
		{

			tablaElegida =  $('.tablaRemitentes');

			if(dato != 0)
			{
			  variable = "?sw="+dato;
			}

			tablaAjax = 'remitentes';
			
		}
		else if(pagina == 38)
		{
			if(id == null)
			{
			  variable = "?idusr=null";
			} else 
			{
			  variable = "?idusr="+id+"&p="+per;
			}

			tablaElegida =  $('.tablaPersonas');
			tablaAjax = 'asignaciones';
			
		}
		//else if( pagina == 39 && (per == 7 || per == 8) == true )
		else if( pagina == 39 )
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');
			var estado = urlParams.get('es');
			var idA = urlParams.get('idA');

			var idUser = $("#inputVar").attr("idUser");
 			var perfil = $("#inputVar").attr("per");

			variable = "?idusr="+idUser+"&p="+perfil;


			if( dato !== 0 )
			{
				variable+= "&es="+dato;
			}
			else if(estado != null)
			{
				variable+= "&es="+estado;
			}
			else
			{
				variable+= "&es=null";
			}

			if( dato2 !== 0 )
			{
				variable+= "&idA="+dato2;
			}
			else if(idA != null)
			{
				variable+= "&idA="+idA;
			}
			else
			{
				variable+= "&idA=null";
			}

			variable+= "&p="+per;

			if(fechaInicial == null)
			{
			  variable+= "&fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable+= "&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}


			tablaElegida =  $('.tablaRegistros');
			tablaAjax = 'registros';
			
		}
		else if(pagina == 40)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idCategoria = urlParams.get('idCategoria');
			if(idCategoria == null)
			{
			  variable = "?idCategoria=null";
			} else 
			{
			  variable ="?idCategoria="+idCategoria;
			}
			tablaElegida =  $('.tablacategoriaArea');
			tablaAjax = 'areas';
		}
		else if(pagina == 41)
		{
			variable ="?mod="+dato;

			if (per != 0) 
			{
				variable += "&per="+per;
			}

			tablaElegida =  $('.tablaModulos');
			tablaAjax = 'modulos';
		}
		else if(pagina == 42)
		{
			tablaElegida =  $('.tablaPQR');
			tablaAjax = 'pqr';
		}
		else if(pagina == 43)
		{
			tablaElegida =  $('.tablaLicencias');

			if( dato !== 0 && dato2 !== 0 )
			{
				variable = "?item=" + dato + "&id=" + dato2;
			}

			tablaAjax = 'licencias';
		}
		else if(pagina == 44)
		{
			tablaElegida =  $('.tablaParamE');
			if( dato !== 0 && dato2 !== 0 )
			{
				variable = "?item=" + dato + "&id=" + dato2;
			}
			tablaAjax = 'equiposparam';
		}
		else if(pagina == 45)
		{
			tablaElegida =  $('.tablaEquipos');
			if( dato != 0 )
			{
				variable = "?item=" + dato + "&valor=" + dato2;
			}
			else
			{
				variable = "?item=estado&valor=1";
			}
			tablaAjax = 'equipos';
		}
		else if(pagina == 46)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var fechaInicial = urlParams.get('fechaInicial');
			var fechaFinal = urlParams.get('fechaFinal');

			if(fechaInicial == null)
			{
			  variable = "?fechaInicial=null&actual="+anioActual;
			} else 
			{
			  variable = "?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&actual="+anioActual;
			}

			if( dato !== 0 && dato2 !== 0 )
			{
				variable += "&item=" + dato + "&valor=" + dato2;
			}

			tablaElegida =  $('.tablaActasEntrega');
			tablaAjax = 'equiposactas';
		}
		else if (pagina == 47)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idActa = urlParams.get('idActa');

			if(idActa == null)
			{
			  variable = "?valor=null";
			} else 
			{
			  variable = "?valor="+idActa+"&item=id_acta";
			}

			tablaElegida =  $('.tablaEquipos');
			tablaAjax = 'equipos';

		}
		else if(pagina == 48)
		{
			tablaElegida =  $('.tablaEquipos');
			variable = "?item=estado&valor=1&acc=1";
			tablaAjax = 'equipos';
		}
		else if (pagina == 49)
		{
			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var idLicencia = urlParams.get('idLicencia');

			if(idLicencia == null)
			{
			  variable = "?valor=null";
			} else 
			{
			  variable = "?valor="+idLicencia+"&item=id_licencia";
			}

			tablaElegida =  $('.tablaEquipos');
			tablaAjax = 'equipos';

		}
		else if(pagina == 50)
		{
			tablaElegida =  $('.tablaUsuarios');
			tablaAjax = 'usuarios';
		}
		else if(pagina == 51)
		{
			tablaElegida =  $('.tablaDispositivos');
			tablaAjax = 'dispositivos';
		}
		

		//if (pagina != 26 && pagina != 8 && pagina != 39) {
			if (pagina != 26 && pagina != 8) {
			tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden);
			validarTabla(tablaElegida, tablaAjax, variable ,columna, orden);
		}

			

		
	}

}

function validarTabla(tablaElegida, tablaAjax, variable ,columna, orden)
{
	 $.ajax({
			 	url: "ajax/datatable-"+tablaAjax+".ajax.php"+variable,
				success:function(respuesta)
				{
						
				console.log("respuesta", respuesta);

				}

			}).fail( function( jqXHR, textStatus, errorThrown ) {

				var msgError = "";

			  if (jqXHR.status === 0) {

			    msgError ='Sin conexión a Internet.';

			  } else if (jqXHR.status == 404) {

			     msgError ='Requerimiento en pagina no encontrada [404]';

			  } else if (jqXHR.status == 500) {

			     msgError ='Error de Servidor Interno [500].';

			  } else if (textStatus === 'parsererror') {

			     msgError ='Fallo la respuesta en JSON';

			  } else if (textStatus === 'timeout') {

			     msgError ='Tiempo Agotado para la respuesta.';

			  } else if (textStatus === 'abort') {

			     msgError ='Requerimiento de ajax Cancelado';

			  } else {

			     msgError ='Uncaught Error: ' + jqXHR.responseText;

			  }

			  swal({
					type: "error",
					title:  msgError,
					text: "Contacte al Usuario root.",
					showCancelButton: false,
					showConfirmButton: true,
					confirmButtonText: "Listo",
					confirmButtonColor: '#149243',
				}).then((result)=>{
					if (result.value) 
					{
						window.location = "index.php";
					}
				})

			});
}

function tablaDatatable(tablaElegida, tablaAjax, variable, columna, orden)
{
	$(tablaElegida).DataTable( {
		    "ajax": "ajax/datatable-"+tablaAjax+".ajax.php"+variable,
		    "deferRender": true,
			"retrieve": true,
			"processing": true,
			"order": [[ columna, orden ]],
			 "language": {

					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ items",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando items del _START_ al _END_ de un total de _TOTAL_",
					"sInfoEmpty":      "Mostrando items del 0 al 0 de un total de 0",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ items)",
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

			$(tablaElegida).on("draw.dt", function(){

				$(".cantidadEfectivo").number(true, 0);

			})
}

function ocultarAlert()
{
	$('.alert').hide(10000)
	$('.alert').hide("fast");
}

/*
$("a#btn-sidebar-toggle").click(function(){

	if ( $( "#body-Gnral" ).hasClass( "sidebar-collapse" ) ) 
	{

	}
	else
	{

	}

})*/



$("a.a-semaforo").click(function() {
	var cuadrante = $(this).attr("cuadrante");
	var idUser = $("#inputVar").attr("idUser");
	var per = $("#inputVar").attr("per");
	var anio = $("#inputVar").attr("anio");
	paginaCargada(39, idUser, per, anio, cuadrante, 0);
});