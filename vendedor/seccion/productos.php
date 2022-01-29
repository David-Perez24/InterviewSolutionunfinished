<?php include("../template/cabecera.php"); ?>
<?php
  $txtId=(isset($_POST['idProd']))?$_POST['idProd']:"";
  $txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
  $txtPrice=(isset($_POST['txtPrice']))?$_POST['txtPrice']:"";
  $txtType=(isset($_POST['txtType']))?$_POST['txtType']:"";
  $txtDescription=(isset($_POST['txtDescription']))?$_POST['txtDescription']:"";
  $txtStock=(isset($_POST['txtStock']))?$_POST['txtStock']:"";
  $txtImg=(isset($_FILES['txtImg']['name']))?$_FILES['txtImg']['name']:"";
  $txtAccion=(isset($_POST['accion']))?$_POST['accion']:"";

?>
<div class="prods">
  <div class="addprods">
    <form class="addprod-form" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="idProd" class="addProd-Item" value="<?php echo $txtId; ?>">
      <input type="text" name="txtName" class="addProd-Item" value="<?php echo $txtName; ?>" placeholder="Nombre">
      <input type="text" name="txtPrice" class="addProd-Item" value="<?php echo $txtPrice; ?>" placeholder="Precio">
      <input type="text" name="txtType" class="addProd-Item" value="<?php echo $txtType; ?>" placeholder="Tipo">
      <input type="text" name="txtDescription" class="addProd-Item" value="<?php echo $txtDescription; ?>" placeholder="Descripcion">
      <input type="text" name="txtStock" class="addProd-Item" value="<?php echo $txtStock; ?>" placeholder="Cantidad Disponible">
      <div class="imgUp">
        <label for="txtNombre">Imagen: <?php echo $txtImg; ?></label>
        <input type="file" name="txtImg" value="">
      </div>

      <button type="submit" value="agregar" class="buttonSend" name="accion">Agregar</button>
      <button type="submit" value="modificar" class="buttonSend" name="accion">Modificar</button>
    </form>
  </div>
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
              <button type="submit" name="accion" value="seleccionar">Seleccionar</button>
              <button type="submit" name="accion" value="eliminar">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>

  </div>
</div>

<?php include("../template/pie.php"); ?>
