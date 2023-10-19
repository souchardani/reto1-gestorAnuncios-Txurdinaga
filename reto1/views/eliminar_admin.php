<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "users.php");
$nick = $_GET["id"];

//operacion sql
global $Conexionbbdd;
$consulta = "DELETE from usuario WHERE Nick = '$nick'";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Administrador eliminado correctamente";
    Redireccionar_A("users.php");
}else {
    $_SESSION["MensajeError"] = "Error al eliminar el administrador. (Error Inesperado)";
    Redireccionar_A("users.php");
}
?>