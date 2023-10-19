<?php require_once("assets/includes/DB.php"); ?>
<?php require_once("assets/includes/funciones.php"); ?>
<?php require_once("assets/includes/sesiones.php"); ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestor de Anuncios - cifp Txurdinaga</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/header.css" />

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
    <?php include("templates/headerindex.php"); ?>
    <section id="home-hero">
      <div class="container flex">
        <div class="left">
          <h3 class="display-03 flex">
            Descubre todas las Noticias y Anuncios de cifp Txurdinaga
          </h3>
          <p class="body-large-400">Enterate de todas nuestras novedades!</p>
        </div>
        <img src="assets/img/logocuadro.png" alt="" />
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
        
          //si le ha dado al boton buscar, mostramos anuncios personalziados
           if(isset($_GET["btnBuscar"])){
               $stmt = mostrar_anuncios_busqueda();
          //busqueda para paginacion ex. anuncios_inicio.php?pagina=1
           }else if(isset($_GET["pagina"])){
               $stmt = mostrar_anuncios_paginacion();
               //busqueda por categoria
           }else if (isset($_GET["categoria"])){
               $stmt = mostrar_anuncios_categoria();

           }
           else {
            //por defecto, mostrar todos los anuncios (lo capamos en 5)
              $stmt = mostrar_todos_anuncios();
          }
          while ($fila = $stmt -> fetch()){
            $id = $fila["id"];
            $datetime = $fila["Fecha_publi"];
            $titulo = $fila["Título"];
            $categoria = obtener_categoria_porid($id);
            $autor = $fila["Autor"];
            $imagen = $fila["Imagen"];
            $descripcion = $fila["Descripción"];
        ?>
          <div onclick="location.href='views/anuncio_completo.php?id=<?php echo $id ?>'">
            <div class="anuncio">
              <img src="assets/img_subidas/anuncios/<?php echo $imagen?>" alt="" />
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
      <?php include("templates/footerindex.php"); ?>
    </footer>
  </body>
</html>