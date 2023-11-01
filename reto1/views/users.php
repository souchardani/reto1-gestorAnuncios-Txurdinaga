<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
  $_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
  //verificamos que el usuario este logueado como administrador
  confirmar_login();
  //verificamos que el usuario sea administrador
  confirmar_admin();

  //si pulsamos el boton de enviar, insertamos administrador en la bbdd
  if(isset($_POST["enviar"])){
    $username = $_POST["username"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $rol = $_POST["rol"];
    $correo = $_POST["correo"];
    $clase = $_POST["clase"];
    $nacimiento = $_POST["nacimiento"];
    $contrasena = $_POST["password"];
    $activo = 1; //al ser administrador, se le asigna el valor 1 ya que esta validado
    // ciframos la contraseña
    $passif = hash('sha1', $contrasena);
    $confirmar_contrasena = $_POST["confirmar_password"];
    $validar_data = validar_data_user($username, $contrasena, $confirmar_contrasena, "users.php");
    $verificar_existencia = verificar_existencia_user($username, "users.php");
    if($validar_data & $verificar_existencia){
      //como vamos a añadirusuario, limpamos el localstorage
      echo '<script src="../assets/js/limpiarLocalStorage.js"></script>';
      //si validamos los campos y verificamos que no existe, insertar el administrador en la bbdd
      $insertado = insertar_user_bbdd($username,$nombre, $apellido,$rol,$correo,$clase, $nacimiento, $passif, $activo);
      if($insertado){
        $_SESSION["MensajeExito"] = "El Usuario $username se ha añadido Correctamente";
      }else {
        $_SESSION["MensajeError"] = "Ocurrio un error inesperado al insertar, vuelve a intentarlo";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Administradores</title>
  </head>

  <body>
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div id="dynamicHeader"></div>
    <!-- HEADER END -->
    <!-- MAIN AREA -->
    <section class="container">
      <?php 
        //mostramos mensaje de exito o error respectivamente
        echo MensajeError();
        echo MensajeExito();
      ?>
      <div class="contenedor-boton-principal mb-bg mt-bg">
        <a class="boton boton-principal tx-morado-oscuro" 
          <?php 
          ($_SESSION["tipoUsuario_global"] == "Administrador") ? $temp="href='dashboard.php'" :$temp= "href='dashboarduser.php'";
          echo $temp;
          ?>
        >
        <i class="fa-solid fa-arrow-left"></i> 
        Volver al Panel de Control</a>
      </div>
      <!-- formulario -->
      <section class="form">
        <div class="contenedor-formulario mt-bg w-70">
          <div class="titulo tx-morado-oscuro"><span>Añadir Nuevo Usuario</span></div>
          <form action="users.php" method="post">
            <!-- fila 1 fluida -->
            <div class="fila-fluida">
              <!-- fila 1 -->
              <div class="grow">
                <label for="nombre">Nombre:</label>
                <div class="fila">
                  <i class="fas fa-user tx-morado-oscuro"></i>
                  <input class="form-control " type="text" name="nombre" id="nombre" placeholder="Escribe el nombre">
                </div>
              </div>
              <div class="grow">
                <label for="apellido">Apellido:</label>
                <div class="fila">
                  <i class="fas fa-user tx-morado-oscuro"></i>
                  <input type="text" name="apellido" id="apellido" placeholder="Escribe el apellido">
                </div>
              </div>
            </div>
            <!-- fila 2 -->
            <label for="username">Nombre de Usuario:</label>
            <div class="fila">
              <i class="fas fa-user tx-morado-oscuro"></i>
              <input type="text" name="username" id="username" placeholder="Escribe el nombre de usuario aqui">
            </div>
            <!-- fila 3 -->
            <label for="password">Contraseña:</label>
            <div class="fila">
              <i class="fas fa-lock tx-morado-oscuro"></i>
              <input type="password" name="password" id="password" placeholder="Escribe la contraseña aqui">
            </div>
            <!-- fila 4 -->
            <label for="confirmar_password">Cormfirmar Contraseña:</label>
            <div class="fila">
              <i class="fas fa-lock tx-morado-oscuro"></i>
              <input type="password" name="confirmar_password" id="confirmar_password" placeholder="Vuelve a escribir la contraseña">
            </div>
            <!-- fila 5 -->
            <label for="correo">Email:</label>
            <div class="fila">
              <i class="fas fa-envelope tx-morado-oscuro"></i>
              <input type="text" name="correo" id="correo" placeholder="Escribe tu correo">
            </div>
            <!-- fila 2 fluida -->
            <div class="fila-fluida">
              <!-- fila 6 -->
              <div class="grow">
                <label for="nacimiento">Fecha Nacimiento:</label>
                <div class="fila">
                  <i class="fas fa-calendar-days tx-morado-oscuro"></i>
                  <input type="date" name="nacimiento" id="nacimiento" placeholder="Escribe tu Fecha de Nacimiento">
                </div>
              </div>
              <div class="grow">
              <!-- fila 3 -->
                <label for="clase">Clase:</label>
                <div class="fila">
                  <i class="fas fa-graduation-cap tx-morado-oscuro"></i>
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
                <label for="rol">Rol:</label>
                <div class="fila">
                  <i class="fas fa-gear tx-morado-oscuro"></i>
                    <select name="rol" id="rol">
                      <option value="Administrador">Administrador</option>
                      <option value="Profesor">Profesor</option>
                      <option value="Alumno">Alumno</option>
                    </select>
                  </div>
              </div>
            </div>
            <!-- fila para boton publicar -->
            <div class="fila-boton">
              <button class="boton tx-morado-oscuro w-100" type="submit" name="enviar">
                <i class="fa-solid fa-check"></i>
                Publicar
              </button>
            </div>
          </form>
        </div>
      </section>
      <!-- formulario fin -->
            <!-- tabla pendientes -->
      <main class="table mt-bg">
        <section class="table__header">
          <h1 class="heading-02">Usuarios Pendientes de Validar</h1>
          <div class="input-group">
            <input type="search" name="" id="" placeholder="Buscar" />
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </section>
        <section class="table__body">
          <table class="table-center">
            <thead>
              <tr>
                <th>Nº</th>
                <th>Nick</th>
                <th>Nombre y Apellido</th>
                <th>Rol</th>
                <th>Clase</th>
                <th>Correo</th>
                <th>Validar</th>
                <th>eliminar</th>
              </tr>
            </thead>
            <tbody>         
              <?php
                $stmt = obtener_usuarios_novalidados();
                $contador = 0;
                while ($fila = $stmt -> fetch()){
                  $Nick = $fila["Nick"];
                  $Nombre = $fila["Nombre"];
                  $Apellido = $fila["Apellido"];
                  $Rol = $fila["Rol"];
                  $Clase = $fila["Clase"];
                  $Correo = $fila["Correo"];
                  $contador++;
              ?>
              <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $Nick; ?></td>
                <td><?php echo "$Nombre $Apellido"; ?></td>
                <td><?php echo $Rol; ?></td>
                <td><?php echo $Clase; ?></td>
                <td><?php echo $Correo; ?></td>
                <td><a onclick="return confirm('Al Validar se envía un email de confirmación al usuario')" href="validar_users.php?id=<?php echo $Nick  ?>" class="boton verde"><i class="fa-solid fa-check"></a></td>
                <td><a onclick="return confirm('Al eliminar el usuario, se eliminarán todos sus anuncios. Estas de acuerdo?')" href="eliminar_user.php?id=<?php echo $Nick; ?>" class="boton rojo"><i class="fa-solid fa-trash-can"></i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </section>
      </main>
      <!-- tabla  validados -->
      <main class="table mt-bg">
        <section class="table__header">
          <h1 class="heading-02">Usuarios Validados</h1>
          <div class="input-group">
            <input type="search" name="" id="" placeholder="Buscar" />
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </section>
        <section class="table__body">
          <table class="table-center">
            <thead>
              <tr>
                <th>Nº</th>
                <th>Nick</th>
                <th>Nombre y Apellido</th>
                <th>Rol</th>
                <th>Clase</th>
                <th>Correo</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>         
              <?php
                $stmt = obtener_usuarios_validados();
                $contador = 0;
                while ($fila = $stmt -> fetch()){
                  $Nick = $fila["Nick"];
                  $Nombre = $fila["Nombre"];
                  $Apellido = $fila["Apellido"];
                  $Rol = $fila["Rol"];
                  $Clase = $fila["Clase"];
                  $Correo = $fila["Correo"];
                  $contador++;
              ?>
              <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $Nick; ?></td>
                <td><?php echo "$Nombre $Apellido"; ?></td>
                <td><?php echo $Rol; ?></td>
                <td><?php echo $Clase; ?></td>
                <td><?php echo $Correo; ?></td>
                <td><a onclick="return confirm('Al eliminar el usuario, se eliminarán todos sus anuncios. Estas de acuerdo?')" href="eliminar_user.php?id=<?php echo $Nick; ?>" class="boton rojo"><i class="fa-solid fa-trash-can"></i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </section>
      </main>  
      <!-- END MAIN AREA -->
    </section>
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script src="../assets/js/storageuser.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Usuarios');</script>
  </body>
</html>
