<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
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
    <div class="container anuncios-inicio  mt-bg">

    <!-- seccion principal nueva -->
        <?php 
          //añadimos el mensaje de exito o error para cada caso especifico
          echo MensajeError();
          echo MensajeExito();
        ?>
        <h2 class="display-03 mt-bg">Anuncios y Noticias - CIFP Txurdinaga</h2>
        <div class="categorias mt-bg">
        <form action="anuncios_inicio.php">
          <select name="categoria" id="categorias">
            <option value="todos los anuncios">Todos</option>
            <?php
                $categorias = obtener_categorias();
                while ($fila = $categorias -> fetch()){
                  $categoria = $fila["Nombre"];
                  echo "<option value='$categoria'>$categoria</option>";
                }
                ?>
          </select>
                <button class="boton tx-rojo"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
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
                  <i class="fa-regular fa-comments"></i>
                  <span class="body-small-400 anuncio-ubicacion"> <?php echo $comentariossi ?></span>
                </div>
                <span class="fecha"><?php echo $datetime ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
      </div>
        <!-- links pagination -->
        <!-- <nav>
          <ul class="pagination pagination-lg">
            <?php
            // $totalAnuncios = obtener_paginacion();
            // $porPagina = ceil($totalAnuncios/5);
            //  //boton anterior
            //  if (isset($_GET["pagina"])){
            //   if($_GET["pagina"] -1 >= 1)
            //   echo "<li class='page-item'><a href='anuncios_inicio.php?pagina=".$_GET["pagina"] - 1 ."' class='page-link'>&laquo</a></li>";
            // }
            // for ($i=1; $i <= $porPagina; $i++) { 
            //   if(isset($_GET["pagina"])) {
            //     if($i==$_GET["pagina"]){
            //       echo "<li class='page-item active'><a href='anuncios_inicio.php?pagina=$i' class='page-link'>$i</a></li>";
            //     } else {
            //     echo "<li class='page-item'><a href='anuncios_inicio.php?pagina=$i' class='page-link'>$i</a></li>";
            //     }
            //   }
            // }
            // //boton siguiente
            // if (isset($_GET["pagina"])){
            //   if($_GET["pagina"] + 1 <= $porPagina)
            //   echo "<li class='page-item'><a href='anuncios_inicio.php?pagina=".$_GET["pagina"] + 1 ."' class='page-link'>&raquo</a></li>";
            // }
            // ?>
          </ul> -->
          <!-- fin links pagination -->
        <!-- fin seccion principal -->
      </div>
    </div>
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
  </body>
</html>
