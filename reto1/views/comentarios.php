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
    <section class="container py-2 mb-4">
      <div class="row" style="min-height: 30px;">
        <div class="col-lg-12" style="min-height: 400px;">
        <h2>Comentarios Pendientes de aprobar</h2>
        <?php
        echo MensajeError();
        echo MensajeExito();
        ?>
          <table class="table table-stripped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Nº</th>
                <th>Autor</th>
                <th>Texto</th>
                <th>Aprobar</th>
                <th>Eliminar</th>
                <th>Detalles</th>
              </tr>
            </thead>
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
          <tbody>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $autor; ?></td>
              <td><?php echo $texto; ?></td>
              <td><a href="aprobarcomentario.php?id=<?php echo $id; ?>" class="btn btn-success"><i class="fa-solid fa-check"></i></a></td>
              <td><a href="eliminarcomentario.php?id=<?php echo $id; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
              <td><a href="anuncio_completo.php?id=<?php echo $idAnuncio ?>" class="btn btn-primary" target="_blank">Ver Anuncio</a></td>
            </tr>
          </tbody>
          <?php } ?>
          </table>
          <!-- segunda tabla -->
          <h2>Comentarios Aprobados</h2>
          <table class="table table-stripped table-hover">
            <thead class="table-dark">
              <tr>
              <th>Nº</th>
                <th>Autor</th>
                <th>Texto</th>
                <th>Aprobar</th>
                <th>Eliminar</th>
                <th>Detalles</th>
              </tr>
            </thead>
          <?php
          $execute = obtener_comentarios_aprobados();
          $contador = 0;
          while ($fila = $execute -> fetch()){
            $id = $fila["id"];
            $autor = $fila["Autor"];
            $idAnuncio = $fila["Anuncio"];
            $texto = $fila["Texto"];
            $contador++;
          ?>
          <tbody>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $autor; ?></td>
              <td><?php echo $texto; ?></td>
              <td><a href="desaprobarcomentario.php?id=<?php echo $id; ?>" class="btn btn-warning"><i class="fa-solid fa-x"></i></a></td>
              <td><a href="eliminarcomentario.php?id=<?php echo $id; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
              <td><a href="anuncio_completo.php?id=<?php echo $idAnuncio ?>" class="btn btn-primary" target="_blank">Ver Anuncio</a></td>
            </tr>
          </tbody>
          <?php } ?>
          </table>
        </div>
      </div>
    </section>
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Comentarios');</script>
  </body>
</html>
