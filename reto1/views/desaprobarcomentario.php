<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
//verificamos que el usuario este logueado como administrador
confirmar_login();

comprobar_variable_url("id", "comentarios.php");
$id_comentario = $_GET["id"];


//operacion sql
global $Conexionbbdd;
$consulta = "UPDATE comentario SET Validado = 0 WHERE id = $id_comentario";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Comentario Desaprobado correctamente";
    Redireccionar_A("comentarios.php");
}else {
    $_SESSION["MensajeError"] = "Error al desaprobar el Comentario. (Error Inesperado)";
    Redireccionar_A("comentarios.php");
}
?>