<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
//verificamos que el usuario no este logueado, si lo esta, no mostramos el registro
if (isset($_SESSION["usuario_global"])) {
  if($_SESSION["tipoUsuario_global"] == "Administrador"){
    Redireccionar_A("anuncios_inicio.php");
  }else {
    Redireccionar_A("anuncios_inicio.php");
  }
} 




if(isset($_POST["enviar"])){
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apeliido"];
  $nickname = $_POST["nickname"];
  $pass = $_POST["pass"];
  $pass2 = $_POST["pass2"];
  $email = $_POST["email"];
  $fechaNac = $_POST["fecha"];
  $clase = $_POST["clase"];
  $tipo = $_POST["tipo"];
  $activo = 0; //al ser el registro, activo siempre esta en 0
  //verificamos que todos los campos esten validados
  $verificar_llenado= verificar_empty([$nombre, $apellido, $nickname, $pass, $pass2, $email, $fechaNac, $clase, $tipo], "registro.php");
  validar_data_user($nombre, $pass, $pass2, "registro.php");
  //verificamos que el user no exista
  $verificar_existencia = verificar_existencia_user($nickname);
  if($verificar_existencia){
    //si validamos los campos y verificamos que no existe, insertar el administrador en la bbdd
    $insertado = insertar_user_bbdd($nickname, $nombre, $apellido, $tipo, $email, $clase, $fechaNac, $pass, $activo);
    if($insertado){
      $_SESSION["MensajeExito"] = "Se ha enviado tu solicitud, te llegará un correo cuando un administrador la valide";
      Redireccionar_A("registro.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado al insertar, vuelve a intentarlo";
      Redireccionar_A("registro.php");
    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php require_once("../templates/head.php"); ?>
    <title>Crear Cuenta</title>
  </head>
  <body>
    <!-- HEADER -->
    <?php include("../templates/header.php"); ?>
    <!-- HEADER END -->
    
    <!-- main area -->
    <section class="container py-2 my-5">
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
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="apellido"><span class="FieldInfo">Apelllido: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                        <input type="text" class="form-control" name="apeliido" id="apellido">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="nickname"><span class="FieldInfo">Nickname: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-user"></i></span></div>
                        <input type="text" class="form-control" name="nickname" id="nickname">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="pass"><span class="FieldInfo">Contraseña: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-lock"></i></span></div>
                        <input type="password" class="form-control" name="pass" id="pass">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="pass2"><span class="FieldInfo">Repetir contraseña: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-lock"></i></span></div>
                        <input type="password" class="form-control" name="pass2" id="pass2">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="email"><span class="FieldInfo">Email: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-envelope"></i></span></div>
                        <input type="email" class="form-control" name="email" id="email">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="fecha"><span class="FieldInfo">Fecha Nacimiento: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-calendar"></i></span></div>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="clase"><span class="FieldInfo">Clase: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-graduation-cap"></i></span></div>
                        <select name="clase" id="clase" class="form-control">
                          <?php
                          $stmt = obtener_clase();
                          while ($fila = $stmt -> fetch()){
                            $nombre = $fila["Nombre"];
                            echo "<option value='$nombre'>$nombre</option>";

                          }


                          ?>

                        </select>
                      </div>
                    </div>    
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="tipo"><span class="FieldInfo">Tipo de cuenta: </span></label>
                      <div class="input-group my-2">
                        <div class="input-group-text" style="background-color: #FCC204;"><span><i class="fas fa-gear"></i></span></div>
                        <select name="tipo" id="tipo" class="form-control">
                          <option value="Alumno">Alumno</option>
                          <option value="Alumno">Profesor</option>
                          <option value="Alumno">Administrador</option>
                        </select>
                      </div>
                    </div>    
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="checkbox-authorization" id="checkbox-authorization" required> 
                        Acepto las condiciones
                      </label>
                    </div>
                  </div>
                  <div class="d-grid">
                    <input type="submit" name="enviar" value="Crear Cuenta" class="btn d-block text-white my-2" style="background: #E95F15;">
                  </div>
                  <div class="text-center col-12">
                    <p>¿Tienes cuenta? <a href="login.php">Inicia Sesion</a></p>
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
