<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php require_once("../templates/head.php"); ?>
    <title>Iniciar Sesion</title>
  </head>
  <body>
    <!-- HEADER -->
    <?php include("../templates/navbaradmin.php"); ?>
    <!-- HEADER END -->
    
    <!-- main area -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height: 400px;">
          <div class="card text-bg-light">
            <div class="card-header">
              <h4>Registro</h4>
            </div>
            <div class="card-body text-bg-light">
              <?php
              //llamamos a los mensajes de exito y error
                echo MensajeError();
                echo MensajeExito();
              ?>
              <form action="registro.php" method="post">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="nombre"><span class="FieldInfo">Nombre: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="apellido"><span class="FieldInfo">Apelllido: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                        <input type="text" class="form-control" name="apeliido" id="apellido">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="nickname"><span class="FieldInfo">Nickname: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                        <input type="text" class="form-control" name="nickname" id="nickname">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="pass"><span class="FieldInfo">Contraseña: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-key"></i></span></div>
                        <input type="text" class="form-control" name="pass" id="pass">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="pass2"><span class="FieldInfo">Repetir contraseña: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-key"></i></span></div>
                        <input type="text" class="form-control" name="pass2" id="pass2">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="email"><span class="FieldInfo">Email: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-envelope"></i></span></div>
                        <input type="text" class="form-control" name="email" id="email">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="fecha"><span class="FieldInfo">Fecha: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-calendar"></i></span></div>
                        <input type="text" class="form-control" name="fecha" id="fecha">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="centro"><span class="FieldInfo">Centro: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-graduation-cap"></i></span></div>
                        <input type="text" class="form-control" name="centro" id="centro">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="telf"><span class="FieldInfo">Telefono: </span></label>
                      <div class="input-group my-3">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-phone"></i></span></div>
                        <input type="text" class="form-control" name="telf" id="telf">
                      </div>
                    </div>    
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="checkbox-authorization" id="checkbox-authorization" required> 
                        Acepto las condiciones
                      </label>
                    </div>
                  </div>
                  <div class="d-grid">
                    <input type="submit" name="enviar" value="Iniciar Sesion" class="btn d-block text-white mt-3" style="background: #E95F15;">
                  </div>
                  <div class="text-center col-12">
                    <p>¿Tienes cuenta? <a href="login.php">Login</a></p>
                  </div>
                </div>                                  
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end of main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
  </body>
</html>
