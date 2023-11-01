<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
  //obtenemos el id del anuncion para usarlo en toda la pagina
  $usuario = $_SESSION["usuario_global"];

  $_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
  //verificamos que el usuario este logueado
  confirmar_login();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Mis Anuncios</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="header-section">
      <div class="container mt-sm">
        <?php 
          //añadimos el mensaje de exito o error para cada caso especifico
          echo MensajeError();
          echo MensajeExito();
        ?>
        <h2 class="display-03 mt-bg">
          <i class="fa-solid fa-chart-line" style="color: #fcc204"></i>
          Mis Ultimos Anuncios
        </h2>
        <div class="columnas-anuncios flex">
          <?php
            $stmt = mostrar_mis_anuncios($usuario);

            if ($stmt->rowCount() > 0) {
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
          <?php }} else {?>
              <h3>Todavia no has publicado ningun anuncio</h3>
          <?php }?>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <!-- main area -->
    <div class="container mt-bg">
      <?php 
        //añadimos mensajes de error en caso de que los haya
        echo MensajeError();
        echo MensajeExito();
      ?>
      <!-- inicio area central -->
      <main class="table">
        <section class="table__header">
          <h1 class="heading-02">Mis Anuncios Creados</h1>
          <div class="input-group">
            <input type="search" name="" id="" placeholder="Buscar" />
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </section>
        <section class="table__body">
          <table>
            <thead>
              <tr>
                <th>Nº</th>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Fecha</th>
                <th>Comentarios</th>
                <th>Imagen</th>
                <th>Accion</th>
                <th>Vista Previa</th>
              </tr>
            </thead>
            <tbody>
              <!-- obtenemos los anuncios del usuario -->
              <?php
                $stmt = obtener_anuncios_poruser();
                $contador = 0;

                while($fila = $stmt -> fetch()){
                  $id = $fila["id"];
                  $contador++;
                  $titulo = $fila["Título"];
                  $categoria =obtener_categoria_porid($id);
                  $fecha = $fila["Fecha_publi"];
                  //$descripcion = $fila["Descripción"];
                  $datetime = $fila["Fecha_publi"];
                  $imagen = $fila["Imagen"];
                  $autor = $fila["Autor"];
              ?>
              <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $titulo; ?> </td>
                <td><?php echo $categoria; ?></td>
                <td><small><?php echo $datetime; ?></small></td>
                <td>
                  <div class="fluid">
                    <?php
                      $comentariossi = obtener_comentarios_aprobados_porid($id);

                      if($comentariossi > 0){
                        echo "<p class='badge verde'>$comentariossi</p>";
                      }else {
                        echo "<p class='badge rojo'>0</p>";
                      }
                    ?>
                    <?php
                      // $comentariosno = obtener_comentarios_noaprobados_porid($id);

                      // if($comentariosno > 0){
                      //   echo "<p class='badge rojo'>$comentariosno</p>";
                      // }
                    ?>
                  </div>
                </td>
                <td><img src="../assets/img_subidas/anuncios/<?php echo $imagen ?>" alt=""></td>
                <td><a target="_blank" class="boton tx-amarillo" href="editar_anuncio.php?id=<?php echo  $id ?>">Editar</a></td>
                <td><a target="_blank" class="boton tx-azul" href="anuncio_completo.php?id=<?php echo  $id ?>">Vista Previa</a></td>  
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </section>
      </main>  
      <!-- Mis comentarios -->
      <div class="container mt-bg">
        <h2 class="display-03 mt-sm">
          <i class="fa-regular fa-comments" style="color: #fcc204"></i>
          Mis Comentarios
        </h2>
      </div>
      <main class="table mt-bg">
        <section class="table__header">
          <h1 class="heading-02">Mis Comentarios</h1>
          <div class="input-group">
              <input type="search" name="" id="" placeholder="Buscar" />
              <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </section>
        <section class="table__body">
          <table class="table-center">
            <thead>
                <tr>
                  <th>Nº</th>
                  <th>Anuncio</th>
                  <th>Texto</th>
                  <th>Eliminar</th>
                  <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $execute = obtener_mis_comentarios($usuario);
                $contador = 0;
                while ($fila = $execute -> fetch()){
                  $id = $fila["id"];
                  $autor = $usuario;
                  $idAnuncio = $fila["Anuncio"];
                  $tituloAnuncio = $fila["Título"];
                  $texto = $fila["Texto"];
                  $contador++;
              ?>
              <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $tituloAnuncio; ?></td>
                <td><?php echo $texto; ?></td>
                <td><a href="eliminarcomentario.php?id=<?php echo $id; ?>" class="boton rojo"><i class="fa-solid fa-trash-can"></i></a></td>
                <td><a href="anuncio_completo.php?id=<?php echo $idAnuncio ?>" class="boton azul" target="_blank">Ver Anuncio</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </section>
      </main>
    </div>
    <!-- final de main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
  </body>
</html>
