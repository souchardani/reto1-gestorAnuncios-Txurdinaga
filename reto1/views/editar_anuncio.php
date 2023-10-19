<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
//verificamos que se pase el id por la url
comprobar_variable_url('id', "detalles_anuncios.php");
//obtenemos el id del anuncio
$idAnuncio = $_GET["id"];

//verificamos que el usuario este logueado como administrador
confirmar_login();



//si se ha enviado el formulario
if(isset($_POST["enviar"])){
  $tituloAnuncio = $_POST["tituloAnuncio"];
  $categoria = null; //$_POST["Categoria"];
  $imagen = $_FILES["imagen"]["name"];
  $target = "../assets/img_subidas/anuncios/".basename($imagen);
  $descripcionAnuncio = $_POST["DescripcionAnuncio"];
  $Admin = "Daniel";
  date_default_timezone_set("Europe/Madrid");
  $fechaActual = date("Y-m-d H:i:s"); 

    //validaciones previas
    $validado = validar_data_anuncio($tituloAnuncio, $descripcionAnuncio);
    if ($validado){
       //actualizar el anuncio en la bbdd
      editar_anuncio_bbdd($tituloAnuncio, $categoria, $imagen, $descripcionAnuncio, $idAnuncio, $target);
    } 
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Editar Anuncio</title>
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
      //añadimos el mensaje de exito o error para cada caso especifico
      echo MensajeError();
      echo MensajeExito();
      //obtener los datos del anuncio seleccionado
      $stmt = mostrar_anuncio_url($idAnuncio);
      //al no devolver filas, quiere decir que no hay anuncios con ese id
      if (!($stmt->rowCount() > 0)){
        $_SESSION["MensajeError"] = "Error en la peticion! Vuelve a intentarlo (no existe el anuncio)";
        Redireccionar_A("detalles_anuncios.php");
      }else {
      while($fila = $stmt -> fetch()){
        $titulo_ant = $fila["Título"];
        $categoria_ant = obtener_categoria_porid($idAnuncio);
        $imagen_ant = $fila["Imagen"];
        $descripcion_ant = $fila["Descripción"];
      } 
       ?>
      <form class="" action="editar_anuncio.php?id=<?php echo $idAnuncio ?>" method="post" enctype="multipart/form-data">
        <div class="card text-bg-secondary mb-3">
          <div class="card-body text-bg-light">
            <div class="form-group mb-5">
              <label class="mb-3" for="title"><span class="FieldInfo">Titulo del anuncio:</span></label>
              <input class="form-control " type="text" name="tituloAnuncio" id="title" value='<?php echo $titulo_ant ?>'>
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="tituloCategoria"><span class="FieldInfo">Escoge la categoria:</span></label>
              <select class="form-control" id="tituloCategoria" name="Categoria" disabled>
                <?php
                //añadimos las categorias
                  $stmt = obtener_categorias();
                  while ($fila = $stmt -> fetch()){
                    $NombreCategoria = $fila["Nombre"];
                ?>
                <option value="<?php echo $NombreCategoria ?>" <?php $categoria_ant == $NombreCategoria ? $selected="selected" : $selected=""; echo $selected?>>
                <?php echo $NombreCategoria ?></option>
                <?php } } //fin del while y del else?> 
              </select>
            </div>
            <div class="form-group mb-5">
            <span class="FieldInfo">Imagen Anterior:</span>
            <img class="mb-1" src="../assets/img_subidas/anuncios/<?php echo $imagen_ant?>" width="170px" height="70px" alt="">
              
              <br>
              <label class="mb-3" for="seleccionaImagen"><span class="FieldInfo">Cargar Imagen:</span></label>
              <div >
                <input class="form-control" type="file" name="imagen" id="seleccionaImagen" value=""/>
              </div>
            </div>
            <div class="form-group mb-5">
            <label class="mb-3" for="anuncio"><span class="FieldInfo">Descripcion del anuncio:</span></label>
            <textarea class="form-control" name="DescripcionAnuncio" id="anuncio" cols="30" rows="10"><?php echo $descripcion_ant ?></textarea>
            </div>
            
            <div class="row">
            <div class="col-lg-6 mb-2">
              <a class="btn btn-warning d-lg-block w-100" href="detalles_anuncios.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div class="col-lg-6 mb-2  d-md-block ">
              <button type="submit" name="enviar" class="btn btn-success w-100"><i class="fa-solid fa-check"></i> Editar</button>
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
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Editar Anuncio');</script>
  </body>
</html>
