<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
    //actualizado
    $_SESSION["usuario_global"] =  null;
    $_SESSION["usuarionombre_global"] =  null;
    $_SESSION["tipoUsuario_global"] =  null;
    $_SESSION["usuarioapellido_global"] =  null;
    $_SESSION["foto_global"] =  null;
    session_destroy();
    Redireccionar_A("login.php");
?>  