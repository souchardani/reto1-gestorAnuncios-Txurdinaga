<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
//verificamos que el usuario no este logueado, si lo esta, no mostramos el login
if (isset($_SESSION["usuario_global"])) {
  if($_SESSION["tipoUsuario_global"] == "Administrador"){
    Redireccionar_A("detalles_anuncios.php");
  }else {
    Redireccionar_A("anuncios_inicio.php");
  }
}




if(isset($_POST["enviar"])){
  $usuario = $_POST["usuario"];
  $password = $_POST["password"];

  $verificar_llenado = verificar_empty([$usuario, $password], "login.php");
  if ($verificar_llenado){
    //checkear si el usuario existe en la bbdd y redireccionar a detalles_inicio.php
    inicio_sesion($usuario, $password);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php require_once("../templates/head.php"); ?>
    <title>Iniciar Sesion</title>
  </head>
  <body>
    <!-- HEADER -->
    <?php include("../templates/header.php"); ?>
    <!-- HEADER END -->
    
    <!-- main area -->
    <section class="container mt-bg">
          <?php
          //llamamos a los mensajes de exito y error
            echo MensajeError();
            echo MensajeExito();
          ?>
          <section class="form mb-bg">
          <div class="contenedor-formulario mt-bg  w-50">
            <div class="titulo tx-rojo"><span>¡Bienvenido de nuevo!</span></div>
            <form action="login.php" method="post" enctype="multipart/form-data">
              <!-- fila usuario -->
              <label for="usuario">Usuario:</label>
              <div class="fila">
                <i class="fas fa-user tx-rojo"></i>
                <input type="text" name="usuario" id="usuario" placeholder="escribe tu nombre de usuario">
              </div>
              <!-- fila pass -->
              <label for="password">Contraseña:</label>
              <div class="fila">
                <i class="fas fa-lock tx-rojo"></i>
                <input type="password" name="password" id="password" placeholder="escribe tu contraseña">
              </div>
              <!-- fila para boton -->
              <div class="fila-boton">
              <button type="submit" name="enviar" value="Iniciar Sesion" class="boton tx-rojo w-100">Iniciar Sesion</button>
              <div class="subtexto">
              ¿No tienes Cuenta? <a class="ctx-rojo" href="registro.php">Crea una</a>
            </div>
              </div>
            </form>
          </div>
        </section>
    </section>
    <!-- end of main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
  </body>
</html>
