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
    <section class="container">
              <?php
              //llamamos a los mensajes de exito y error
                echo MensajeError();
                echo MensajeExito();
              ?>
            <!-- formulario -->
            <section class="form">
                  <div class="contenedor-formulario mt-bg w-70">
                    <div class="titulo tx-morado-oscuro"><span>Añadir Nuevo Usuario</span></div>
                    <form action="registro.php" method="post">
                      <!-- fila 2 fluida -->
                      <div class="fila-fluida">
                        <div class="grow">
                          <label for="nombre">Nombre:</label>
                          <div class="fila">
                            <i class="fas fa-user tx-morado-oscuro"></i>
                            <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre">
                          </div>
                        </div>
                        <div class="grow">
                        <!-- fila 3 -->
                          <label for="apellido">Apellido:</label>
                          <div class="fila">
                            <i class="fas fa-user tx-morado-oscuro"></i>
                            <input type="text" name="apellido" id="apellido" placeholder="Escribe el apellido">
                          </div>
                        </div>
                      </div>
                      <!-- fila 1 -->
                      <label for="nickname">Nombre de Usuario:</label>
                      <div class="fila">
                        <i class="fas fa-user tx-morado-oscuro"></i>
                        <input type="text" name="nickname" id="nickname" placeholder="Escribe el nombre de usuario aqui">
                      </div>
                      <!-- fila 4 -->
                      <label for="pass">Contraseña:</label>
                      <div class="fila">
                      <i class="fas fa-user tx-morado-oscuro"></i>
                      <input type="password" name="pass" id="pass"  placeholder="Escribe la contraseña aqui">
                      </div>
                      <!-- fila 6 -->
                      <label for="pass2">Confirmar Contraseña:</label>
                      <div class="fila">
                      <i class="fas fa-user tx-morado-oscuro"></i>
                      <input type="password" name="pass2" id="pass2" placeholder="Vuelve a escribir la contraseña">
                      </div>
                        <!-- fila 5 -->
                      <label for="email">Email:</label>
                      <div class="fila">
                        <i class="fas fa-user tx-morado-oscuro"></i>
                        <input type="email" name="email" id="email" placeholder="Escribe tu correo">
                      </div>
                      <!-- fila 6 fluida -->
                      <div class="fila-fluida">
                        <div class="grow">
                          <label for="fecha">Fecha Nacimiento:</label>
                          <div class="fila">
                            <i class="fas fa-user tx-morado-oscuro"></i>
                            <input type="date" name="fecha" id="fecha" placeholder="Escribe tu Fecha de Nacimiento">
                          </div>
                        </div>
                        <div class="grow">
                        <!-- fila 3 -->
                          <label for="clase">Clase:</label>
                          <div class="fila">
                            <i class="fas fa-user tx-morado-oscuro"></i>
                            <select name="clase" id="clase">
                                <?php
                                $stmt = obtener_clase();
                                while($fila = $stmt -> fetch()){
                                  $nombre = $fila["Nombre"];
                                  echo "<option value='$nombre'>$nombre</option>";
                                }
                                ?>
                          </select>
                          </div>
                        </div>
                        <div class="grow">
                          <label for="tipo">Alumno/Profesor:</label>
                          <div class="fila">
                            <i class="fas fa-user tx-morado-oscuro"></i>
                            <select name="tipo" id="tipo" class="form-control">
                              <option value="Alumno">Alumno</option>
                              <option value="Alumno">Profesor</option>
                              <option value="Alumno">Administrador</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- fila condiciones -->

                      <!-- fila para boton -->
                      <div class="fila-boton">
                      <button class="boton tx-morado-oscuro w-100" type="submit" name="enviar"><i class="fa-solid fa-check"></i>Crear Cuenta</button>
                      <div class="subtexto">
                      Ya tienes Cuenta? <a class="ctx-morado-oscuro" href="login.php">Inicia Sesion</a>
                    </div>
                    </div>
                    </form>
                  </div>
                </section>
        </section>
    </section>
    <!-- end of main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
  </body>
</html>
