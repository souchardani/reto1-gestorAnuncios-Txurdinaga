<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "admins.php");
$id_anuncio = $_GET["id"];

//operacion sql
global $ConexionDB;
$consulta = "DELETE from admins WHERE id = $id_anuncio";
$execute = $ConexionDB -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Administrador eliminado correctamente";
    Redireccionar_A("admins.php");
}else {
    $_SESSION["MensajeError"] = "Error al eliminar el administrador. (Error Inesperado)";
    Redireccionar_A("admins.php");
}
?>