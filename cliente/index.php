<?php include("template/cabecera.php"); ?>
<?php
include("../functions/functions.php");
$userEmail = (isset($_POST["userLog"]))?$_POST["userLog"]:"";
$userPass = (isset($_POST["passLog"]))?$_POST["passLog"]:"";
$logBtn = (isset($_POST["logBtn"]))?$_POST["logBtn"]:"";
if($logBtn=='true'){
  login($userEmail,$userPass,'cliente');
}

?>
<div class="loging">
  <form class="logingForm" method="POST">
    <input type="text" class="logingFormItem" name="userLog" value="">
    <input type="password" class="logingFormItem" name="passLog" value="">
    <button type="submit" class="logingFormBtn" name="logBtn" value="true">Ingresar</button>
  </form>
</div>


<?php include("template/pie.php"); ?>
