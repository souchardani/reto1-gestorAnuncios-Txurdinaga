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
    <header class="text-bg-light py-3">
      <div class="container">
        <div class="row ">
          <div class="col-md-12 mb-3">
            <h1><i class="fa-solid fa-cog" style="color: #f3b82a"></i> Panel de Control</h1>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="anadir_anuncio.php" class="btn btn-primary w-100">
              <i class="fas fa-edit"></i>
              Añadir Anuncio
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="categorias.php" class="btn btn-info btn-block w-100">
              <i class="fas fa-folder-plus"></i>
              Añadir Categoria
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="users.php" class="btn btn-warning btn-block w-100">
              <i class="fas fa-user-plus"></i>
                Añadir Usuario
            </a>
          </div>
          <!-- <div class="col-lg-3">
            <a href="aprobarAnuncios.php" class="btn btn-success btn-block w-100">
              <i class="fas fa-check"></i>
                Aprobar Anuncios
            </a>
          </div> -->
          <div class="col-lg-3">
            <a href="comentarios.php" class="btn btn-success btn-block w-100">
              <i class="fas fa-check"></i>
                Aprobar Comentarios
            </a>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <!-- main area -->
    <div class="container py-2 my-4">
      <div class="row">
          <?php 
          //añadimos mensajes de error en caso de que los haya
            echo MensajeError();
            echo MensajeExito();
          ?>
          <!-- inicio aside area -->
          <div class="col-lg-2 d-none d-md-block">
            <div class="card text-center text-bg-dark mb-3">
              <div class="card-body">
                <h1 class="lead">Anuncios</h1>
                  <h4 class="fs-5">
                  <i class="fa-solid fa-newspaper"></i>
                    <?php echo $datos["anuncios"]; ?>
                  </h4>
              </div>
            </div>
            <div class="card text-center text-bg-dark mb-3">
              <div class="card-body">
                <h1 class="lead">Categorias</h1>
                  <h4 class="fs-5">
                  <i class="fas fa-folder"></i>
                  <?php echo $datos["categorias"]; ?>
                  </h4>
              </div>
            </div>
            <div class="card text-center text-bg-dark mb-3">
              <div class="card-body">
                <h1 class="lead">Administradores</h1>
                  <h4 class="fs-5">
                  <i class="fas fa-users"></i>
                  <?php echo $datos["admins"]; ?>
                  </h4>
              </div>
            </div>
            <div class="card text-center text-bg-dark mb-3">
              <div class="card-body">
                <h1 class="lead">Comentarios</h1>
                  <h4 class="fs-5">
                  <i class="fas fa-comments"></i>
                  <?php echo $datos["comentarios"]; ?>
                  </h4>
              </div>
            </div>
          </div>
           <!-- fin aside area -->

           <!-- inicio area central -->
           <div class="col-lg-10">
            <h1>Ultimos Anuncios</h1>
            <table class="table table-stripped table-hover">
              <thead class="table-dark">
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
              <!-- obtenemos los ultimos 5 anuncios -->
              <?php
              $stmt = obtener_5_anuncios();
              $contador = 0;
              while($fila = $stmt -> fetch()){
                $id = $fila["id"];
                $datetime = $fila["Fecha_publi"];
                $titulo = $fila["Título"];
                $categoria =obtener_categoria_porid($id);
                $autor = $fila["Autor"];
                $descripcion = $fila["Descripción"];
                $contador++;
              ?>
              <tbody>
                <tr>
                  <td><?php echo $contador; ?></td>
                  <td><?php echo $titulo; ?></td>
                  <td><?php echo $categoria; ?></td>
                  <td><?php echo $datetime; ?></td>
                  <td><?php echo $autor; ?></td>
                  <td>
                    <?php
                    $comentariossi = obtener_comentarios_aprobados_porid($id);
                    if($comentariossi > 0){
                      echo "<span class='badge text-bg-success'>$comentariossi</span>";
                    }
                    ?>
                    <?php
                    $comentariosno = obtener_comentarios_noaprobados_porid($id);
                    if($comentariosno > 0){
                      echo "<span class='badge text-bg-danger'>$comentariosno</span>";
                    }
                    ?>
                  </td>
                  <td><a target="_blank" class="btn btn-info" href="anuncio_completo.php?id=<?php echo  $id ?>">Vista Previa</a></td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
           </div>
           <!-- fin area central -->
      </div>
    </div>
    <!-- final de main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
  </body>
</html>
