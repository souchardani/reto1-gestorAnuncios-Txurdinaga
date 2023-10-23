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
      <form class="" action="eliminar_anuncio.php?id=<?php echo $idAnuncio ?>" method="post" enctype="multipart/form-data">
        <div class="card text-bg-secondary mb-3">
          <div class="card-body text-bg-light">
            <div class="form-group mb-5">
              <label class="mb-3" for="title"><span class="FieldInfo">Titulo del anuncio:</span></label>
              <input class="form-control" type="text" name="tituloAnuncio" id="title" value='<?php echo $titulo_ant ?>' disabled>
            </div>
            <div class="form-group mb-5">
              <label class="mb-3" for="tituloCategoria"><span class="FieldInfo">Categoria:</span></label>
              <select class="form-control" id="tituloCategoria" name="Categoria" disabled>
                <option value="<?php echo $categoria_ant ?>"><?php echo $categoria_ant ?></option>
              </select>
            </div>
            <div class="form-group mb-5">
            <span class="FieldInfo">Imagen:</span>
            <img class="mb-1" src="../assets/img_subidas/anuncios/<?php echo $imagen_ant?>" width="170px" height="70px" alt="">
              <br>
            </div>
            <div class="form-group mb-5">
            <label class="mb-3" for="anuncio"><span class="FieldInfo">Descripcion del anuncio:</span></label>
            <textarea disabled class="form-control" name="DescripcionAnuncio" id="anuncio" cols="30" rows="10"><?php echo $descripcion_ant ?></textarea>
            </div>
            
            <div class="row">
            <div class="col-lg-6 mb-2">
              <a class="btn btn-warning d-lg-block w-100" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div class="col-lg-6 mb-2  d-md-block ">
              <button onclick="return confirmarBorrado()" type="submit" name="enviar" class="btn btn-danger w-100"><i class="fas fa-trash"></i> Borrar</button>
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
    <script>window.onload = () => createDynamicHeader('Eliminar Anuncio');</script>
  </body>
</html>
