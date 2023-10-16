<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/funciones.php"); ?>
<?php require_once("includes/sesiones.php"); ?>
<?php
//verificamos que el usuario no este logueado, si lo esta, no mostramos el login
isset($_SESSION["usuario_global"]) ? Redireccionar_A("detalles_anuncios.php") : null;



if(isset($_POST["enviar"])){
  $usuario = $_POST["usuario"];
  $password = $_POST["password"];

  $verificar_llenado = verificar_empty([$usuario, $password]);
  if ($verificar_llenado){
    //checkear si el usuario existe en la bbdd y redireccionar a detalles_inicio.php
    inicio_sesion($usuario, $password);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("vistas_comunes/head.php"); ?>
    <title>Iniciar Sesion</title>
  </head>
  <body>
    <!-- HEADER -->
    <?php include("vistas_comunes/navheaderlogin.php");?>
    <!-- HEADER END -->
    
    <!-- main area -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height: 400px;">
          <div class="card text-bg-light">
            <div class="card-header">
              <h4>Bienvenido de nuevo!</h4>
            </div>
              <div class="card-body text-bg-light">
                <?php
                //llamamos a los mensajes de exito y error
                  echo MensajeError();
                  echo MensajeExito();
                ?>
                <form action="login.php" method="post">
                  <div class="form-group">
                    <label for="usuario"><span class="FieldInfo">Nombre de Usuario: </span></label>
                    <div class="input-group my-3">
                      <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                      <input type="text" class="form-control" name="usuario" id="usuario">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password"><span class="FieldInfo">Contraseña: </span></label>
                    <div class="input-group my-3">
                      <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-lock"></i></span></div>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                  </div>
                  <div class="d-grid">
                    <input type="submit" name="enviar" value="Iniciar Sesion" class="btn d-block text-white mt-3" style="background: #E95F15;">
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </section>
    <!-- end of main area -->
    <!-- FOOTER -->
    <?php include("vistas_comunes/footer.php");?>
    <!-- FOOTER END -->
  </body>
</html>
