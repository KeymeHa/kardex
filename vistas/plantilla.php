<?php
    session_start();
    if (isset($_GET["ruta"])) 
    {
       $js_data = ControladorParametros::ctrJs_data($_GET["ruta"]);
    }
    else
    {
      
    }
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
  <title>SITMI | <?php if(isset($js_data["title"])){echo $js_data["title"];}else{echo 'Dashboard';}?></title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="vistas/img/plantilla/icono-blanco.png">
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "p3ddmfgqi4j0410jfqukfvv82j" ) 
    {
      echo '<div class="wrapper">';
      include "modulos/cabezote.php";
      include "modulos/menu.php";

      if(isset($_GET["ruta"])){

        $documento = "vistas/modulos/".$_GET["ruta"].".php";

        if(file_exists($documento)){

          
           $gatillo = ControladorParametros::ctrValidarPermiso($_SESSION["perfil"], $js_data);

          if ($gatillo == 1) 
          {  

            if ( $js_data != null ) 
            {
                $paginaCargada = '<script type="text/javascript">
                  $( document ).ready(function() {
                    var pagina = '.$js_data["num"].';';

                $paginaCargada .= 'paginaCargada(pagina);});</script>';

                echo $paginaCargada;
            }

            if ($js_data["sw"] == 1) 
            {
              include "modulos/".$_GET["ruta"].".php";
            }
            else
            {
              include "modulos/404.php";
            }

            include "modulos/notificaciones-modal.php";
            include "modulos/li.php";
          }
          else
          {
            include "modulos/noAutorizado.php";
          }

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
      if (isset($_SESSION["iniciarSesion"])) 
      {
        session_destroy();
      }
      
      include "modulos/login.php";
    }  
  ?>
</body>
</html>
