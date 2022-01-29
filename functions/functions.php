<?php
function login($userEmail,$userPass,$tableName){
  include("../cliente/config/db.php");
  if ($userEmail!="" && $userPass!="") {
    $sentenciaSQL=$conexion->prepare("SELECT nombre, email, passwor, secretkey, iduser FROM $tableName where email='$userEmail' and passwor = '$userPass'");
    $sentenciaSQL->execute();
    $cliente=$sentenciaSQL-> fetch(PDO::FETCH_LAZY);
      if(($userEmail==$cliente['email'] && $userPass==$cliente['passwor']) && ($userPass!=""&&$userEmail!="")){
        $url="http://".$_SERVER['HTTP_HOST']."/InterviewSolution/$tableName/seccion/productos.php";
        header("Location:$url");
        $userPass="";
        $userEmail="";
      }else{
        $url="http://".$_SERVER['HTTP_HOST']."/InterviewSolution/index.php";
        header("Location:$url");
        $userPass="";
        $userEmail="";
      }
  }else{
    $url="http://".$_SERVER['HTTP_HOST']."/InterviewSolution/index.php";
    header("Location:$url");
    $userPass="";
    $userEmail="";
  }


}
function addProduct($txtName,$txtPrice,$txtType,$txtDescription,$txtStock,$nombreArchivo){
      $fecha = new DateTime();
      $nombreArchivo = ($txtImg!="")?$fecha->getTimestamp()."_".$_FILES["txtImg"]["name"]:"imagen.jpg";
      $tmpImg=$_FILES["txtImg"]["tmp_name"];
      if ($tmpImg!="") {
        move_uploaded_file($tmpImg,"../../img/".$nombreArchivo);
      }
      $sentenciaSQL=$conexion->prepare("INSERT INTO producto (nombre,precio,tipo,descripcion,cantidad,imagen,idvendedor) VALUES ('$txtName',$txtPrice,'$txtType','$txtDescription',$txtStock,'$nombreArchivo',NULL)");
      $sentenciaSQL->execute();

}
function delProduct(){
  $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE id=$txtId");
  $sentenciaSQL->execute();
  $producto=$sentenciaSQL-> fetch(PDO::FETCH_LAZY);
  $txtId=$producto['id'];
  $txtName=$producto['nombre'];
  $txtPrice=$producto['precio'];
  $txtType=$producto['tipo'];
  $txtDescription=$producto['descripcion'];
  $txtStock=$producto['cantidad'];
  $txtImg=$producto['imagen'];
  $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE id=$txtId");
  $sentenciaSQL->execute();
  $producto=$sentenciaSQL-> fetch(PDO::FETCH_LAZY);
  if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg")){
    if(file_exists("../../img/".$producto["imagen"])){
      unlink("../../img/".$producto["imagen"]);
    }
  }
  $sentenciaSQL=$conexion->prepare("DELETE FROM producto WHERE id=$txtId");
  $sentenciaSQL->execute();
}
function modProduct(){
  $sentenciaSQL=$conexion->prepare("UPDATE producto
  SET nombre = '$txtName', precio = $txtPrice, tipo = '$txtType', descripcion ='$txtDescription',
  cantidad = $txtStock
  WHERE id=$txtId");
  $sentenciaSQL->execute();
  if($txtImg!=""){
    $fecha = new DateTime();
    $nombreArchivo = ($txtImg!="")?$fecha->getTimestamp()."_".$_FILES["txtImg"]["name"]:"imagen.jpg";
    $tmpImg=$_FILES["txtImg"]["tmp_name"];
    move_uploaded_file($tmpImg,"../../img/".$nombreArchivo);
    $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE id=$txtId");
    $sentenciaSQL->execute();
    $producto=$sentenciaSQL-> fetch(PDO::FETCH_LAZY);
    if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg")){
      if(file_exists("../../img/".$producto["imagen"])){
        unlink("../../img/".$producto["imagen"]);
      }
    }
    $sentenciaSQL=$conexion->prepare("UPDATE producto
    SET imagen='$nombreArchivo'
    WHERE id=$txtId");
    $sentenciaSQL->execute();
  }
}

?>
