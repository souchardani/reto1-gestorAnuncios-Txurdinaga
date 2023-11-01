<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
  $_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
  //verificamos que el usuario este logueado
  confirmar_login();
  $user = $_SESSION["usuario_global"];
  $userapellido  = $_SESSION["usuarioapellido_global"];
  $username = $_SESSION["usuarionombre_global"];
  $correo = $_SESSION["usuariocorreo_global"];

  //--------SI SE ENVIA EN ANUNCIO POR EL BOTON DE ENVIAR--------//
  if(isset($_POST["enviar"])){
    //obtenemos los campos del formulario];
    date_default_timezone_set("Europe/Madrid");
    $fechaActual = date("Y-m-d H:i:s"); 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $imagen = $_FILES["imagen"]["name"];
    $target = $target = "../assets/img_subidas/usuarios/".basename($imagen);
    $email = $_POST["email"];
    validar_Miperfil($nombre, $apellido, $imagen);

    //hacemos la insersion en la bbdd
    global $Conexionbbdd;

    if (!$Conexionbbdd) {
      die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    if (empty($imagen)){
      $consulta = "UPDATE usuario SET Nombre='$nombre', Apellido='$apellido', Correo='$email' WHERE Nick='$user'";
    }else {
      $consulta = "UPDATE usuario SET Nombre='$nombre', Apellido='$apellido',Correo='$email', Imagen='$imagen' WHERE Nick='$user'";
    }
    $insertado = $Conexionbbdd -> query($consulta);
    if ($insertado){
      //guardar la imagen en la carpeta de imagenes
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $target);
      $_SESSION["MensajeExito"] = "El perfil se ha editado Correctamente. Vuelve a iniciar sesion para ver los cambios <a class='boton tx-verde-claro' href='cerrar_sesion.php'>Cerrar Sesion</a>";
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inserperado. Vuelve a intentarlo";
    }
    Redireccionar_A("miperfil.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Mi perfil</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div id="dynamicHeader"></div>
    <!-- HEADER END -->

    <!-- MAIN AREA -->
    <?php 
      //añadimos el mensaje de exito o error para cada caso especifico
      echo MensajeError();
      echo MensajeExito();
    ?>
    <section class="container">
      <div class="container-perfil mt-bg">
        <!-- izquierda -->
        <section class="form">
          <div class="contenedor-formulario formulario-imagen">
            <div class="titulo tx-naranja"><?php echo $username ?></div>
            <form>
            <!-- fila titulo -->
              <div class="fila">
                <img src="../assets/img_subidas/usuarios/<?php echo $_SESSION['foto_global'] ?>" class="block img-fluid mb-3" alt="">
              </div>
            </form>
          </div>
        </section>
        <!-- derecha -->
        <!-- formulario -->
        <section class="form w-70">
          <div class="contenedor-formulario mt-bg w-100">
            <div class="titulo tx-naranja"><span>Editar tu perfil</span></div>
              <form id="form" action="miperfil.php" method="post" enctype="multipart/form-data">
                <!-- fila 1 fluida -->
                <label for="nombre">Nombre:</label>
                <div class="fila">
                  <i class="fas fa-user tx-naranja"></i>
                  <input  type="text" name="nombre" id="nombre" value="<?php echo $username ?>">
                </div>
                <!-- fila 2 -->
                <label for="apellido">Apellido:</label>
                <div class="fila">
                  <i class="fas fa-user tx-naranja"></i>
                  <input type="text" name="apellido" id="apellido" value="<?php echo $userapellido ?>">
                </div>
                <!-- fila 3 -->
                <label for="clase">Clase:</label>
                <div class="fila">
                  <i class="fas fa-graduation-cap tx-naranja"></i>
                  <select type="text" name="clase" id="clase" disabled>
                    <?php
                      //obtener clase por id
                      $clase = obtener_clase_por_nick($user);
                    ?>
                    <option value="<?php echo $clase ?>"><?php echo $clase ?></option>
                  </select>
                </div>
                <label for="email">Email:</label>
                <div class="fila">
                  <i class="fas fa-user tx-naranja"></i>
                  <input type="text" name="email" id="email" value="<?php echo $correo ?>"> 
                </div>
                <!-- fila 4 -->
                <label for="seleccionaImagen">Carga tu foto de perfil:</label>
                <div class="fila">
                  <i class="fas fa-image tx-naranja"></i>
                  <input type="file" name="imagen" id="seleccionaImagen" value=""/>
                </div>
                <div class="fila mt-bg">
                <span>Actualmente eres: <br><br><span class="badge tx-naranja"><?php echo $_SESSION["tipoUsuario_global"] ?></span></span>
                </div>
              <!-- fila para boton -->
              <div class="fila-boton">
              <button class="boton tx-naranja w-100" type="submit" name="enviar"><i class="fa-solid fa-check"></i>Editar Perfil</button>

            </div>
            </form>
          </div>
        </section>
        <!-- fin nuevo formulario -->
        </div>
    </section>
  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <script src="../assets/js/miperfil.js" defer></script> 
     <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Mi Perfil');</script>
  </body>
</html>
