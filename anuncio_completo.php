<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/funciones.php"); ?>
<?php require_once("includes/sesiones.php"); ?>
<?php
//verificamos si se ha pasado un anuncio por la url, si no se redirecciona a anuncios
comprobar_variable_url('id', "anuncios_inicio.php");
//obtenemos el id del anuncion para usarlo en toda la pagina
$idAnuncio = $_GET['id']; 
?>
<!-- codigo para insertar el comentario en la bbdd -->
<?php
if(isset($_POST["Enviar"])){
  //OBTENEMOS TODOS LOS DATOS DEL COMENTARIO
  $nombre = $_POST["nombreComentario"];
  $email = $_POST["emailComentario"];
  $cuerpo = $_POST["cuerpoComentario"];
  date_default_timezone_set("Europe/Madrid");
  $datetime = date("Y-m-d H:i:s"); 

  $comprobar_campos = verificar_campos_comentario($nombre, $email, $cuerpo, $idAnuncio);
  //si esta correcto, insertar comentario en la bbdd
  if ($comprobar_campos){
    insertar_comentario_bbdd($datetime, $nombre, $email, $cuerpo, $idAnuncio);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("vistas_comunes/head.php"); ?>
    <title>Anuncios - Inicio</title>
  </head>
  <body>
  
    <!-- NAVBAR -->
    <?php include("vistas_comunes/headerbasic.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">
        <!-- inicio seccion principal -->
        <div class="col-sm-8">
          <h1>Anuncios y Noticias - FP Txurdinaga</h1>
          <h1 class="lead">Mira los anuncios destacados del centro</h1>
          <?php echo MensajeError();
              echo MensajeExito();
          ?>
          <?php
         
          //mostramos el anuncio pasado por la url
          $stmt = mostrar_anuncio_url($idAnuncio);
          while ($fila = $stmt -> fetch()){
            $id = $fila["id"];
            $datetime = $fila["datetime"];
            $titulo = $fila["titulo"];
            $categoria = $fila["categoria"];
            $autor = $fila["autor"];
            $imagen = $fila["imagen"];
            $descripcion = $fila["descripcion"];
        ?>
        <div class="card">
          <img class="img-fluid card-img-top" style="max-height: 450px; object-fit: cover;" src="img_subidas/<?php echo $imagen?>" alt=""/>
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
          $datetime = $fila["datetime"];
          $nombre = $fila["nombre"];
          $cuerpo = $fila["cuerpo"];
        ?>
        <!-- fin de obtener comentarios existentes -->
        <div>
          <div class="media bloque-comentario">
            <img class="img-fluid" src="img/avatar.svg" width="80px" alt="">
            <div class="media-body m-2">
              <h6 class="lead"><?php echo $nombre ?></h6>
              <p class="small"><?php echo $datetime ?></p>
              <p><?php echo $cuerpo ?></p>
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
            <div class="card-body">
              <div class="form-group mb-3">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input class="form-control" type="text" name="nombreComentario" placeholder="Nombre" id="">
                </div> 
              </div>
              <div class="form-group mb-3">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  <input class="form-control" type="email" name="emailComentario" placeholder="Email" id="">
                </div> 
              </div>
              <div class="form-group mb-3">
                <textarea name="cuerpoComentario" id="" cols="20" rows="5" class="form-control"></textarea>
              </div>
              <button type="submit" name="Enviar" class="btn btn-primary">Enviar Comentario</button>
            </div>
          </div>
        </form>
        </div>

        </div>
        <!-- fin seccion principal -->
        <!-- inicio aside area -->
        <div class="col-sm-4" style="min-height: 40px; ">
          <div class="card mt-4">
            <div class="card-body text-center">
              <p>Unete y crea tu anuncio!</p>
              <a class="btn btn-primary" href="">Iniciar Sesion</a>
              <a class="btn btn-primary" href="">Crear Cuenta</a>
            </div>
          </div>
        </div>
        <!-- fin aside area -->
      </div>
    </div>
    <!-- HEADER END -->
    <!-- FOOTER -->
    <?php include("vistas_comunes/footer.php"); ?>
  </body>
</html>
