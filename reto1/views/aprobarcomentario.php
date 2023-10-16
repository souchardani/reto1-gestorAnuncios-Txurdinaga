<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/funciones.php"); ?>
<?php require_once("includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "comentarios.php");
$id_anuncio = $_GET["id"];
$usuario = $_SESSION["usuario_global"];



//operacion sql
global $ConexionDB;
$consulta = "UPDATE comentarios SET publicado = 'SI', aprobadopor='$usuario' WHERE id = $id_anuncio";
$execute = $ConexionDB -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Comentario aprobado correctamente";
    Redireccionar_A("comentarios.php");
}else {
    $_SESSION["MensajeError"] = "Error al aprobar el Comentario. (Error Inesperado)";
    Redireccionar_A("comentarios.php");
}

?>