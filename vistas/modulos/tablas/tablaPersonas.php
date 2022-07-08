 <table class="table table-bordered table-striped dt-responsive tablaPersonas" width="100%">
         
<thead>
 
 <tr>
   
   <th style="width:10px">#</th>
   <th>Nombre</th>
   <?php if($_GET["ruta"] != "verArea"){echo '<th>Area</th>';}?>
   <?php if($_GET["ruta"] != "asignaciones"){echo '<th>Requisiciones</th><th>Acciones</th>';}else{ echo '<th>Estado</th>';}?>
   

 </tr> 

</thead>

</table>