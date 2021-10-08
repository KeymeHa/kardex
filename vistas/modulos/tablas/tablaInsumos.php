<table class="table table-bordered table-striped dt-responsive tablaInsumos" width="100%" data-page-length='25'>       
<thead>      
 <tr>           
  <th style="width:10px">#</th>
   <th>Imagen</th>
   <th>Código</th>
   <th>Descripción</th>
   <?php if( $_GET["ruta"] != "verCategoria"){ echo '<th>Categoría</th>';}?>
   <th>Stock</th>
   <th title="Estante">Est</th>
   <th title="Nivel">Nvl</th>
   <th title="Sección">Secc</th>
   <th>Acciones</th>
 </tr> 
</thead>
</table>