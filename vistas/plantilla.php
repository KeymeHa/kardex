<?php
    session_start();
    /*
    $area = ControladorParametros::ctrValidarCaracteres($_POST["editarArea"]);
  .replace(/&quot/gi,'"')     convertir de quot a comillas
  .replace(/"/gi,'&quot')   convertir comillas a quot
    */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SITMI | <?php if(isset($_GET["ruta"])){echo $_GET["ruta"];}else{echo 'Inicio';}?></title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--<link rel="icon" href="vistas/img/plantilla/icono-blanco.png">-->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>
  <script src="vistas/plugins/jQueryNumber/jquerynumber.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
</head>
<body class="hold-transition skin-green sidebar-collapse sidebar-mini login-page">
   <?php
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" ) 
    {
      echo '<div class="wrapper">';
      include "modulos/cabezote.php";
      include "modulos/menu.php";
      if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "inicio" ||
           $_GET["ruta"] == "usuarios" ||
           $_GET["ruta"] == "actas" ||
           $_GET["ruta"] == "editarActa" ||
           $_GET["ruta"] == "verActa" ||
           $_GET["ruta"] == "verArea" ||
           $_GET["ruta"] == "nuevaActa" ||
           $_GET["ruta"] == "insumos" ||
           $_GET["ruta"] == "categorias" ||
           $_GET["ruta"] == "verCategoria" ||
           $_GET["ruta"] == "generaciones" ||
           $_GET["ruta"] == "pedidos" ||
           $_GET["ruta"] == "ordendecompras" ||
           $_GET["ruta"] == "editarOrden" ||
           $_GET["ruta"] == "verOrden" ||
           $_GET["ruta"] == "nuevaOrdendeCompras" ||
           $_GET["ruta"] == "cotizaciones" ||
           $_GET["ruta"] == "facturas" ||
           $_GET["ruta"] == "personas" ||
           $_GET["ruta"] == "requisiciones" ||
           $_GET["ruta"] == "requisicion" ||
           $_GET["ruta"] == "verRequisicion" ||
           $_GET["ruta"] == "areas" ||
           $_GET["ruta"] == "proveedores" ||
           $_GET["ruta"] == "proveedor" ||
           $_GET["ruta"] == "nuevaFactura" ||
           $_GET["ruta"] == "verFactura" ||
           $_GET["ruta"] == "inventario" ||
           $_GET["ruta"] == "creditos" ||
           $_GET["ruta"] == "historialUsuarios" ||
           $_GET["ruta"] == "historialInsumos" ||
           $_GET["ruta"] == "historialOrdenes" ||
           $_GET["ruta"] == "historialRq" ||
           $_GET["ruta"] == "historialCategorias" ||
           $_GET["ruta"] == "historialAreas" ||
           $_GET["ruta"] == "historialPersonas" ||
           $_GET["ruta"] == "requisicionImportada" ||
           $_GET["ruta"] == "editarRq" ||
           $_GET["ruta"] == "editarRequisicion" ||
           $_GET["ruta"] == "editarFactura" ||
           $_GET["ruta"] == "reportes" ||
           $_GET["ruta"] == "reportesRq" ||
           $_GET["ruta"] == "perfil" ||
           $_GET["ruta"] == "rt" ||
           $_GET["ruta"] == "salir"){


            $paginaCargada = '<script type="text/javascript">
                $( document ).ready(function() {
                  var pagina = ';
            if($_GET["ruta"] == "categorias")
            {$paginaCargada.="1";}
            elseif($_GET["ruta"] == "verCategoria")
            {$paginaCargada.="2";}
            elseif($_GET["ruta"] == "insumos")
            {$paginaCargada.="3";}
            elseif ($_GET["ruta"] == "ordendecompras") 
            {$paginaCargada.="4";}
            elseif ($_GET["ruta"] == "facturas") 
            {$paginaCargada.="5";}
            elseif ($_GET["ruta"] == "requisiciones") 
            {$paginaCargada.="8";}
            elseif ($_GET["ruta"] == "nuevaFactura" || $_GET["ruta"] == "editarFactura") 
            {$paginaCargada.="10";}
            elseif ($_GET["ruta"] == "requisicion" || $_GET["ruta"] == "requisicionImportada" || $_GET["ruta"] == "editarRq")
            {$paginaCargada.="11";}
            elseif ($_GET["ruta"] == "actas")
            {$paginaCargada.="14";}
            elseif ($_GET["ruta"] == "areas")
            {$paginaCargada.="15";}
            elseif ($_GET["ruta"] == "personas")
            {$paginaCargada.="16";}
            elseif ($_GET["ruta"] == "inicio" || $_GET["ruta"] == "reportesRq")
            {$paginaCargada.="17";}
            elseif ($_GET["ruta"] == "verArea")
            {$paginaCargada.="18";}
            elseif ($_GET["ruta"] == "proveedor")
            {$paginaCargada.="19";}
            else
            {$paginaCargada.="0";}

            $paginaCargada .= ';paginaCargada(pagina);});</script>';

            echo $paginaCargada;

          include "modulos/".$_GET["ruta"].".php";
          include "modulos/notificaciones-modal.php";
          include "modulos/li.php";
        }else{
          include "modulos/404.php";
        }      
      }
      else
      {
        include "modulos/inicio.php";
      }  
      include "modulos/footer.php";
      echo '</div>';    

      $js_files = ControladorParametros::ctrJs_Files();

      foreach ($js_files as $key => $value) 
      {

        //Si es tiene all hacer echo sino, if esta definido GEt ruta
        
        if ($value["habilitado"] == "all") 
        {
         echo '<script type="text/javascript" src="vistas/js/'.$value["nombre"].'.js"></script>';
        }
        else
        {
          if ( isset($_GET["ruta"]) ) 
          {
            if ($value["habilitado"] == $_GET["ruta"]) 
            {
              echo '<script type="text/javascript" src="vistas/js/'.$value["nombre"].'.js"></script>';
            }
            elseif($value["habilitado"] == "none")
            {

            }
          }
          else
          {
            echo '<script> window.location="inicio"; </script>';
          }
        }
        
      }//foreach js_files
    }
    else
    {
      include "modulos/login.php";
    }  
  ?>
</body>
</html>
