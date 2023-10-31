<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
  //verificamos que se pase el id por la url
  comprobar_variable_url('id', "detalles_anuncios.php");
  //obtenemos el id del anuncio
  $idAnuncio = $_GET["id"];
  //si el usuario no esta logueado, lo redirigimos al login
  confirmar_login();
  //si el usuario no es admin, lo redirigimos al inicio
  confirmar_admin();

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
  }

  //si se ha enviado el formulario, eliminar el anuncio
  if(isset($_POST["enviar"])){
    //borrar el anuncio en la bbdd
    $eliminado = eliminar_anuncio_bbdd($idAnuncio, $imagen_ant);
    if ($eliminado){
      $_SESSION["MensajeExito"] = "El Anuncio se ha Eliminado Correctamente";
      Redireccionar_A("detalles_anuncios.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado al eliminar, vuelve a intentarlo";
      Redireccionar_A("detalles_anuncios.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Borrar Anuncio</title>
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
        //añadimos el mensaje de exito o error para cada caso especifico
        echo MensajeError();
        echo MensajeExito();
      ?>
      <div class="contenedor-boton-principal">
        <a class="boton boton-principal tx-rojo mt-bg" 
          <?php ($_SESSION["tipoUsuario_global"] == "Administrador") ? $temp="href='detalles_anuncios.php'" :$temp= "href='dashboarduser.php'";
            echo $temp;
          ?>>
          <i class="fa-solid fa-arrow-left"></i> 
          Volver a Gestionar Anuncios
        </a>
      </div>
      <section class="form" >
        <div class="contenedor-formulario mt-bg w-70">
          <div class="titulo tx-rojo"><span>Borrar Anuncio</span></div>
          <form id="formulario" action="eliminar_anuncio.php?id=<?php echo $idAnuncio ?>" method="post" enctype="multipart/form-data">
            <!-- fila titulo -->
            <label for="title">Titulo del anuncio:</label>
            <div class="fila">
              <i class="fas fa-newspaper tx-rojo"></i>
              <input type="text" name="tituloAnuncio" id="title" value="<?php echo $titulo_ant ?>" disabled/>
            </div>
            <!-- fila categoria -->
            <label for="tituloCategoria">Escoge la categoria:</label>
            <div class="fila">
              <i class="fas fa-bookmark tx-rojo"></i>
              <select id="tituloCategoria" name="Categoria">
                <option value="<?php echo $categoria_ant ?>"><?php echo $categoria_ant ?></option>
              </select>
            </div>
            <!-- fila para ver la imagen -->
            <label for="tituloCategoria">Imagen:</label>
            <div class="fila">
              <img class="mb-1" src="../assets/img_subidas/anuncios/<?php echo $imagen_ant?>" width="170px" height="70px" alt="">
            </div>
            <!-- fila para descripcion -->
            <label for="anuncio">Descripcion del anuncio:</label>
            <div class="fila">
              <textarea disabled name="DescripcionAnuncio" id="anuncio" cols="30" rows="10"><?php echo $descripcion_ant ?></textarea>
            </div>
            <!-- fila para boton -->
            <div class="fila-boton">
            <button onclick="return confirmarBorrado()" type="submit" name="enviar" class="boton tx-rojo w-100"><i class="fas fa-trash"></i> Borrar</button>
            </div>
          </form>
        </div>
    </section>
        </div>
      </form>
  </section>

  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Eliminar Anuncio');</script>
  </body>
</html>
