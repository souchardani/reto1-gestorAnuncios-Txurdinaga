<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
confirmar_admin();

comprobar_variable_url("id", "detalles_anuncios.php");
$id_anuncio = $_GET["id"];

//operacion sql
global $Conexionbbdd;
$consulta = "UPDATE anuncio SET Aceptado = 1 WHERE id = $id_anuncio";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Anuncio aprobado correctamente";
    Redireccionar_A("detalles_anuncios.php");
}else {
    $_SESSION["MensajeError"] = "Error al aprobar el Anuncio. (Error Inesperado)";
    Redireccionar_A("detalles_anuncios.php");
}

?>
