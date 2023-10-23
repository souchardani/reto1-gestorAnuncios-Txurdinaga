<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
//verificamos si se ha pasado un anuncio por la url, si no se redirecciona a anuncios
comprobar_variable_url('id', "anuncios_inicio.php");
//obtenemos el id del anuncion para usarlo en toda la pagina
$idAnuncio = $_GET['id']; 
//echo $_SESSION["tipoUsuario_global"];
//validamos que el usuario sea administrador para insertar directamente el comentario
if(isset($_SESSION["tipoUsuario_global"])) {
  if ($_SESSION["tipoUsuario_global"] == "Administrador") {
    $validado = 1;
  }else {
    $validado = 0;
  }
}

?>
<!-- codigo para insertar el comentario en la bbdd -->
<?php
if(isset($_POST["Enviar"])){
  //OBTENEMOS TODOS LOS DATOS DEL COMENTARIO
  $nombre = $_SESSION["usuario_global"];
  //validar_nombre_comentario(); //verificar si el nombre del comentario esta en la bbdd
  $cuerpo = $_POST["cuerpoComentario"];
  $comprobar_campos = verificar_campos_comentario($nombre, $cuerpo, $idAnuncio);
  //si esta correcto, insertar comentario en la bbdd
  if ($comprobar_campos){
    insertar_comentario_bbdd($nombre, $cuerpo, $validado, $idAnuncio);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Anuncios - Inicio</title>
  </head>
  <body>
  
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">
        <!-- inicio seccion principal -->
        <div class="col-sm-8">
          <h1>Anuncios y Noticias - FP Txurdinaga</h1>
          <h1 class="lead mb-4">Mira los anuncios destacados del centro</h1>
          <?php echo MensajeError();
              echo MensajeExito();
          ?>
          <?php
         
          //mostramos el anuncio pasado por la url
          $stmt = mostrar_anuncio_url($idAnuncio);
          while ($fila = $stmt -> fetch()){
            $id = $fila["id"];
            $datetime = $fila["Fecha_publi"];
            $titulo = $fila["Título"];
            $categoria = obtener_categoria_porid($id);
            $autor = $fila["Autor"];
            $imagen = $fila["Imagen"];
            $descripcion = $fila["Descripción"];
        ?>
        <div class="card">
          <img class="img-fluid card-img-top" style="max-height: 450px; object-fit: cover;" src="../assets/img_subidas/anuncios/<?php echo $imagen?>" alt=""/>
          <div class="card-body">
            <h4 class="card-title"><?php echo htmlentities($titulo)?></h4>
            <small class="text-muted">Categoria: <?php echo "<span class='text-dark'>$categoria</span>"?> Publicado Por: <?php echo "<span class='text-dark'>$autor</span>"?> el <?php echo "<span class='text-dark'>$datetime</span>"?></small>
            <span class="badge text-bg-dark" style="float: right;">Comentarios:
            <?php
            $comentariossi = obtener_comentarios_aprobados_porid($id);
            echo $comentariossi;
            ?>
            </span>
            <hr>
            
            <p class="card-text"><?php echo $descripcion?></p>
          </div>
        </div>
        <br>
        <?php } ?>

        <!-- seccion de comentarios -->
        <h1 class="FieldInfo mb-3">Comentarios</h1>
        <!-- obtener comentarios existentes -->
        <?php
        $stmt = obtener_comentario_poranuncio($idAnuncio);
        while($fila = $stmt->fetch()){
          $autor = $fila["Autor"];
          $texto = $fila["Texto"];
        ?>
        <!-- fin de obtener comentarios existentes -->
        <div>
          <div class="media bloque-comentario">
            <img class="img-fluid" src="../assets/img/avatar.svg" width="80px" alt="">
            <div class="media-body m-2">
              <h6 class="lead mb-3"><?php echo $autor ?></h6>
              <p><?php echo $texto ?></p>
            </div>
          </div>
        </div>
        <hr>

        <?php } ?>
        <div>
          <form action="anuncio_completo.php?id=<?php echo $idAnuncio ?>" method="post">
          <div class="card mb-3">
            <div class="card-header">
              <h5 class="FieldInfo">Añade un Comentario:</h5>
            </div>
            <?php 
              if (isset($_SESSION["tipoUsuario_global"])){
            ?>
            <div class="card-body">
              <div class="form-group mb-3">
              </div>
              <div class="form-group mb-3">
                <textarea name="cuerpoComentario" id="" cols="20" rows="5" class="form-control"></textarea>
              </div>
              <button type="submit" name="Enviar" class="btn btn-primary">Enviar Comentario</button>
            </div>
            <?php }
            else {
              echo "<div class='card-body'><p class='lead'>Inicia sesion para comentar</p></div>";
            } 
            ?>
          </div>
          
        </form>
        </div>

        </div>
        <!-- fin seccion principal -->
        <!-- inicio aside area -->
        <div class="col-sm-4" style="min-height: 40px; ">
         
          <!-- tarjeta categorias -->
          <div class="card my-5">
            <div class="card-header text-bg-light text-center">
              <h2 class="lead">Categorias</h2>
              <div class="card-body">
                <ul class="list-group">
                <?php
                $categorias = obtener_categorias();
                while ($fila = $categorias -> fetch()){
                  $categoria = $fila["Nombre"];
                  echo "<a href='anuncios_inicio.php?categoria=$categoria' class='list-group-item list-group-item-action'>$categoria</a>";
                }
                ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- fin aside area -->
      </div>
    </div>
    <!-- HEADER END -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
  </body>
</html>
