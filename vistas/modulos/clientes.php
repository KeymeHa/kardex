<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" id="btn-nuevaCliente" data-toggle="modal" data-target="#modalAgregarCliente"><i class="fa fa-user-plus"></i>
          Nuevo Cliente
        </button>


      </div>

      <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive tablaClientes" width="100%">
         
          <thead>
           
           <tr>
             <th style="width:10px">#</th>
             <th>Nombre</th>
             <th>Identificación</th>
             <th>Telefono</th>
             <th>Correo</th>
             <th>Compras</th>
             <th>Acciones</th>
           </tr> 

          </thead>

          </table>

      </div>


    </div>

  </section>

</div>



<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#00A65A; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Cliente</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">
            <div class="box-body">
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                  <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cc-discover"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoID" id="nuevoID" placeholder="Identificación" min="0" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-at"></i></span> 
                  <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar correo Electronico" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefóno" required>
                </div>
              </div>

              
          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Agregar Cliente</button>
        </div>

      <?php
          $crearCli = new ControladorClientes();
          $crearCli -> ctrCrearCliente();
      ?>

      </form>


    </div><!--modal-content-->
  </div><!--modal-dialog-->

</div><!--modalAgregarPersona-->
