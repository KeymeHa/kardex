<?php
//CONTROLADORES
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/insumos.controlador.php";
require_once "controladores/areas.controlador.php";
require_once "controladores/personas.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/facturas.controlador.php";
require_once "controladores/anexos.controlador.php";
require_once "controladores/parametros.controlador.php";
require_once "controladores/inversion.controlador.php";
require_once "controladores/config.php";
require_once "controladores/movimientos.controlador.php";
require_once "controladores/requisiciones.controlador.php";
require_once "controladores/ordencompra.controlador.php";
require_once "controladores/actas.controlador.php";
require_once "controladores/historial.controlador.php";
require_once "controladores/proyectos.controlador.php";
//MODELOS
require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/insumos.modelo.php";
require_once "modelos/areas.modelo.php";
require_once "modelos/personas.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/facturas.modelo.php";
require_once "modelos/anexos.modelo.php";
require_once "modelos/parametros.modelo.php";
require_once "modelos/inversion.modelo.php";
require_once "modelos/movimientos.modelo.php";
require_once "modelos/requisiciones.modelo.php";
require_once "modelos/ordenCompra.modelo.php";
require_once "modelos/actas.modelo.php";
require_once "modelos/historial.modelo.php";
require_once "modelos/proyectos.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
