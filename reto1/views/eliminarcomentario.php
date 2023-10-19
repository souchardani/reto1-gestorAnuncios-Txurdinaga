<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "comentarios.php");
$id = $_GET["id"];


//operacion sql
global $Conexionbbdd;
$consulta = "DELETE from comentario WHERE id = $id";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Comentario eliminado correctamente";
    Redireccionar_A("comentarios.php");
}else {
    $_SESSION["MensajeError"] = "Error al eliminar el Comentario. (Error Inesperado)";
    Redireccionar_A("comentarios.php");
}
?>