<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/funciones.php"); ?>
<?php require_once("includes/sesiones.php"); ?>
<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();
//si pulsamos el boton de enviar, insertamos administrador en la bbdd
if(isset($_POST["enviar"])){
  $username = $_POST["username"];
  $nombre = $_POST["nombre"];
  $contrasena = $_POST["password"];
  $confirmar_contrasena = $_POST["confirmar_password"];
  $Admin = $_SESSION["usuario_global"];
  date_default_timezone_set("Europe/Madrid"); 
  $fechaActual = date("Y-m-d H:i:s"); 

  $validar_data = validar_data_admin($username, $contrasena, $confirmar_contrasena);
  $verificar_existencia = verificar_existencia_admin($username);
  if($validar_data & $verificar_existencia){
    //si validamos los campos y verificamos que no existe, insertar el administrador en la bbdd
    insertar_admin_bbdd($fechaActual, $username, $contrasena, $nombre, $Admin);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php require_once("vistas_comunes/head.php"); ?>
  <title>Administradores</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("vistas_comunes/navbaradmin.php"); ?>
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
      <form class="" action="admins.php" method="post">
        <div class="card text-bg-secondary mb-3">
          <div class="card-header" style="background-color: #BA007B;">
            <h1>Añadir Nuevo Administrador</h1>
          </div>
          <div class="card-body text-bg-light">
            <div class="form-group mb-5">
              <label class="mb-3" for="username"><span class="FieldInfo">Nombre de Usuario:</span></label>
              <input class="form-control " type="text" name="username" id="username" placeholder="Escribe el nombre de usuario aqui">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="nombre"><span class="FieldInfo">Nombre:</span></label>
              <input class="form-control " type="text" name="nombre" id="nombre" placeholder="Escribe el nombre">
              <small class="ms-2 text-warning text-muted">*Opcional</small>
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
              <a class="btn btn-warning d-lg-block w-100" href="detalles_anuncios.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div class="col-lg-6 mb-2  d-md-block ">
              <button type="submit" name="enviar" class="btn btn-success w-100"><i class="fa-solid fa-check"></i> Añadir Administrador</button>
            </div>
          </div>
          </div>
        </div>
      </form>
      <!-- tabla y accion -->
      <h2>Administradores Existentes</h2>
          <table class="table table-stripped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Nº</th>
                <th>Fecha y hora</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Aprobador por:</th>
                <th>Accion</th>
              </tr>
            </thead>
          <?php
          $stmt = obtener_administradores();
          $contador = 0;
          while ($fila = $stmt -> fetch()){
            $id = $fila["id"];
            $datetime = $fila["datetime"];
            $username = $fila["username"];
            $nombre = $fila["admin_name"];
            $aprobadopor = $fila["creador"];
            $contador++;
          ?>
          <tbody>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $datetime; ?></td>
              <td><?php echo $username; ?></td>
              <td><?php echo $nombre; ?></td>
              <td><?php echo $aprobadopor; ?></td>
              <td><a href="eliminar_admin.php?id=<?php echo $id; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
          </tbody>
          <?php } ?>
          </table>
    </div>
    </div>
  </section>
  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("vistas_comunes/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Administradores');</script>
  </body>
</html>
