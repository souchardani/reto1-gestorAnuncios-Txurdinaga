<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestor de Anuncios - cifp Txurdinaga</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/header.css" />

    <!-- LIBRERIA DE ICONOS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
      <!-- FONT AWESOME LINK -->
      <script
      src="https://kit.fontawesome.com/e1e88c9db5.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <!-- incluimos el header -->
    <?php include("../templates/header.php"); ?>
    <section id="home-hero">
      <div class="container flex">
        <div class="left">
          <h3 class="display-03 flex">
            Descubre todas las Noticias y Anuncios de CIFP Txurdinaga
          </h3>
          <p class="body-large-400">Entérate de todas nuestras novedades!</p>
        </div>
        <img src="../assets/img/logocuadro.png" alt="" />
      </div>
    </section>
    <section id="pagina-inicio">
      <div class="container">
        <?php 
          //añadimos el mensaje de exito o error para cada caso especifico
          echo MensajeError();
          echo MensajeExito();
        ?>
        <h2 class="display-03">Anuncios Recientes</h2>
        <div class="columnas-anuncios flex">
        <?php

              $stmt = mostrar_3_anuncios();
          
          while ($fila = $stmt -> fetch()){
            $id = $fila["id"];
            $datetime = $fila["Fecha_publi"];
            $titulo = $fila["Título"];
            $categoria = obtener_categoria_porid($id);
            $autor = $fila["Autor"];
            $imagen = $fila["Imagen"];
            $descripcion = $fila["Descripción"];
        ?>
          <div onclick="location.href='../views/anuncio_completo.php?id=<?php echo $id ?>'">
            <div class="anuncio">
              <img src="../assets/img_subidas/anuncios/<?php echo $imagen?>" alt="" />
              <div class="anuncio-body flex">
                <div class="categoria-info flex body-medium-400">
                  <i class="ph ph-stack"></i>
                  <span><?php echo $categoria?></span>
                </div>
                <h3 class="body-large-400">
                  <?php
                    strlen($titulo)>30 ? $titulo=substr($titulo,0,30)."..." :  $titulo; 
                    echo $titulo
                  ?>
                </h3>
              </div>
              <div class="anuncio-info flex">
                <div class="anuncio-lugar flex">
                  <?php
                    $comentariossi = obtener_comentarios_aprobados_porid($id);
                  ?>
                  <i class="ph ph-chat-circle-dots"></i>
                  <span class="body-small-400 anuncio-ubicacion"> <?php echo $comentariossi ?></span>
                </div>
                <span class="fecha"><?php echo $datetime ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <footer>
      <?php include("../templates/footer.php"); ?>
    </footer>
  </body>
</html>