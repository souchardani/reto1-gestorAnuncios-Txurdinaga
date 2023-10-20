<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "users.php");
$nick = $_GET["id"];
if ($nick == $_SESSION["Nick"]) {
    $_SESSION["MensajeError"] = "No puedes eliminar tu propio usuario";
    Redireccionar_A("users.php");
}
//operacion sql
global $Conexionbbdd;
eliminar_dependencias_user($nick);
$consulta = "DELETE from usuario WHERE Nick = '$nick'";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Usuario eliminado correctamente";
    Redireccionar_A("users.php");
}else {
    $_SESSION["MensajeError"] = "Error al eliminar el Usuario. (Error Inesperado)";
    Redireccionar_A("users.php");
}
?>