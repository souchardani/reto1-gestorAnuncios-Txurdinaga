<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
confirmar_admin();

comprobar_variable_url("id", "comentarios.php");
$id_comentario = $_GET["id"];
$usuario = $_SESSION["usuario_global"];



//operacion sql
global $Conexionbbdd;
$consulta = "UPDATE comentario SET Validado = 1 WHERE id = $id_comentario";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Comentario aprobado correctamente";
    Redireccionar_A("comentarios.php");
}else {
    $_SESSION["MensajeError"] = "Error al aprobar el Comentario. (Error Inesperado)";
    Redireccionar_A("comentarios.php");
}

?>