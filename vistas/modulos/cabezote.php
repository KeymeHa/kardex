<header class="main-header">
	<a href="inicio" class="logo">
		<span class="logo-mini">
			<b>S</b>M
		</span>
		<span class="logo-lg">
			<b>S</b>ITMI<em style="font-size: 12px !important;">Versión 1.0 Alpha</em>
		</span>
	</a>
	<nav class="navbar navbar-static-top" role="navigation">
	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	<span class="sr-only">Toggle navigation</span>	      
      	</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown notifications-menu">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		              <i class="fa fa-bell-o"></i>
		              <?php 
		              	$noti = 0;

		              

		              if ($_SESSION["perfil"] == 3) {
		              	$agotado = ControladorInsumos::ctrVerificarInsAgotados(null, null);
		              	$escasos = ControladorInsumos::ctrVerificarInsEscasos(null, null);
		              	$solicitud = ControladorRequisiciones::ctrContarRequisicionesAppr($_SESSION["anioActual"]);

		              	if($agotado != 0)
		              	{$noti+= 1;}
		              	if($escasos != 0)
		              	{$noti+= 1;}
		              	if($solicitud != 0)
		              	{$noti+= 1;}

		              	if ($noti > 0) {

		              		echo '
		              		<span class="label label-warning">'.$noti.'</span>';
		              	}
		              }
		              ?>
		              
		            </a>
		            <ul class="dropdown-menu">
		              <li class="header">Notificaciones</li>
		              <li>
		                <ul class="menu">
		                  
		                    	<?php

		                    		if ($_SESSION["perfil"] == 3) 
		                    		{
		                    			if($agotado != 0)
				                    	{
				                    		echo'<li><a href="#"><i class="fa fa-warning text-red"></i>Hay '.$agotado.' Insumos Agotados &nbsp &nbsp<button class="btn btn-success btn-xs btnNotificaciones" valor="1" data-toggle="modal" data-target="#modal-Notificaciones"> Ver</button></a></li>';
				                    	}

				                    	if($escasos != 0)
				                    	{
				                    		echo'<li><a href="#"><i class="fa fa-warning text-yellow"></i>Hay '.$escasos.' Insumos Por agotarse &nbsp &nbsp<button class="btn btn-success btn-xs btnNotificaciones" valor="2" data-toggle="modal" data-target="#modal-Notificaciones"> Ver</button></a></li>';
				                    	}

				                    	if($solicitud != 0)
				                    	{
				                    		echo'<li><a href="requisiciones"><i class="fa fa-shopping-cart text-green"></i>Hay '.$solicitud.' Solicitud(es) de insumos</a></li>';
				                    	}
		                    		}
		                    	?>
		                    
		                </ul>
		              </li>
		              <?php

		              	if( $noti == 0)
		              	{
		              		echo'<li class="footer"><a href="#">¡Todo Bien!</a></li>';
		              	}

		              ?>
		              <!--<li class="footer"><a href="#">Ver Todos</a></li>-->
		            </ul>
		          </li>							
				<li class="dropdown user user-menu">				
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">				
						<img src="<?php if($_SESSION["foto"] != ""){ echo $_SESSION["foto"]; }else{ echo'vistas/img/usuarios/default/anonymous.png'; }?>"  class="user-image">
						<span class="hidden-xs">
							<?php
							echo $_SESSION["usuario"];
							?>
						</span>
					</a>
					<ul class="dropdown-menu">
		              <li class="user-header">
		                <img src="<?php if($_SESSION["foto"] != ""){ echo $_SESSION["foto"]; }else{ echo'vistas/img/usuarios/default/anonymous.png'; }?>" class="img-circle" alt="User Image">
		                <p>
		                  <?php
						echo $_SESSION["nombre"];
						?>
		                </p>
		              </li>
		              <li class="user-footer">
		              	<div class="pull-left">
		                  <a href="creditos" class="btn btn-default btn-flat">Creditos</a>
		                </div>
		                <div class="pull-right">
		                  <a href="salir" class="btn btn-danger btn-flat"><i class="fa  fa-sign-out"></i> Cerrar Sesión</a>
		                </div>
		              </li>
		            </ul>
				</li>
			</ul>
		</div>
	</nav>
 </header>
