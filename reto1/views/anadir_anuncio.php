<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado 
confirmar_login();

//--------SI SE ENVIA EN ANUNCIO POR EL BOTON DE ENVIAR--------
if(isset($_POST["enviar"])){
  //obtenemos los campos del formulario
  $tituloAnuncio = $_POST["tituloAnuncio"];
  $categoria = $_POST["Categoria"];
  $imagen = $_FILES["imagen"]["name"];
  $UbicacionImagen = "../assets/img_subidas/anuncios/".basename($imagen);
  $descripcionAnuncio = $_POST["DescripcionAnuncio"];
  $Autor = $_SESSION["usuario_global"];
  date_default_timezone_set("Europe/Madrid");
  $Fecha_publi = date("Y-m-d");
  //validamos que el usuario sea administrador 
  if ($_SESSION["tipoUsuario_global"] == "Administrador"){
    $Aceptado = 1;
  }else {
    $Aceptado = 0;
  }
  //validaciones previas
    $validado = validar_data_anuncio($tituloAnuncio, $descripcionAnuncio);
    if ($validado){
      insertar_anuncio_bbdd($tituloAnuncio, $Autor, $Aceptado, $Fecha_publi, $categoria, $descripcionAnuncio, $imagen, $UbicacionImagen);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Añadir Anuncio</title>
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
    <!-- boton panel de control -->
    <div class="contenedor-boton-principal mb-bg">
            <a class="boton boton-principal tx-verde-oscuro" 
            <?php ($_SESSION["tipoUsuario_global"] == "Administrador") ? $temp="href='dashboard.php'" :$temp= "href='dashboarduser.php'";
              echo $temp;?>>
              <i class="fa-solid fa-arrow-left"></i> 
              Volver al Panel de Control</a>
              </div>
      <?php 
      //añadimos el mensaje de exito o error para cada caso especifico
      echo MensajeError();
      echo MensajeExito();
       ?>
    <section class="form">
      <div class="contenedor-formulario mt-bg w-70">
        <div class="titulo tx-verde-oscuro"><span>Añadir Anuncio</span></div>
        <form action="anadir_anuncio.php" method="post" enctype="multipart/form-data">
          <!-- fila titulo -->
          <label for="title">Titulo del anuncio:</label>
          <div class="fila">
            <i class="fas fa-user tx-verde-oscuro"></i>
            <input type="text" name="tituloAnuncio" id="title" placeholder="Escribe el titulo aqui"/>
          </div>
          <!-- fila categoria -->
          <label for="tituloCategoria">Escoge la categoria:</label>
          <div class="fila">
            <i class="fas fa-user tx-verde-oscuro"></i>
            <select id="tituloCategoria" name="Categoria">
            <?php
                //añadimos las categorias
                $stmt = obtener_categorias();
                while ($fila = $stmt -> fetch()){
                  //$Id = $fila["id"];
                  $NombreCategoria = $fila["Nombre"];
              ?>
               <option value="<?php echo $NombreCategoria ?>"><?php echo $NombreCategoria ?></option>
                <?php } //fin del while?> 
            </select>
          </div>
          <!-- fila para imagen -->
          <label for="seleccionaImagen">Cargar Imagen:</label>
          <div class="fila">
            <i class="fas fa-user tx-verde-oscuro"></i>
            <input type="file" name="imagen" id="seleccionaImagen" value=""/>
          </div>
           <!-- fila para descripcion -->
           <label for="anuncio">Descripcion del anuncio:</label>
          <div class="fila">
            <textarea name="DescripcionAnuncio" id="anuncio" cols="30" rows="10"></textarea>
          </div>
          <!-- fila para boton -->
          <div class="fila-boton">
          <button class="boton tx-verde-oscuro w-100" type="submit" name="enviar"><i class="fa-solid fa-check"></i>Publicar</button>
          </div>
        </form>
      </div>
    </section>
  </section>
  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
     <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Añadir nuevo anuncio');</script>
  </body>
</html>
