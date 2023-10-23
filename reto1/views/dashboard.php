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
     <section class="header-section">
      <div class="container">
        <div class="titulo-header">
            <h1><i class="fa-solid fa-cog" style="color: #e20035"></i> Panel de Control Administrador</h1>
        </div>
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
           <main class="table">
            <section class="table__header">
              <h1 class="heading-02">Ultimos anuncios validados</h1>
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
              while($fila = $stmt -> fetch()){
                $id = $fila["id"];
                $datetime = $fila["Fecha_publi"];
                $titulo = $fila["Título"];
                $categoria =obtener_categoria_porid($id);
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
                  <td><div class="fluid">
                    <?php
                    $comentariossi = obtener_comentarios_aprobados_porid($id);
                    if($comentariossi > 0){
                      echo "<p class='badge verde'>$comentariossi</p>";
                    }
                    ?>
                    <?php
                    $comentariosno = obtener_comentarios_noaprobados_porid($id);
                    if($comentariosno > 0){
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
             <!--segunda tabla  -->
         
            <main class="table mt-bg">
              <section class="table__header">
                <h1 class="heading-02">Validaciones pendientes</h1>
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
                <td>Comentarios</td>
                <td><?php 
                if($contadores["comentarios"]>0) {
                  echo "<span class='badge rojo'>". $contadores["comentarios"] . "</span>";
                  }else {
                    echo "<span class='badge verde'>". $contadores["usuarios"] . "</span>";
                  }
                ?></td>
                <td><a class="boton tx-morado" href="comentarios.php">Validar <i class="fas fa-check"></i></a></td>
              </tr>
              <tr>
                <td>Anuncios</td>
                <td><?php 
                  if($contadores["anuncios"]>0) {
                    echo "<span class='badge rojo'>". $contadores["anuncios"] . "</span>";
                    }else {
                      echo "<span class='badge verde'>". $contadores["usuarios"] . "</span>";
                    }
                 ?></td>
                <td><a class="boton tx-morado" href="detalles_anuncios.php">Validar <i class="fas fa-check"></i></a></td>
              </tr>
              <tr>
                <td>Usuarios</td>
                <td><?php
                 if($contadores["usuarios"]>0) {
                  echo "<span class='badge rojo'>". $contadores["usuarios"] . "</span>";
                  }else {
                    echo "<span class='badge verde'>". $contadores["usuarios"] . "</span>";
                  }
                 ?></td>
                <td><a class="boton tx-morado" href="users.php">Validar <i class="fas fa-check"></i></a></td>
                
              </tr>
              </tbody>
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
