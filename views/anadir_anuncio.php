<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();

//--------SI SE ENVIA EN ANUNCIO POR EL BOTON DE ENVIAR--------
if(isset($_POST["enviar"])){
  //obtenemos los campos del formulario
  $tituloAnuncio = $_POST["tituloAnuncio"];
  $categoria = $_POST["Categoria"];
  $imagen = $_FILES["imagen"]["name"];
  $target = "img_subidas/".basename($imagen);
  $descripcionAnuncio = $_POST["DescripcionAnuncio"];
  $Admin = $_SESSION["usuario_global"];
  date_default_timezone_set("Europe/Madrid");
  $fechaActual = date("Y-m-d H:i:s"); 

  //validaciones previas
    $validado = validar_data_anuncio($tituloAnuncio, $descripcionAnuncio);
    if ($validado){
    insertar_anuncio_bbdd($fechaActual,$tituloAnuncio,$categoria,$Admin,$imagen,$descripcionAnuncio, $target);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/headtest.php"); ?>
    <title>Añadir Anuncio</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("../templates/navbaradmin.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div id="dynamicHeader"></div>
    <!-- HEADER END -->
  <!-- MAIN AREA -->
  <section class="container py-2 mb-4">
    <div class="row" >
      <div class="offset-lg-1 col-lg-10" style="min-height: 50vh;">
      <?php 
      //añadimos el mensaje de exito o error para cada caso especifico
      echo MensajeError();
      echo MensajeExito();
       ?>
      <form class="" action="anadir_anuncio.php" method="post" enctype="multipart/form-data">
        <div class="card text-bg-secondary mb-3">
          
          <div class="card-body text-bg-light">
            <div class="form-group mb-5">
              <label class="mb-3" for="title"><span class="FieldInfo">Titulo del anuncio:</span></label>
              <input class="form-control " type="text" name="tituloAnuncio" id="title" placeholder="Escribe el titulo aqui">
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="tituloCategoria"><span class="FieldInfo">Escoge la categoria:</span></label>
              <select class="form-control" id="tituloCategoria" name="Categoria">
                <?php
                //añadimos las categorias
                $stmt = obtener_categorias();
                while ($fila = $stmt -> fetch()){
                  //$Id = $fila["id"];
                  $NombreCategoria = $fila["titulo"];
                ?>
                <option value="<?php echo $NombreCategoria ?>"><?php echo $NombreCategoria ?></option>
                <?php } //fin del while?> 
              </select>
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="seleccionaImagen"><span class="FieldInfo">Cargar Imagen:</span></label>
              <div >
                <input class="form-control" type="file" name="imagen" id="seleccionaImagen" value=""/>
              </div>
            </div>
            <div class="form-group mb-5">
            <label class="mb-3" for="anuncio"><span class="FieldInfo">Descripcion del anuncio:</span></label>
            <textarea class="form-control" name="DescripcionAnuncio" id="anuncio" cols="30" rows="10"></textarea>
            </div>
            
            <div class="row">
            <div class="col-lg-6 mb-2">
              <a class="btn btn-warning d-lg-block w-100" href="detalles_anuncios.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div class="col-lg-6 mb-2  d-md-block ">
              <button type="submit" name="enviar" class="btn btn-success w-100"><i class="fa-solid fa-check"></i> Publicar</button>
            </div>
          </div>
          </div>
        </div>

      </form>
    </div>
    </div>
  </section>
  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
     <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Añadir nuevo anuncio');</script>
  </body>
</html>
