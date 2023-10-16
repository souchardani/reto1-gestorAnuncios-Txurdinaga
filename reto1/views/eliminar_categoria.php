<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/funciones.php"); ?>
<?php require_once("includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "comentarios.php");
$id_anuncio = $_GET["id"];


//operacion sql
global $ConexionDB;
$consulta = "DELETE from categorias WHERE id = $id_anuncio";
$execute = $ConexionDB -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Categoria eliminada correctamente";
    Redireccionar_A("categorias.php");
}else {
    $_SESSION["MensajeError"] = "Error al eliminar la categoria. (Error Inesperado)";
    Redireccionar_A("categorias.php");
}
?>