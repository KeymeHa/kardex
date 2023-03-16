<header class="main-header">
	<a href="inicio" class="logo">
		<span class="logo-mini">
			<b>S</b>M
		</span>
		<span class="logo-lg">
			<b>S</b>ITMI<em style="font-size: 12px !important;">Versión 2.9 Beta</em>
		</span>
	</a>
	<nav class="navbar navbar-static-top" role="navigation">
	 	<a href="#" id="btn-sidebar-toggle" class="sidebar-toggle" data-toggle="push-menu" role="button">
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
		              elseif ($_SESSION["perfil"] == 7) 
		              {
		              	# code...
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

		         <?php

		         if ($_SESSION["perfil"] == 7 || $_SESSION["perfil"] == 11) 
		         {
		         	$fechaInicial = null;
				     $fechaFinal = null;

				     if (isset($_GET["fechaInicial"])) 
				      {
				        $fechaInicial = $_GET["fechaInicial"];
				        $fechaFinal = $_GET["fechaFinal"];
				      }

				       $porcentaje = ControladorRadicados::ctrCuadrantesRegistros($_SESSION["perfil"], $_SESSION["anioActual"], $fechaInicial, $fechaFinal);

				      if (isset($porcentaje)) 
				         {
				         	echo '<li class="dropdown tasks-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">!</span>	
							</a>

							<ul class="dropdown-menu">
								<li class="header">Progreso Cuadrantes <strong>PQR</strong> </li>
								<li>
									<ul class="menu">
										<li>';


								//vencidas

								echo (isset($porcentaje[3]["per"])) ? '<a href="#">
												<h3>
												Vencidas
												<small class="pull-right">'.$porcentaje[3]["per"].'%</small>
												</h3>
												<div class="progress xs">
												<div class="progress-bar progress-bar-red" style="width: '.$porcentaje[3]["per"].'%" role="progressbar" aria-valuenow="'.$porcentaje[3]["per"].'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>
											</a>' : '' ;

								//pendientes

								echo ( isset($porcentaje["percentCuad3"][0]) )? '<a href="#">
												<h3>
												Pendientes
												<small class="pull-right">'.$porcentaje["percentCuad3"][0].'%</small>
												</h3>
												<div class="progress xs">
												<div class="progress-bar progress-bar-yellow" style="width: '.$porcentaje["percentCuad3"][0].'%" role="progressbar" aria-valuenow="'.$porcentaje["percentCuad3"][0].'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>
											</a>' : "0%" ;

								//extemporaneas

								echo (isset($porcentaje[4])) ? '<a href="#">
												<h3>
												Extemporaneas
												<small class="pull-right">'.$porcentaje[4]["per"].'%</small>
												</h3>
												<div class="progress xs">
												<div class="progress-bar progress-bar-orange" style="width: '.$porcentaje[4]["per"].'%" role="progressbar" aria-valuenow="'.$porcentaje[4]["per"].'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>
											</a>' : '' ;

								//Resueltas

								echo ( isset($porcentaje["percentCuad1"][0]) ) ? '<a href="#">
												<h3>
												Reueltas
												<small class="pull-right">'.$porcentaje["percentCuad1"][0].'%</small>
												</h3>
												<div class="progress xs">
												<div class="progress-bar progress-bar-green" style="width: '.$porcentaje["percentCuad1"][0].'%" role="progressbar" aria-valuenow="'.$porcentaje["percentCuad1"][0].'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>
											</a>' : '' ;

									echo '
										</li><!--<ul class="menu">-->
									</ul>
								</li>
							</ul>
						</li>';
				         }

		         }//if ($_SESSION["perfil"] == 7 || $_SESSION["perfil"] == 11) 


		         ?>

				<!---		MENU DEL USUARIO 		--->						
				<li class="dropdown user user-menu">				
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">				
						<img src="<?php if($_SESSION["foto"] != ""){ echo $_SESSION["foto"]; }else{ echo'vistas/img/usuarios/default/anonymous.png'; }?>"  class="user-image">
						<span class="hidden-xs">
							<?php
							echo $_SESSION["nombre"];
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
