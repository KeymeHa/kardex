$(document).ready(function() {

	var elemento = $("#fechaReg");
    var elemento2 = $("#horaReg");

	 if ( $("#fechaReg") ) 
    {
    	hoy(elemento);
    }

    if ( $("#horaReg") ) 
    {
    	ahora(elemento2);
    }

    var datosDos = new FormData();
        datosDos.append("verAcciones", 1);
        $.ajax({
            url:"ajax/parametros.ajax.php",
            method: "POST",
            data: datosDos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(resp)
            {   

                $("#select_accion").append('<option value="">Seleccione una acción</option>');

                

                for (var i = 0; i < resp.length; i++) 
                {
                    $("#select_accion").append('<option value="'+resp[i]['id']+'">'+resp[i]['nombre']+'</option>');
                }
            }
        });

   

});


$('#select_accion').change(function() {
    var valor = $(this).val();
    $("#contenido-modal-accion").children().remove();
    $("#contenido-modal-detalles").children().remove();
    
    //traslado interno  

    //devuelto para reasignación (El encargado de recibir el oficio, menciono que no es de su competencia, 
    //El encargado de jurídica recibe el oficio y lo remite a la nueva área encargada de responderlo
    if (valor == 1 || valor == 3) 
    {
        $("#contenido-modal-detalles").append('<input type="hidden" name="listadoEngargadoReg" id="listadoEngargadoReg" value>'+
            '<div class="form-group nuevoencargadoAgregado"></div>');
        tablaEncargadosInternos();
        paginaCargada(16, 0, 0, 0, 4, 0);
    }
    //traslado externo
    else if(valor == 2)
    {
        $("#contenido-modal-accion").append('<div class="row"><div class="col-lg-6">'+
                '<div class="input-group">'+          
                    '<span class="input-group-addon"><i class="fa fa-user"></i></span>'+
                    '<input type="text" class="form-control input-lg" id="nuevoRemitente" placeholder="Ingresar nombre">'+
                  '</div></div><br>'+
                '</div>');

        $("#contenido-modal-detalles").append('<input type="hidden" name="listadoRemitentesReg" id="listadoRemitentes" value>'+
            '<div class="form-group nuevoRemitenteAgregado"><div class="row">'+
                '<div class="col-xs-1"></div>'+
                '<div class="col-xs-7" style="padding-right:0px">'+
                 ' <p class="help-block">Trasladar a:</p>'+ 
                '</div>'+
                '<br>'+
              '</div></div>');
        tablaRemitentesExternos();
        paginaCargada(37, 0, 0, 0, 1, 0 );
    }
    
    //Respondido por evaluar
    else if(valor == 4)
    {
        
    }
    //Respondido y Enviado (Se genero respuesta por el encargado de 
    //gestionar la respuesta y fue enviado al supervisor para su aprobación)
    else if(valor == 5)
    {
        
    }
    //Para Enviar (por Correo Electrónico y/o Correo Fisico)
    else if(valor == 6)
    {
        
    }
    else if(valor == 7)
    {
      //traer objetos de pqr
      //nombre y termino
      //permita editar el termino   

       $("#contenido-modal-detalles").append('<input type="hidden" name="listadoPQR" id="listadoPQR" value>'+
            '<div class="form-group nuevopqrAgregado"></div>');
        tablaPQR();
        paginaCargada(42, 0, 0, 0, 0, 0);




    }


});



//--------------------------------------------------TABLA REMITENTES------------------------------------------------

function tablaRemitentesExternos()
{

    $("#contenido-modal-accion").append(
        
        '<table class="table table-bordered table-striped dt-responsive tablaRemitentes" data-page-length="10" width="100%" data-page-length="25">'+       
        '<thead>'+      
         '<tr>'+           
          '<th style="width:5px">#</th>'+
           '<th>Nombre</th>'+
           '<th style="width:10px">Acción</th>'+
         '</tr> '+
        '</thead>'+
        '</table')
}

