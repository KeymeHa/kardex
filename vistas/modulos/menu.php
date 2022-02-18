<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">

			<li <?php if(isset($_GET["ruta"])){ if($_GET["ruta"] == "inicio"){ echo'class="active"'; } }else{ echo'class="active"';}?>>
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>
			
			<li <?php if(isset($_GET["ruta"])){ if($_GET["ruta"] == "usuarios" || $_GET["ruta"] == "perfil"){ echo'class="active"'; } }?>>

				<a href="perfil">
					<i class="fa fa-user"></i>
					<span>Perfil</span>
				</a>
				
				<?php 
					if($_SESSION["perfil"] == "1" || $_SESSION["perfil"] == "2")
					{
						echo'<a href="usuarios">
								<i class="fa fa-user"></i>
								<span>Usuarios</span>
							</a>';
					}
				?>

			</li>

			<li class="treeview <?php if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'inventario' || $_GET['ruta'] == 'insumos' || $_GET['ruta'] == 'categorias' || $_GET['ruta'] == 'verCategoria' ){ echo 'active';} }?>">
				<a href="inventario">
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

			<li class="treeview <?php if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'generaciones' || $_GET['ruta'] == 'pedidos' || $_GET['ruta'] == 'cotizaciones' || $_GET['ruta'] == 'ordendecompras' || $_GET['ruta'] == 'facturas'){ echo 'active';} }?>">
				<a href="#">
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

			<li class="treeview <?php if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'requisiciones' || $_GET['ruta'] == 'areas' || $_GET['ruta'] == 'personas' || $_GET['ruta'] == 'areas' || $_GET['ruta'] == 'verArea'){ echo 'active';} }?>">
				<a href="#">
					<i class="fa fa-file-text-o"></i>
					<span>Requisiciones</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="areas"><i class="fa fa-users"></i>Areas</a></li>
					<li><a href="proyectos"><i class="fa fa-user"></i>Proyectos</a></li>
					<li><a href="personas"><i class="fa fa-user"></i>Personas</a></li>
					<li><a href="requisiciones"><i class="fa fa-file-text"></i>Requisiciones</a></li>
				</ul>

			</li>

			<li <?php if(isset($_GET["ruta"])){ if($_GET["ruta"] == "proveedores" || $_GET["ruta"] == "proveedor" ){ echo'class="active"'; } }?>>
				<a href="proveedores">
					<i class="fa  fa-briefcase"></i>
					<span>Proveedores</span>
				</a>
			</li>

			<li class="treeview <?php if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'historialUsuarios' || $_GET['ruta'] == 'historialInsumos' || $_GET['ruta'] == 'historialCategorias' || $_GET['ruta'] == 'historialAreas' || $_GET['ruta'] == 'historialPersonas' || $_GET['ruta'] == 'historialOrdenes' || $_GET['ruta'] == 'historialRq'){ echo 'active';} }?>">
				<a href="#">
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

			<li class="treeview <?php if( isset($_GET['ruta']) ){ if($_GET['ruta'] == 'actas' || $_GET['ruta'] == 'VerActa' || $_GET['ruta'] == 'editarActa'){ echo 'active';} }?>">
				<a href="actas">
					<i class="fa fa-file"></i>
					<span>Actas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-tight"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="actas"><i class="fa fa-file-o"></i>Listado de Actas</a></li>
				</ul>
			</li>
		</ul>
	 </section>
</aside>
