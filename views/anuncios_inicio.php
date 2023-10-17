<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/headtest.php"); ?>
    <title>Anuncios - Inicio</title>
  </head>
  <body>
    <!-- NAVBAR -->
   <?php include("../templates/head-nav.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">
        <!-- inicio seccion principal -->
        <div class="col-sm-8">
          <h1>Anuncios y Noticias - FP Txurdinaga</h1>
          <h1 class="lead">Mira los anuncios destacados del centro</h1>
    <!-- HEADER END -->
          <?php 
          //añadimos el mensaje de exito o error para cada caso especifico
          echo MensajeError();
          echo MensajeExito();
          ?>
          <?php
        
          //si le ha dado al boton buscar, mostramos anuncios personalziados
           if(isset($_GET["btnBuscar"])){
               $stmt = mostrar_anuncios_busqueda();
           }else {
                //por defecto, mostrar todos los anuncios
                $stmt = mostrar_todos_anuncios();
          }
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
          <img class="img-fluid card-img-top" style="max-height: 450px; object-fit: cover;" src="../assets/img_subidas/<?php echo $imagen?>" alt=""/>
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
            <p class="card-text"><?php if(strlen($descripcion)>200){echo substr("$descripcion",0,200)."...<br><br>";}else echo $descripcion?></p>
            <a href="anuncio_completo.php?id=<?php echo $id?>"  style="float: right;">
              <span class="btn btn-info">Ver detalles <i class="fa-solid fa-arrow-right"></i></span>
            </a>
          </div>
        </div>
        <br>
        <?php } ?>
        </div>
        <!-- fin seccion principal -->
        <!-- inicio aside area -->
        <div class="col-sm-4" style="min-height: 40px; ">
          <div class="card mt-4 text-bg-light">
            <div class="card-body text-center">
              <p>Únete y crea tu anuncio!</p>
              <a class="btn btn-primary" href="login.php">Iniciar Sesion</a>
              <a class="btn btn-primary" href="login.php">Crear Cuenta</a>
            </div>
          </div>
          <!-- tarjeta categorias -->
          <div class="card my-5">
            <div class="card-header text-bg-light text-center">
              <h2 class="lead">Categorias</h2>
              <div class="card-body">
                <ul class="list-group">
                <?php
                $categorias = obtener_categorias();
                while ($fila = $categorias -> fetch()){
                  $categoria = $fila["titulo"];
                  echo "<a href='#' class='list-group-item list-group-item-action'>$categoria</a>";
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
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
  </body>
</html>