$(".formularioModalRegistros").on("click", "button.agregarRemitente", function(){


    var idRemitente = $(this).attr("idRemitente");
    var remitente = $(this).attr("remitente");

    $(this).removeClass('btn-success agregarRemitente');

    $(this).addClass('btn-default');


    $(".nuevoRemitenteAgregado").append(
        '<div class="row" style="padding:5px 15px">'+
           ' <div class="input-group">'+
            '  <span class="input-group-addon">'+
             '   <button type="button" class="btn btn-danger btn-xs quitarRemitente" idRemitente="'+idRemitente+'"><i class="fa fa-times"></i></button>'+
             ' </span>'+
            '<input type="text" class="form-control nuevoRemitenteRegistro" idRemitente="'+idRemitente+'" value="'+remitente+'" readonly>'+
            '</div>'+
        '</div>')

    listarRemitentes();


});


$(".tablaRemitentes").on("draw.dt", function(){
    if(localStorage.getItem("quitarRemitente") != null){
        var listaidRemitentes = JSON.parse(localStorage.getItem("quitarRemitente"));
        for(var i = 0; i < listaidRemitentes.length; i++)
        {
            $("button.RegresarBoton[idRemitente='"+listaidRemitentes[i]["idRemitente"]+"']").removeClass('btn-default');
            $("button.RegresarBoton[idRemitente='"+listaidRemitentes[i]["idRemitente"]+"']").addClass('btn-success agregarRemitente');  
        }
    }
})


$(".formularioModalRegistros").on("click", "button.agregarRemitente", function(){
        
        if( $("button.btnGuardarRq").hasClass("btn-success") == false )
        {
            $("button.btnGuardarRq").addClass("btn-success");
            $('button.btnGuardarRq').attr("disabled", false);
        }
    listarRemitentes();
})

var idquitarRemitente = [];
localStorage.removeItem("quitarRemitente");

$(".formularioModalRegistros").on("click", "button.quitarRemitente", function(){

    $(this).parent().parent().parent().remove();

    var idRemitente = $(this).attr("idRemitente");

    if(localStorage.getItem("quitarRemitente") == null)
    { idquitarRemitente = []; 
    }
    else
    { idquitarRemitente.concat(localStorage.getItem("quitarRemitente"));}

    if($('.nuevoRemitenteAgregado').find(".row").length)
    {
        
    }else
    {
        $("button.btnGuardarRq").removeClass("btn-success");
        $("button.btnGuardarRq").addClass("btn-default");
        $('button.btnGuardarRq').attr("disabled", true);
    }

    idquitarRemitente.push({"idRemitente":idRemitente});
    localStorage.setItem("quitarRemitente", JSON.stringify(idquitarRemitente));

    $("button.RegresarBoton[idRemitente='"+idRemitente+"']").removeClass("btn-default");
    $("button.RegresarBoton[idRemitente='"+idRemitente+"']").addClass("btn-success agregarRemitente");

    listarRemitentes();

})

function listarRemitentes(){

    var listarRemitentesArray = [];
    var remitente = $(".nuevoRemitenteRegistro");


    for(var i = 0; i < remitente.length; i++){
        listarRemitentesArray.push({ "id" : $(remitente[i]).attr("idRemitente"), 
                              "rem" : $(remitente[i]).val()})
    }

    console.log(listarRemitentesArray);

    $("#listadoRemitentes").val(JSON.stringify(listarRemitentesArray)); 
    
}




//-------------------------------------------------FIN TABLA REMITENTES----------------------------------------------------
//-----------------------------------------------TABLA ENCARGADOS INTERNOS-------------------------------------------------


function tablaEncargadosInternos()
{
    $("#contenido-modal-accion").append(
    '<table class="table table-bordered table-striped dt-responsive tablaPersonasReg" width="100%">'+
        '<thead>'+
         '<tr>'+
           '<th style="width:10px">#</th>'+
           '<th>Nombre</th>'+
           '<th>Área</th>'+
           '<th style="width: 50px;">Acciones</th>'+
         '</tr>'+ 
        '</thead>'+
    '</table>');
}


