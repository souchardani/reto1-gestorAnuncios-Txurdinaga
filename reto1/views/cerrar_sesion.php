<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
    //actualizado
    $_SESSION["usuarioid_global"] =null;
    $_SESSION["usuario_global"] =  null;
    session_destroy();
    Redireccionar_A("login.php");
?>  