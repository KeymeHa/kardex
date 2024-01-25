# [SICOR] - Kardex

Este aplicativo permite gestionar un inventario interno donde los usuarios pueden realizar pedidos y aisgnar perfiles para tener acceso a ciertos módulos y acciones, permite ademas manejar un sistema de correspondencia permitiendo radicar documentos para darle manejo interno de estos que dependiendo al área y su encargado pueden realizar tramites o reasignar algún documento, incluye un módulo que maneja inventario de computadores llevando la trazabilidad de cada uno de ellos con manejo de linea de tiempo que alamacena toda las acciones realizada a cada uno de ellos.
Aplicativo web que cuenta con los siguientes módulos:

- Módulo Usuarios.
- Módulo Dependencias
	- Áreas.
	- Personas.
- Módulo Inventario
	- Categorias.
	- Insumos.
	- Remisiones / Facturas (Ingreso de Stock) .
	- Requisiciones (Pedidos de los usuarios).
	- Proveedores
- Módulo Equipos de Cómputo
	- Base de datos Computadores.
	- Licencias.
	- Parametros.
	- Actas de ingreso.
- Módulo de Correspondencia
	- Radicados.
	- Cortes y planillas.
	- Asignación de correspondencia.

# Template

AdminLTE2 -> https://github.com/ColorlibHQ/AdminLTE.git

# plug-in

DataTables -> https://github.com/DataTables/DataTables
Sweet Alert 2 -> https://github.com/sweetalert2/sweetalert2
TCPDF -> https://github.com/tecnickcom/TCPDF


## Installing

Clona este repositorio https://github.com/KeymeHa/kardex.git 

1 -  En la ruta /modelos/conexion Modificar las credenciales de la base de datos.
2 -  Importa el archivo migration.sql en tu base de datos.
3 -  Dirigete a /vistas/img/plantilla/ modifica el archivo logo.png
4 -  Usuario y contraseña por defecto:
	Usuario: Admin
	Contraseña: 1234567890

## Documentation

Para conocer de manera detallada el funcionamiento dirigirse a https://github.com/KeymeHa/kardex/blob/main/vistas/doc/Manual_Usuario_Kardex.pdf


## Support

Para obtener soporte o notificar algún error https://github.com/KeymeHa

## Future
- Importar Bases de datos por medio de archivo plano u hoja de cálculo para insumos, Computadores. 
- Mejorar el sistema de historial de cada una de las acciones realizadas en cada módulo.
- Implementar un módulo que registre los manejo a otros dispositivos o electrodomesticos que registre los mantenimientos, mejoras entre otras funciones.


## License

Este aplicativo es de uso libre.