$(".formularioModalRegistros").on("click", "button.agregarPersona", function(){


    var idper = $(this).attr("idper");
    var encargado = $(this).attr("encargado");
    var idArea = $(this).attr("idArea");

    //$(this).removeClass('btn-success agregarPersona');

    //$(this).addClass('btn-default');

    if ( $(".nuevoencargadoAgregado").children().length > 0 ) 
    {
        $(".nuevoencargadoAgregado").children().remove();
    }

    $(".nuevoencargadoAgregado").append(
        '<div class="row">'+
                '<div class="col-xs-1"></div>'+
                '<div class="col-xs-7" style="padding-right:0px">'+
                 ' <p class="help-block">Asignar a:</p>'+ 
                '</div>'+
                '<br>'+
              '</div>'+
        '<div class="row" style="padding:5px 15px">'+
           ' <div class="input-group">'+
            '  <span class="input-group-addon">'+
             '   <button type="button" class="btn btn-danger btn-xs quitarEncargado" idper="'+idper+'"><i class="fa fa-times"></i></button>'+
             ' </span>'+
            '<input type="text" class="form-control nuevoencargadoRegistro" idArea="'+idArea+'" idper="'+idper+'" value="'+encargado+'" readonly>'+
            '</div>'+
        '</div>')

    listarencargados();


});


$(".tablaPersonas").on("draw.dt", function(){
    if(localStorage.getItem("quitarEncargado") != null){
        var listaidpers = JSON.parse(localStorage.getItem("quitarEncargado"));
        for(var i = 0; i < listaidpers.length; i++)
        {
            $("button.RegresarBotonE[idper='"+listaidpers[i]["idper"]+"']").removeClass('btn-default');
            $("button.RegresarBotonE[idper='"+listaidpers[i]["idper"]+"']").addClass('btn-success agregarPersona'); 
        }
    }
})

var idquitarEncargado = [];
localStorage.removeItem("quitarEncargado");

$(".formularioModalRegistros").on("click", "button.quitarEncargado", function(){

    $(this).parent().parent().parent().remove();

    var idper = $(this).attr("idper");

    if(localStorage.getItem("quitarEncargado") == null)
    { idquitarEncargado = []; 
    }
    else
    { idquitarEncargado.concat(localStorage.getItem("quitarEncargado"));}

    idquitarEncargado.push({"idper":idper});
    localStorage.setItem("quitarEncargado", JSON.stringify(idquitarencargado));

    $("button.RegresarBotonE[idper='"+idper+"']").removeClass("btn-default");
    $("button.RegresarBotonE[idper='"+idper+"']").addClass("btn-success agregarPersona");

    listarencargados();

})

function listarencargados(){

    var listarencargadosArray = [];
    var encargado = $(".nuevoencargadoRegistro");


    for(var i = 0; i < encargado.length; i++){
        listarencargadosArray.push({ "id" : $(encargado[i]).attr("idper"), 
                                    "idA" : $(encargado[i]).attr("idArea"), 
                                    "nom" : $(encargado[i]).val()})
    }

    console.log(listarencargadosArray);

    $("#listadoEngargadoReg").val(JSON.stringify(listarencargadosArray)); 

}

//--------------------------------------------FIN TABLA ENCARGADOS INTERNOS------------------------------------------------
//--------------------------------------------------TABLA PQR----------------------------------------------------------

function tablaPQR()
{
    $("#contenido-modal-accion").append(
    '<table class="table table-bordered table-striped dt-responsive tablaPQR" width="100%">'+
        '<thead>'+
         '<tr>'+
           '<th style="width:10px">#</th>'+
           '<th>Tipo PQR</th>'+
           '<th>Termino</th>'+
           '<th style="width: 50px;">Acciones</th>'+
         '</tr>'+ 
        '</thead>'+
    '</table>');
}


$(".formularioModalRegistros").on("click", "button.agregarPQR", function(){


    var idPQR = $(this).attr("idPQR");
    var pqr = $(this).attr("pqr");
    var termino = $(this).attr("termino");

    //$(this).removeClass('btn-success agregarPQR');

    //$(this).addClass('btn-default');

    if ( $(".nuevopqrAgregado").children().length > 0 ) 
    {
        $(".nuevopqrAgregado").children().remove();
    }

    $(".nuevopqrAgregado").append(
        '<div class="row">'+
                '<div class="col-xs-8" style="padding-right:0px">'+
                 ' <p class="help-block">Tipo PQR Seleccionado:</p>'+ 
                '</div>'+
                '<div class="col-xs-4" style="padding-right:0px">'+
                 ' <p class="help-block">Termino:</p>'+ 
                '</div>'+
                '<br>'+
              '</div>'+
        '<div class="row" style="padding:5px 15px">'+
           ' <div class="input-group">'+
            '  <span class="input-group-addon">'+
             '   <button type="button" class="btn btn-danger btn-xs quitarPQR" idPQR="'+idPQR+'"><i class="fa fa-times"></i></button>'+
             ' </span>'+
            '<div class="col-xs-8"><input type="text" class="form-control nuevoPQRRegistro" idPQR="'+idPQR+'" value="'+pqr+'" readonly></div>'+
            '<div class="col-xs-4"><input type="text" class="form-control nuevoPQRTermino" idPQR="'+idPQR+'" value="'+termino+'" min="1"></div>'+
            '</div>'+
        '</div>')

    listarPqr();


});


