<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();
//verificamos que el usuario sea administrador
confirmar_admin();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Gestionar Comentarios</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div id="dynamicHeader"></div>
    <!-- HEADER END -->
    <section class="container ">
        <div class="d-flex flex-center mb-bg">
            <a class="boton tx-rojo w-50" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
        </div>

        <?php
        echo MensajeError();
        echo MensajeExito();
        ?>
        <main class="table">
        <section class="table__header">
          <h1 class="heading-02">Comentarios Pendientes de aprobar</h1>
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
              <th>Autor</th>
                <th>Texto</th>
                <th>Aprobar</th>
                <th>Eliminar</th>
                <th>Detalles</th>
              </tr>
          </thead>
        <tbody>
          <?php
          $execute = obtener_comentarios_noaprobados();
          $contador = 0;
          while ($fila = $execute -> fetch()){
            $id = $fila["id"];
            $autor = $fila["Autor"];
            $idAnuncio = $fila["Anuncio"];
            $texto = $fila["Texto"];
            $contador++;
          ?>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $autor; ?></td>
              <td><?php echo $texto; ?></td>
              <td><a href="aprobarcomentario.php?id=<?php echo $id; ?>" class="boton verde"><i class="fa-solid fa-check"></i></a></td>
              <td><a href="eliminarcomentario.php?id=<?php echo $id; ?>" class="boton rojo"><i class="fa-solid fa-trash-can"></i></a></td>
              <td><a href="anuncio_completo.php?id=<?php echo $idAnuncio ?>" class="boton azul" target="_blank">Ver Anuncio</a></td>
            </tr>
          <?php } ?>
              </tbody>
            </table>
          </section>
        </main>  
          <!-- segunda tabla -->
        <main class="table mt-bg">
        <section class="table__header">
          <h1 class="heading-02">Comentarios Aprobados</h1>
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
                <th>Autor</th>
                <th>Texto</th>
                <th>Aprobar</th>
                <th>Eliminar</th>
                <th>Detalles</th>
              </tr>
          </thead>
        <tbody>
          <?php
          $execute = obtener_comentarios_noaprobados();
          $contador = 0;
          while ($fila = $execute -> fetch()){
            $id = $fila["id"];
            $autor = $fila["Autor"];
            $idAnuncio = $fila["Anuncio"];
            $texto = $fila["Texto"];
            $contador++;
          ?>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $autor; ?></td>
              <td><?php echo $texto; ?></td>
              <td><a href="aprobarcomentario.php?id=<?php echo $id; ?>" class="boton amarillo"><i class="fa-solid fa-check"></i></a></td>
              <td><a href="eliminarcomentario.php?id=<?php echo $id; ?>" class="boton rojo"><i class="fa-solid fa-trash-can"></i></a></td>
              <td><a href="anuncio_completo.php?id=<?php echo $idAnuncio ?>" class="boton azul" target="_blank">Ver Anuncio</a></td>
            </tr>
          <?php } ?>
              </tbody>
            </table>
          </section>
        </main>  
    </section>
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Comentarios');</script>
  </body>
</html>
