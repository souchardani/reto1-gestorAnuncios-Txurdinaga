<?php require_once("includes/funciones.php"); ?>
<?php require_once("includes/sesiones.php"); ?>

<?php
    $_SESSION["usuarioid_global"] =null;
    $_SESSION["usuario_global"] =  null;
    session_destroy();
    Redireccionar_A("login.php");
?>  