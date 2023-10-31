<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
  $_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
  //verificamos que el usuario este logueado
  confirmar_login();
  //verificamos que el usuario sea administrador
  confirmar_admin();
  //obtenemos los datos del panel aside del dashboard 
  $datos = obtener_datos_dashboard();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../templates/head.php"); ?>
  <title>Gestionar Anuncios</title>
</head>

<body>
  <!-- NAVBAR -->
  <?php include("../templates/header.php"); ?>
  <!-- NAVBAR END -->
  <!-- HEADER -->
  <div class="container">
    <header>
      <div class="container mt-bg mb-bg">
        <h1>
          <h1><i class="fa-solid fa-cog" style="color: #e20035"></i>
            Panel de Control Administrador
          </h1>
      </div>
    </header>
    <?php
    //añadimos mensajes de error en caso de que los haya
    echo MensajeError();
    echo MensajeExito();
    ?>
    <div class="botones-header">
      <div class="w-100">
        <a href="detalles_anuncios.php" class="boton tx-rosa w-100">
          <i class="fas fa-edit"></i>
          Gestionar Anuncios
        </a>
      </div>
      <div class="w-100">
        <a href="categorias.php" class="boton tx-verde-oscuro w-100">
          <i class="fas fa-folder-plus"></i>
          Gestionar Categorias
        </a>
      </div>
      <div class="w-100">
        <a href="users.php" class="boton tx-morado-oscuro w-100">
          <i class="fas fa-user-plus"></i>
          Gestionar Usuarios
        </a>
      </div>
      <div class="w-100">
        <a href="comentarios.php" class="boton tx-rojo w-100">
          <i class="fas fa-check"></i>
          Gestionar Comentarios
        </a>
      </div>
    </div>
  </div>
  <!-- HEADER END -->
  <!-- MAIN AREA -->
  <div class="container mt-bg">
    <div class="dash-main-top mt-bg">
      <!-- inicio aside area -->
      <div class="main-left">
        <div class="tarjetas">
          <div class="tarjeta">
            <div class="card-body">
              <h1 class="caption-600">Anuncios</h1>
              <h4 class="caption-600">
                <i class="fa-solid fa-newspaper"></i>
                <?php echo $datos["anuncios"]; ?>
              </h4>
            </div>
          </div>
          <div class="tarjeta">
            <div class="card-body">
              <h1 class="caption-600">Categorias</h1>
              <h4 class="caption-600">
                <i class="fas fa-folder"></i>
                <?php echo $datos["categorias"]; ?>
              </h4>
            </div>
          </div>
          <div class="tarjeta">
            <div class="card-body">
              <h1 class="caption-600">Administradores</h1>
              <h4 class="caption-600">
                <i class="fas fa-users"></i>
                <?php echo $datos["admins"]; ?>
              </h4>
            </div>
          </div>
          <div class="tarjeta">
            <div class="card-body">
              <h1 class="caption-600">Comentarios</h1>
              <h4 class="caption-600">
                <i class="fas fa-comments"></i>
                <?php echo $datos["comentarios"]; ?>
              </h4>
            </div>
          </div>
        </div>
      </div>
      <!-- fin aside area -->
      <!-- primera tabla -->
      <main class="table">
        <section class="table__header">
          <h1 class="3">Ultimos anuncios validados</h1>
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
                <th>Autor</th>
                <th>Comentarios</th>
                <th>Vista Previa</th>
              </tr>
            </thead>
            <tbody>
              <!-- obtenemos los ultimos 5 anuncios -->
              <?php
                $stmt = obtener_5_anuncios();
                $contador = 0;
                while ($fila = $stmt->fetch()) {
                  $id = $fila["id"];
                  $datetime = $fila["Fecha_publi"];
                  $titulo = $fila["Título"];
                  $categoria = obtener_categoria_porid($id);
                  $autor = $fila["Autor"];
                  $descripcion = $fila["Descripción"];
                  $contador++;
              ?>
              <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $titulo; ?></td>
                <td><?php echo $categoria; ?></td>
                <td><?php echo $datetime; ?></td>
                <td><?php echo $autor; ?></td>
                <td>
                  <div class="fluid">
                    <?php
                      $comentariossi = obtener_comentarios_aprobados_porid($id);
                      $contadores = obtener_validaciones_pendientes();
                      if ($comentariossi > 0) {
                        echo "<p class='badge verde'>$comentariossi</p>";
                      } else {
                        echo "<span class='badge rojo'>" . $contadores["comentarios"] . "</span>";
                      }
                    ?>
                    <?php
                      $comentariosno = obtener_comentarios_noaprobados_porid($id);
                      if ($comentariosno > 0) {
                        echo "<p class='badge rojo'>$comentariossi</p>";
                      }
                    ?>
                  </div>
                </td>
                <td><a target="_blank" class="boton tx-azul" href="anuncio_completo.php?id=<?php echo  $id ?>">Vista Previa</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </section>
      </main>
      <!-- fin primera tabla -->
    </div>
    <!-- <div class="dash-main-bottom mt-bg"> -->
    <!--segunda tabla  -->
    <main class="table mt-bg">
      <section class="table__header">
        <h1 class="3">Validaciones pendientes</h1>
        <div class="input-group">
          <input type="search" name="" id="" placeholder="Buscar" />
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </section>
      <section class="table__body">
        <table class="table-center">
          <thead>
            <tr>
              <th>Tipo</th>
              <th>Nº</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $contadores = obtener_validaciones_pendientes();
            ?>
            <tr>
              <td>Anuncios</td>
              <td>
                <?php
                  if ($contadores["anuncios"] > 0) {
                    echo "<span class='badge rojo'>" . $contadores["anuncios"] . "</span>";
                  } else {
                    echo "<span class='badge verde'>" . $contadores["usuarios"] . "</span>";
                  }
                ?>
              </td>
              <td><a class="boton tx-morado" href="detalles_anuncios.php">Validar <i class="fas fa-check"></i></a></td>
            </tr>
            <tr>
              <td>Usuarios</td>
              <td>
                <?php
                  if ($contadores["usuarios"] > 0) {
                    echo "<span class='badge rojo'>" . $contadores["usuarios"] . "</span>";
                  } else {
                    echo "<span class='badge verde'>" . $contadores["usuarios"] . "</span>";
                  }
                ?>
              </td>
              <td><a class="boton tx-morado" href="users.php">Validar <i class="fas fa-check"></i></a></td>
            </tr>
            <tr>
              <td>Comentarios</td>
              <td>
                <?php
                  if ($contadores["comentarios"] > 0) {
                    echo "<span class='badge rojo'>" . $contadores["comentarios"] . "</span>";
                  } else {
                    echo "<span class='badge verde'>" . $contadores["usuarios"] . "</span>";
                  }
                ?>
              </td>
              <td><a class="boton tx-morado" href="comentarios.php">Validar <i class="fas fa-check"></i></a></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
      <!-- fin segunda tabla -->
    <!-- </div> -->
  </div>
  <!-- MAIN AREA -->
  <!-- FOOTER -->
  <?php include("../templates/footer.php"); ?>
  <!-- FOOTER END -->
</body>

</html>