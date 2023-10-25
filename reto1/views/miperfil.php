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


//--------SI SE ENVIA EN ANUNCIO POR EL BOTON DE ENVIAR--------
if(isset($_POST["enviar"])){
  //obtenemos los campos del formulario];
  date_default_timezone_set("Europe/Madrid");
  $fechaActual = date("Y-m-d H:i:s"); 
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $imagen = $_FILES["imagen"]["name"];
 
  global $Conexionbbdd;
  
  
  validar_Miperfil($nombre, $apellido, $imagen);

  if (!$Conexionbbdd) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}
  $consulta = "UPDATE usuario SET Nombre='$nombre', Apellido='$apellido', Imagen='$imagen' WHERE Nick='$user'";
  
  

  $insertado = $Conexionbbdd -> query($consulta);
  if ($insertado){
    $_SESSION["MensajeExito"] = "El perfil se ha editado Correctamente, y ha sido validado";
       }else {
        $_SESSION["MensajeExito"] = "El perfil no ha sido editado Correctamente, Espera a que sea validado por un administrador";
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
              <!-- fila 2 fluida -->
                  <label for="nombre">Nombre:</label>
                  <div class="fila">
                    <i class="fas fa-user tx-naranja"></i>
                    <input  type="text" name="nombre" id="nombre" value="<?php echo $user ?>">
                  </div>
                <!-- fila 3 -->
                  <label for="apellido">Apellido:</label>
                  <div class="fila">
                    <i class="fas fa-user tx-naranja"></i>
                    <input type="text" name="apellido" id="apellido" value="<?php echo $userapellido ?>">
                  </div>
              <!-- fila 1 -->
              <label for="clase">Clase:</label>
                  <div class="fila">
                    <i class="fas fa-user tx-naranja"></i>
                    <select type="text" name="clase" id="clase" disabled>
                    <?php
                      //obtener clase por id
                      $clase = obtener_clase_por_nick($user);
                      ?>
                         <option value="<?php echo $clase ?>"><?php echo $clase ?></option>
                    </select>
                  </div>
                  <!-- fila tipo -->
                <label for="seleccionaImagen">Carga tu foto de perfil:</label>
                <div class="fila">
                  <i class="fas fa-user tx-naranja"></i>
                  <input type="file" name="imagen" id="seleccionaImagen" value=""/>
                </div>
                <div class="fila mt-bg">
                <span>Actualmente eres: <span class="badge tx-naranja"><?php echo $_SESSION["tipoUsuario_global"] ?></span></span>
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
