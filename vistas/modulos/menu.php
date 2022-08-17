<aside class="main-sidebar">

	<section class="sidebar" style="height: auto;">

		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php if($_SESSION["foto"] != ""){ echo $_SESSION["foto"]; }else{ echo'vistas/img/usuarios/default/anonymous.png'; }?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">

			<p><?php echo $_SESSION["nombre"];?></p>

			<a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
			</div>
		</div>

	<ul class="sidebar-menu tree" data-widget="tree">

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

		//ADMINISTRADOR

		if ($_SESSION["perfil"] == "1" ||  $_SESSION["perfil"] == "2") 
		{
			echo '<li ';
			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'usuarios' ){ echo 'active';} }

			echo '><a href="usuarios">
					<i class="fa fa-users"></i>
					<span>Usuarios</span>
				</a></li>';

			echo '<li class="header">Inventario Equipos de Computo</li>';

			echo '<li ';
			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'usuarios' ){ echo 'active';} }

			echo '><a href="equipos">
					<i class="fa fa-desktop"></i>
					<span>Base de Datos PC</span>
				</a></li>';

		}

		//COMPRAS

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

		//CONFIGURACION

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


		//VENTAS

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


		//CORRESPONDENCIA


			if ( $_SESSION["perfil"] == 1 || $_SESSION["perfil"] == 2 || $_SESSION["perfil"] == 6) {

			echo '<li class="header">Correspondencia y Mensajería</li>

			<li class="treeview ';

			if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'radicado' || $_GET['ruta'] == 'cortes' || $_GET['ruta'] == 'verCorte' || $_GET['ruta'] == 'verRadicado' || $_GET['ruta'] == 'correspondencia'){ echo 'active';} }

			echo '"><a href="#">
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

						if ($_SESSION["perfil"] == '7' || $_SESSION["perfil"] == '3') {

			echo '<li class="header">Asignaciones de Correspondencia</li>

				<li ';

				if ( isset($_GET["ruta"]) ) { if($_GET["ruta"] == "asignaciones"){ echo'class="active"'; }	}

				echo'><a href="index.php?ruta=asignaciones&idusr='.$_SESSION["id"].'&p='.$_SESSION["perfil"].'">
						<i class="fa fa-check-circle"></i>
						<span>Asignaciones</span>
					</a>
				</li>';
			}

			if ($_SESSION["perfil"] == '7' ) {
				echo '<li ';



			if ( isset($_GET["ruta"]) ) { if($_GET["ruta"] == "registros"){ echo'class="active"'; }	}

				echo'><a href="registros">
						<i class="fa fa-balance-scale"></i>
						<span>Registros de PQR</span>
					</a>
				</li>
			

			<li ';

			if(isset($_GET["ruta"])){ if($_GET["ruta"] == "parametros"){ echo'class="active"'; } }


			if($_SESSION["perfil"] == "7")
					{
						echo'><a href="parametros">
								<i class="fa fa-cogs"></i>
								<span>Parametros</span>
							</a>';
					}

			echo '</li>';

			}

		//ENCARGADOS

		$idmodulo = 3;
			$verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

			if ( isset($verModulo["modulo"]) &&  $verModulo["modulo"] == $idmodulo) 
			{
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
						<li><a href="genRequisicion"><i class="fa fa-envelope-square"></i>Nuevo Requisición</a></li>
						<li><a href="hisRequisicion"><i class="fa fa-clone"></i>Historial</a></li>
					</ul>
				</li>';
			}

			$idmodulo = 7;
			$verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

			if ( isset($verModulo["modulo"]) &&  $verModulo["modulo"] == $idmodulo) 
			{

			echo '<li';

			if ( isset($_GET["ruta"]) ) { if($_GET["ruta"] == "correspondencia"){ echo'class="active"'; }	}

				echo'><a href="registros">
						<i class="fa fa-balance-scale"></i>
						<span>Registros de PQR</span>
					</a>
				</li>';

			}



		//JURIDICA






		?>

	</ul><!--sidebar-menu tree-->

	</section>

</aside>