<div class="login-box">
  
  <div class="login-logo">

    <div class="login-logo">

    <img src="vistas/img/plantilla/logoEdubar.png" class="img-responsive" style="padding:30px 100px 0px 100px">

  </div>

    <h1>SITMI</h1><em style="font-size: 12px !important; color: red;">Versión 1.9 Beta</em>

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <?php

    echo (isset($modoManto["modomanto"]) && $modoManto["modomanto"] == 1) ? ' <div class="alert alert-warning alert-dismissible">
      <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
      Plataforma en mantenimiento. Agradecemos su comprensión.
    </div>' : '' ;

    ?>

   

    <form method="post">


      <!--CAMPO   USUARIO-->

     

          <?php

          echo ( isset($modoManto["modomanto"]) && $modoManto["modomanto"] != 1 ) ? ' <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>


      <!--CAMPO   CONTRASEÑA-->

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="row">
       
        <div class="col-xs-4"><button type="submit" class="btn btn-success btn-block btn-flat">Ingresar</button>' : '' ;

          ?>

        </div>

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>
