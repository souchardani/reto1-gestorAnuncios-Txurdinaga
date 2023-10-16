<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
comprobar_variable_url("id", "comentarios.php");
$id_anuncio = $_GET["id"];


//operacion sql
global $ConexionDB;
$consulta = "UPDATE comentarios SET publicado = 'NO' WHERE id = $id_anuncio";
$execute = $ConexionDB -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Comentario Desaprobado correctamente";
    Redireccionar_A("comentarios.php");
}else {
    $_SESSION["MensajeError"] = "Error al desaprobar el Comentario. (Error Inesperado)";
    Redireccionar_A("comentarios.php");
}
?>