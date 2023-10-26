<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
//verificamos que se pase el id por la url
comprobar_variable_url('id', "detalles_anuncios.php");
//obtenemos el id del anuncio
$idAnuncio = $_GET["id"];

//verificamos que el usuario este logueado
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
       <section class="form" >
      <div class="contenedor-formulario mt-bg w-70">
        <div class="titulo tx-verde-oscuro"><span>Editar Anuncio</span></div>
        <form id="formulario" action="editar_anuncio.php?id=<?php echo $idAnuncio ?>" method="post" enctype="multipart/form-data">
          <!-- fila titulo -->
          <label for="title">Titulo del anuncio:</label>
          <div class="fila">
            <i class="fas fa-user tx-verde-oscuro"></i>
            <input type="text" name="tituloAnuncio" id="title" value="<?php echo $titulo_ant ?>"/>
          </div>
          <!-- fila categoria -->
          <label for="tituloCategoria">Escoge la categoria:</label>
          <div class="fila">
            <i class="fas fa-user tx-verde-oscuro"></i>
            <select disabled id="tituloCategoria" name="Categoria">
            <?php
                //añadimos las categorias
                $stmt = obtener_categorias();
                while ($fila = $stmt -> fetch()){
                  //$Id = $fila["id"];
                  $NombreCategoria = $fila["Nombre"];
              ?>
               <option value="<?php echo $NombreCategoria ?>" <?php $categoria_ant == $NombreCategoria ? $selected="selected" : $selected=""; echo $selected?>>
                <?php echo $NombreCategoria ?></option>
                <?php } //fin del while?> 
            </select>
          </div>
          <!-- fila para ver la imagen -->
          <label for="tituloCategoria">Imagen Anterior:</label>
          <div class="fila">
            <img class="mb-1" src="../assets/img_subidas/anuncios/<?php echo $imagen_ant?>" width="170px" height="70px" alt="">
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
            <textarea name="DescripcionAnuncio" id="anuncio" cols="30" rows="10"><?php echo $descripcion_ant ?></textarea>
          </div>
          <!-- fila para boton -->
          <div class="fila-boton">
          <button class="boton tx-verde-oscuro w-100" type="submit"  value ="Publicar" name="enviar"><i class="fa-solid fa-check"></i>Editar</button>
          </div>
        </form>
      </div>
    </section>
    <?php }  //fin del else?> 

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
