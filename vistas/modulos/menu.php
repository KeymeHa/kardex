<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">

			<li <?php if(isset($_GET["ruta"])){ if($_GET["ruta"] == "inicio"){ echo'class="active"'; } }else{ echo'class="active"';}?>>

			<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>

			<li <?php if(isset($_GET["ruta"])){ if($_GET["ruta"] == "perfil"){ echo'class="active"'; } }?>><a href="perfil">
					<i class="fa fa-user"></i>
					<span>Perfil</span>
				</a>

			</li>


			

			<?php

			///usuarios

			if ($_SESSION["perfil"] == "1" ||  $_SESSION["perfil"] == "2") 
			{
				echo '<li ';
				if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'usuarios' ){ echo 'active';} }

				echo '><a href="usuarios">
						<i class="fa fa-users"></i>
						<span>Usuarios</span>
					</a></li>';

			}


			///inventario

			if ($_SESSION["perfil"] == "1" ||  $_SESSION["perfil"] == "2" || $_SESSION["perfil"] == "3" ) 
			{
				echo '

			<li class="header">Inventario y Bodega</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'inventario' || $_GET['ruta'] == 'insumos' || $_GET['ruta'] == 'categorias' || $_GET['ruta'] == 'verCategoria' ){ echo 'active';} }

			echo '"><a href="inventario">
					<i class="fa fa-shopping-cart"></i>
					<span>Inventario</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="categorias"><i class="fa fa-reorder"></i>Categorias</a></li>
					<li><a href="insumos"><i class="fa fa-briefcase"></i>Insumos</a></li>
				</ul>

			</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'generaciones' || $_GET['ruta'] == 'pedidos' || $_GET['ruta'] == 'cotizaciones' || $_GET['ruta'] == 'ordendecompras' || $_GET['ruta'] == 'facturas'){ echo 'active';} }

			echo '"><a href="#">
					<i class="fa fa-file-text-o"></i>
					<span>Generaciones</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<!--<li><a href="pedidos"><i class="fa fa-file-text"></i>Pedidos</a></li>-->
					<li><a href="cotizaciones"><i class="fa fa-file-text"></i>Cotizaciones</a></li>
					<li><a href="ordendecompras"><i class="fa fa-file-text"></i>Ordenes de Compra</a></li>
					<li><a href="facturas"><i class="fa fa-file-text"></i>Facturas</a></li>
				</ul>
			</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'requisiciones' || $_GET['ruta'] == 'areas' || $_GET['ruta'] == 'personas' || $_GET['ruta'] == 'areas' || $_GET['ruta'] == 'verArea' || $_GET['ruta'] == 'proyectos'){ echo 'active';} }

			echo '"><a href="#">
					<i class="fa fa-file-text-o"></i>
					<span>Requisiciones</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">';

					if ($_SESSION["perfil"] == 1 ||  $_SESSION["perfil"] == 2 ) 
					{
						echo '<li><a href="areas"><i class="fa fa-users"></i>Areas</a></li>';
					}

					
					echo '<li><a href="proyectos"><i class="fa fa-user"></i>Proyectos</a></li>
					<li><a href="personas"><i class="fa fa-user"></i>Personas</a></li>
					<li><a href="requisiciones"><i class="fa fa-file-text"></i>Requisiciones</a></li>
				</ul>

			</li>

			<li ';

			if(isset($_GET["ruta"])){ if($_GET["ruta"] == "proveedores" || $_GET["ruta"] == "proveedor" ){ echo'class="active"'; } }

			echo '><a href="proveedores">
					<i class="fa  fa-briefcase"></i>
					<span>Proveedores</span>
				</a>
			</li>

			<li class="treeview ';

			 if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'actas' || $_GET['ruta'] == 'VerActa' || $_GET['ruta'] == 'editarActa'){ echo 'active';} }

			 echo '"><a href="actas">
					<i class="fa fa-file"></i>
					<span>Actas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="actas"><i class="fa fa-file-o"></i>Listado de Actas</a></li>
				</ul>
			</li>';
			}

			///configuraciones

			if ($_SESSION["perfil"] == 1 ||  $_SESSION["perfil"] == 2 ) 
			{
				echo '<li class="header">Configuraciones</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'historialUsuarios' || $_GET['ruta'] == 'historialInsumos' || $_GET['ruta'] == 'historialCategorias' || $_GET['ruta'] == 'historialAreas' || $_GET['ruta'] == 'historialPersonas' || $_GET['ruta'] == 'historialOrdenes' || $_GET['ruta'] == 'historialRq'){ echo 'active';} }

			echo '"><a href="#">
					<i class="fa fa-calendar-minus-o"></i>
					<span>Historiales</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="historialUsuarios"><i class="fa fa-reorder"></i>Hist. Usuarios</a></li>
					<li><a href="historialInsumos"><i class="fa fa-reorder"></i>Hist. Insumos</a></li>
					<li><a href="historialCategorias"><i class="fa fa-briefcase"></i>Hist. Categorias</a></li>
					<li><a href="historialAreas"><i class="fa fa-briefcase"></i>Hist. Areas</a></li>
					<li><a href="historialPersonas"><i class="fa fa-briefcase"></i>Hist. Personas</a></li>
					<li><a href="historialOrdenes"><i class="fa fa-briefcase"></i>Hist. Ordenes</a></li>
					<li><a href="historialRq"><i class="fa fa-briefcase"></i>Hist. Requisiciones</a></li>
				</ul>
			</li>

			<li ';

			if(isset($_GET["ruta"])){ if($_GET["ruta"] == "parametros"){ echo'class="active"'; } }


			if($_SESSION["perfil"] == "1" || $_SESSION["perfil"] == "2")
					{
						echo'><a href="parametros">
								<i class="fa fa-cogs"></i>
								<span>Parametros</span>
							</a>';
					}

			echo '</li>';
			}

			

			
			//ventas

			if ( $_SESSION["perfil"] == "1" || $_SESSION["perfil"] == "2" || $_SESSION["perfil"] == "5" || $_SESSION["perfil"] == "8") 
			{

				echo '
				<li class="header">Modulo Ventas</li>
				<li ';

				if ( isset($_GET["ruta"]) ) { if($_GET["ruta"] == "clientes"){ echo'class="active"'; }	}

				echo'><a href="clientes">
						<i class="fa fa-users"></i>
						<span>Clientes</span>
					</a>
				</li>

				<li ';

				if ( isset($_GET["ruta"]) ) { if($_GET["ruta"] == "ventas"){ echo'class="active"'; }	}

						echo'><a href="ventas">
								<i class="fa fa-cart-plus"></i>
								<span>Ventas</span>
							</a>
						</li>';
			}

			//Correspondencias

			if ( $_SESSION["perfil"] == 1 || $_SESSION["perfil"] == 2 || $_SESSION["perfil"] == 6 || $_SESSION["perfil"] == 7) {

			echo '<li class="header">Correspondencia y Mensajería</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'radicado' || $_GET['ruta'] == 'cortes' || $_GET['ruta'] == 'verCorte' || $_GET['ruta'] == 'verRadicado' || $_GET['ruta'] == 'correspondencia'){ echo 'active';} }

			echo '"><a href="correspondencia">
					<i class="fa fa-envelope-o"></i>
					<span>Correspondencia</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="radicado"><i class="fa fa-envelope-square"></i>Panel de Radicados</a></li>
					<li><a href="cortes"><i class="fa fa-clone"></i>Cortes y planillas</a></li>
				</ul>
			</li>';
				
			}

			//Generar requisicion

			if ( $_SESSION["perfil"] == 7 || $_SESSION["perfil"] == 8 || $_SESSION["perfil"] == 4) {

			echo '<li class="header">Mis Requisiciones</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'genRequisicion' || $_GET['ruta'] == 'hisRequisicion'){ echo 'active';} }

			echo '"><a href="#">
					<i class="fa fa-envelope-o"></i>
					<span>Requisiciones</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="genRequisicion"><i class="fa fa-envelope-square"></i>Nuevo Radicado</a></li>
					<li><a href="hisRequisicion"><i class="fa fa-clone"></i>Historial</a></li>
				</ul>
			</li>';
				
			}

			?>

		</ul>
	 </section>
</aside>
