<?php
  if(isset($_GET["idRegistro"]) )
  {
    if($_GET["idRegistro"] == null)
    {
      echo'<script> window.location="registros";</script>';
    }
    else
    {
      $valor = $_GET["idRegistro"];
      $registro = ControladorRadicados::ctrAccesoRapidoRegistros($valor, 0);
      $radicado = ControladorRadicados::ctrAccesoRapidoRegistros($valor, 1);

      $fecha = ControladorParametros::ctrOrdenFecha($radicado["fecha"], 0);
      $fecha_vencimiento = ControladorParametros::ctrOrdenFecha($radicado["fecha_vencimiento"], 0);
      $area_responsable = ControladorParametros::ctrmostrarRegistroEspecifico('areas', "id", $registro["id_area"], "nombre");
      $responsable = ControladorParametros::ctrmostrarRegistroEspecifico('usuarios', "id", $registro["id_usuario"], "nombre");
      $estado = ControladorParametros::ctrmostrarRegistroEspecifico('estado_pqr', "id", $registro["id_estado"], "nombre");
    }
  }
  else
  {
   echo'<script> window.location="registros";</script>';
  }
?>
<div class="content-wrapper">
  <section class="content-header">
    <a href="registros">
      <button class="btn btn-success btn-xs"><i class="fa fa-chevron-left"></i> 
        Regresar
      </button>
    </a>
    <br><br>
    <h1>    
      Radicado: <?php echo $radicado["radicado"]." - ".$estado; ?><b></b>  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="registros"> Registros PQR</a></li>    
      <li class="active">Radicado: <?php echo $radicado["radicado"]; ?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Información Registro</h3> 
      </div>    
      <div class="box-body" style="font-size: 18px;">  

         <div class="col-lg-6">

          <dl class="dl-horizontal">
            <dt>Fecha Radicado:</dt>
            <dd><?php echo $fecha; ?></dd>
            <dt>Fecha Vencimiento:</dt>
            <dd><?php echo $fecha_vencimiento; ?></dd>
            <dt>Días Restantes:</dt>
            <dd><?php echo $registro["dias_restantes"]; ?></dd>
            <dt>Estado:</dt>
            <dd><?php echo $estado; ?></dd>
          </dl>


        </div>

        <div class="col-lg-6">

          <dl class="dl-horizontal">
            <dt>Asunto:</dt>
            <dd><?php echo $radicado["asunto"]; ?></dd>
            <dt>Remitente:</dt>
            <dd><?php echo $radicado["id_remitente"]; ?></dd>
            <dt>Área Encargada:</dt>
            <dd><?php echo $area_responsable; ?></dd>
             <dt>Encargado(a):</dt>
            <dd><?php echo $responsable; ?></dd>
          </dl>


        </div>



      </div><!--BOX BODY-->
    </div><!--BOX-->
    <div class="box">
      <div class="box-header">
       <h3 class="box-title">Acciones</h3>
      </div>
      <div class="box-body">
       
      </div>
    </div>

    <div class="row">
<div class="col-md-12">

<ul class="timeline">

<li class="time-label">
<span class="bg-red">
10 Feb. 2014
</span>
</li>


<li>
<i class="fa fa-envelope bg-blue"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
<div class="timeline-body">
Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
weebly ning heekya handango imeem plugg dopplr jibjab, movity
jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
quora plaxo ideeli hulu weebly balihoo...
</div>
<div class="timeline-footer">
<a class="btn btn-primary btn-xs">Read more</a>
<a class="btn btn-danger btn-xs">Delete</a>
</div>
</div>
</li>


<li>
<i class="fa fa-user bg-aqua"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
</div>
</li>


<li>
<i class="fa fa-comments bg-yellow"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
<div class="timeline-body">
Take me to your leader!
Switzerland is small and neutral!
We are more like Germany, ambitious and misunderstood!
</div>
<div class="timeline-footer">
<a class="btn btn-warning btn-flat btn-xs">View comment</a>
</div>
</div>
</li>


<li class="time-label">
<span class="bg-green">
3 Jan. 2014
</span>
</li>


<li>
<i class="fa fa-camera bg-purple"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
<div class="timeline-body">
<img src="https://placehold.it/150x100" alt="..." class="margin">
<img src="https://placehold.it/150x100" alt="..." class="margin">
<img src="https://placehold.it/150x100" alt="..." class="margin">
<img src="https://placehold.it/150x100" alt="..." class="margin">
</div>
</div>
</li>


<li>
<i class="fa fa-video-camera bg-maroon"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
<h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
<div class="timeline-body">
<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen=""></iframe>
</div>
</div>
<div class="timeline-footer">
<a href="#" class="btn btn-xs bg-maroon">See comments</a>
</div>
</div>
</li>

<li>
<i class="fa fa-clock-o bg-gray"></i>
</li>
</ul>
</div>

</div>


  </section>
</div>
