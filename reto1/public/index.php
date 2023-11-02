<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
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
      <div class="carrusel">
        <div id="slide">
          <?php
            $stmt = mostrar_5_anuncios();

            while ($fila = $stmt -> fetch()){
              $id = $fila["id"];
              $titulo = $fila["Título"];
              $imagen = $fila["Imagen"];
              $descripcion = $fila["Descripción"];
          ?>
          <div class="item" style="background-image:linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)),url(../assets/img_subidas/anuncios/<?php echo $imagen?>);">
            <div class="content">
              <p class="name heading-03"><?php echo $titulo?></p>
              <p class="des body-large-600">
                <?php
                  strlen($descripcion)>250 ? $descripcion=substr($descripcion,0,250)."..." :  $descripcion;  //if else para verificar la logitud de caracteres
                  echo $descripcion 
                ?>
              </p>
              <button class="boton tx-morado" onclick="location.href='../views/anuncio_completo.php?id=<?php echo $id ?>'">Ver Anuncio</button>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="buttons">
          <button class="boton tx-verde-claro" id="prev" onclick="updateCarr('prev')"><i class="fa-solid fa-arrow-left"></i></button>
          <button class="boton tx-verde-claro" id="next" onclick="updateCarr('next')"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>

      <div class="container mt-bg">
        <?php 
          //añadimos el mensaje de exito o error para cada caso especifico
          echo MensajeError();
          echo MensajeExito();
        ?>
        <h2 class="display-03 mt-bg">Anuncios Recientes</h2>
        <div class="columnas-anuncios-inicio flex" >
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
                  <?php $comentariossi = obtener_comentarios_aprobados_porid($id);?>
                  <i class="ph ph-chat-circle-dots"></i>
                  <span class="body-small-400 anuncio-ubicacion"> <?php echo $comentariossi ?></span>
                </div>
                <span class="fecha"><?php echo $datetime ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <a href="../views/anuncios_inicio.php" class="boton tx-azul"><span>Ver mas</span></a>
      </div>
    </section>
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="../assets/js/app.js"></script>
  </body>
</html>
