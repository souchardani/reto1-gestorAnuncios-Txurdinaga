<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
    //limpiamos los datos del localstorage al cerrar sesion
    echo '<script src="../assets/js/limpiarLocalStorage.js"></script>';
    //actualizado
    $_SESSION["usuario_global"] =  null;
    $_SESSION["usuarionombre_global"] =  null;
    $_SESSION["tipoUsuario_global"] =  null;
    $_SESSION["usuarioapellido_global"] =  null;
    $_SESSION["foto_global"] =  null;
    $_SESSION["usuariocorreo_global"] =  null;
    session_destroy();
    
    // Agregar script de redirección después de un tiempo de espera
    echo '<script>limpiarLocalStorage().then(() => window.location.href = "login.php");</script>';
    //Redireccionar_A("login.php");
?>  