$(".tablaPQR").on("draw.dt", function(){
    if(localStorage.getItem("quitarPQR") != null){
        var listaidObjetos = JSON.parse(localStorage.getItem("quitarPQR"));
        for(var i = 0; i < listaidObjetos.length; i++)
        {
            $("button.RegresarBotonPQR[idPQR='"+listaidPQRs[i]["idPQR"]+"']").removeClass('btn-default');
            $("button.RegresarBotonPQR[idPQR='"+listaidPQRs[i]["idPQR"]+"']").addClass('btn-success agregarPQR'); 
        }
    }
})

var idquitarPQR = [];
localStorage.removeItem("quitarPQR");

$(".formularioModalRegistros").on("click", "button.quitarPQR", function(){

    $(this).parent().parent().parent().remove();

    var idPQR = $(this).attr("idPQR");

    if(localStorage.getItem("quitarPQR") == null)
    { idquitarPQR = []; 
    }
    else
    { idquitarPQR.concat(localStorage.getItem("quitarPQR"));}

    idquitarPQR.push({"idPQR":idPQR});
    localStorage.setItem("quitarPQR", JSON.stringify(idquitarPQR));

    $("button.RegresarBotonPQR[idPQR='"+idPQR+"']").removeClass("btn-default");
    $("button.RegresarBotonPQR[idPQR='"+idPQR+"']").addClass("btn-success agregarPQR");

    listarPqr();

})

$(".formularioModalRegistros").on("change", "input.nuevoPQRTermino", function(){
  listarPqr();
})

function listarPqr(){

    var listarPQRArray = [];
    var pqr = $(".nuevoPQRRegistro");
    var termino = $(".nuevoPQRTermino");


    for(var i = 0; i < pqr.length; i++){
        listarPQRArray.push({ "id" : $(pqr[i]).attr("idPQR"), 
                              "pqr" : $(pqr[i]).val(),
                              "ter" : $(termino[i]).val()
                            })
    }

    console.log(listarPQRArray);

    $("#listadoPQR").val(JSON.stringify(listarPQRArray)); 

}


//-------------------------------------------------FIN TABLA PQR-------------------------------------------------------

//mostrar registro seleccionado
function envioParametros(es)
{
    var idUser = $("#inputVar").attr("idUser");
    var per = $("#inputVar").attr("per");
    var anio = $("#inputVar").attr("anio");
    paginaCargada(39, idUser, per, anio, es, 0);

    
}

function validarTablaRegistro()
{
    if($('div.div-tablaRegistros').find("table").length)
    {
        $('div.div-tablaRegistros').children().remove();        
    }
}

function aparecerTablaRegistros()
{
    $("div.div-tablaRegistros").append(
        '<table class="table table-bordered table-striped dt-responsive tablaRegistros" width="100%">'+
        '<thead>'+
         '<tr>'+
           '<th>Fecha Radicado</th>'+
           '<th># Radicado</th>'+
           '<th>Estado</th>'+
           '<th>Asunto</th>'+
           '<th>Remitente</th>'+
           '<th>Área</th>'+
           '<th>Encargado</th>'+
           '<th>Fecha Respuesta</th>'+
           '<th>Fecha Vencimiento</th>'+
           '<th>días</th>'+ 
           '<th>Acciones</th>'+
         '</tr>'+
        '</thead>'+
        '</table>'
        );
}

$(".btnImpCorte").click( function(){
    var idC = $(this).attr("idCorte");
    window.open("extensiones/TCPDF-main/examples/corte.php?idC="+idC, "_blank");
});
