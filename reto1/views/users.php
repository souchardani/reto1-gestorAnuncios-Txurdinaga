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
  $confirmar_contrasena = $_POST["confirmar_password"];
  $validar_data = validar_data_user($username, $contrasena, $confirmar_contrasena, "users.php");
  $verificar_existencia = verificar_existencia_user($username);
  if($validar_data & $verificar_existencia){
    //si validamos los campos y verificamos que no existe, insertar el administrador en la bbdd
    $insertado = insertar_user_bbdd($username,$nombre, $apellido,$rol,$correo,$clase, $nacimiento, $contrasena, $activo);
    if($insertado){
      $_SESSION["MensajeExito"] = "El Usuario $username se ha añadido Correctamente";
      Redireccionar_A("users.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado al insertar, vuelve a intentarlo";
      Redireccionar_A("users.php");
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
  <section class="container py-2 mb-4">
    <div class="row" >
      <div class="offset-lg-1 col-lg-10" style="min-height: 50vh;">
      <?php 
      //mostramos mensaje de exito o error respectivamente
      echo MensajeError();
      echo MensajeExito();
       ?>
      <form class="" action="users.php" method="post">
        <div class="card text-bg-secondary mb-3">
          <div class="card-header" style="background-color: #BA007B;">
            <h1>Añadir Nuevo Usuario</h1>
          </div>
          <div class="card-body text-bg-light">
            <div class="form-group mb-5">
              <label class="mb-3" for="username"><span class="FieldInfo">Nombre de Usuario:</span></label>
              <input class="form-control " type="text" name="username" id="username" placeholder="Escribe el nombre de usuario aqui">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="nombre"><span class="FieldInfo">Nombre:</span></label>
              <input class="form-control " type="text" name="nombre" id="nombre" placeholder="Escribe el nombre">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="apellido"><span class="FieldInfo">Apellido:</span></label>
              <input class="form-control " type="text" name="apellido" id="apellido" placeholder="Escribe el apellido">
              <small class="ms-2 text-warning text-muted">*Opcional</small>
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="rol"><span class="FieldInfo">Rol:</span></label>
              <select class="form-select" name="rol" id="rol">
                <option value="Administrador">Administrador</option>
                <option value="Profesor">Profesor</option>
                <option value="Alumno">Alumno</option>
              </select>
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="correo"><span class="FieldInfo">Correo:</span></label>
              <input class="form-control " type="text" name="correo" id="correo" placeholder="Escribe tu correo">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="nacimiento"><span class="FieldInfo">Fecha Nacimiento:</span></label>
              <input class="form-control " type="date" name="nacimiento" id="nacimiento" placeholder="Escribe tu Fecha de Nacimiento">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="nacimiento"><span class="FieldInfo">Clase:</span></label>
              <select class="form-select" name="clase" id="clase">
                <?php
                $stmt = obtener_clase();
                while($fila = $stmt -> fetch()){
                  $nombre = $fila["Nombre"];
                  echo "<option value='$nombre'>$nombre</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="password"><span class="FieldInfo">Contraseña:</span></label>
              <input class="form-control " type="password" name="password" id="password" placeholder="Escribe la contraseña aqui">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="confirmar_password"><span class="FieldInfo">Confirmar Contraseña:</span></label>
              <input class="form-control " type="password" name="confirmar_password" id="confirmar_password" placeholder="Vuelve a escribir la contraseña">
            </div>
            
            <div class="row">
            <div class="col-lg-6 mb-2">
              <a class="btn btn-warning d-lg-block w-100" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div class="col-lg-6 mb-2  d-md-block ">
              <button type="submit" name="enviar" class="btn btn-success w-100"><i class="fa-solid fa-check"></i> Añadir Administrador</button>
            </div>
          </div>
          </div>
        </div>
      </form>
      <!-- tabla y accion -->
      <h2 class="mb-3">Usuarios Validados</h2>
          <table class="table table-stripped table-hover">
            <thead class="table-dark">
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
          <tbody>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $Nick; ?></td>
              <td><?php echo "$Nombre $Apellido"; ?></td>
              <td><?php echo $Rol; ?></td>
              <td><?php echo $Clase; ?></td>
              <td><?php echo $Correo; ?></td>
              <td><a onclick="return confirm('Al eliminar el usuario, se eliminarán todos sus anuncios. Estas de acuerdo?')" href="eliminar_user.php?id=<?php echo $Nick; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
          </tbody>
          <?php } ?>
          </table>


          <h2 class="mb-3">Usuarios Pendientes de Validar</h2>
          <table class="table table-stripped table-hover">
            <thead class="table-dark">
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
          <tbody>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $Nick; ?></td>
              <td><?php echo "$Nombre $Apellido"; ?></td>
              <td><?php echo $Rol; ?></td>
              <td><?php echo $Clase; ?></td>
              <td><?php echo $Correo; ?></td>
              <td><a onclick="return confirm('Al Validar se envía un email de confirmación al usuario')" href="validar_users.php?id=<?php echo $Nick  ?>" class="btn btn-success"><i class="fa-solid fa-check"></a></td>
              <td><a onclick="return confirm('Estas Seguro? Esta accion no se puede deshacer')" href="eliminar_user.php?id=<?php echo $Nick; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
          </tbody>
          <?php } ?>
          </table>
    </div>
    </div>
  </section>
  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Usuarios');</script>
  </body>
</html>
