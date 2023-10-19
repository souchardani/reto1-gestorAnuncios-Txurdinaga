<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "categorias.php");
$id_categoria = $_GET["id"];

confirmar_admin();
//operacion sql
global $Conexionbbdd;
$consulta = "DELETE from categoria WHERE Nombre = '$id_categoria'";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Categoria eliminada correctamente";
    Redireccionar_A("categorias.php");
}else {
    $_SESSION["MensajeError"] = "Error al eliminar la categoria. (Error Inesperado)";
    Redireccionar_A("categorias.php");
}
?>