<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
confirmar_admin();

comprobar_variable_url("id", "detalles_anuncios.php");
$id_user = $_GET["id"];

//operacion sql
global $Conexionbbdd;
$consulta = "UPDATE usuario SET Activo = 1 WHERE Nick = '$id_user'";
$execute = $Conexionbbdd -> query($consulta);
if($execute){
    $_SESSION["MensajeExito"] = "Usuario Validado correctamente";
    $_SESSION["nickemail"] = $id_user;
    $_SESSION["emailemail"] = obtener_email($id_user);
    //echo 'Enviar email al usuario. <a href="../email/index.php">Enviar Email</a>';
    Redireccionar_A("../email/index.php");
}else {
    $_SESSION["MensajeError"] = "Error al al Usuario. (Error Inesperado)";
    Redireccionar_A("users.php");
}

?>
