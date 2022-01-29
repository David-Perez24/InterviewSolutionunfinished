<?php include("../template/cabeceraCli.php"); ?>
<?php
  include("../config/db.php");
  $sentenciaSQL=$conexion->prepare("SELECT * FROM producto");
  $sentenciaSQL->execute();
  $listaProductos=$sentenciaSQL-> fetchAll(PDO::FETCH_ASSOC);


?>
<div class="prods">
  <div class="tableProds">
   <table>
     <tr>
       <th>Nombre</th>
       <th>Precio</th>
       <th>Tipo</th>
       <th>Descripcion</th>
       <th>Stock</th>
       <th>Imagen</th>
       <th>Acciones</th>
     </tr>
     <?php foreach ($listaProductos as $caract) { ?>
       <tr>
         <td><?php echo $caract['nombre']; ?></td>
         <td><?php echo $caract['precio']; ?></td>
         <td><?php echo $caract['tipo']; ?></td>
         <td><?php echo $caract['descripcion']; ?></td>
         <td><?php echo $caract['cantidad']; ?></td>
         <td><img class="imagen" src="../../img/<?php echo $caract['imagen']; ?>" alt="Not Found"></td>
         <td>
           <form class="" method="POST">
             <input type="hidden" name="idProd" value="<?php echo $caract['id']; ?>">
             <button type="submit" name="addToCart" value="addtocart">Añadir al carrito</button>
           </form>
         </td>
       </tr>
     <?php } ?>
   </table>
 </div>
 </div>
<?php include("../template/pie.php"); ?>
