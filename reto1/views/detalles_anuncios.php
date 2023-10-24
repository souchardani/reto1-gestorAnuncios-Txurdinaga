<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();
confirmar_admin();
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
    <header>
        <div class="container mt-bg">
          <h1>
              <i class="fa-solid fa-list-ul" style="color: #f3b82a"></i>
              Volver al panel de control
          </h1>
        </div>
    </header>
    <section class="container">
        <div class="d-flex flex-center mb-bg">
            <a class="boton tx-rosa w-50 mt-bg" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
        </div>

    <!-- HEADER END -->
    <!-- main area -->
    <!-- primera tabla -->
      <main class="table mb-bg">
            <section class="table__header">
              <h1 class="heading-02">Anuncios Validados</h1>
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
                          <th>Imagen</th>
                          <th>Comentarios</th>
                          <th>Accion</th>
                          <th>Vista Previa</th>
                        </tr>
                    </thead>
                  <tbody>
              <!-- obtenemos los ultimos 5 anuncios -->
              <?php
                //obtenemos todos los posts de la bbdd
                $stmt = mostrar_todos_anuncios();
                $contador = 0;
                while ($fila = $stmt -> fetch()){
                  $id = $fila["id"];
                  $datetime = $fila["Fecha_publi"];
                  $titulo = $fila["Título"];
                  $categoria =obtener_categoria_porid($id);
                  $autor = $fila["Autor"];
                  $imagen = $fila["Imagen"];
                  $descripcion = $fila["Descripción"];
                  $contador++;
                ?>
              <tr>
                <td><?php echo $contador?></td>
                <td><?php  
                  strlen($titulo)>20 ? $titulo=substr($titulo,0,40)."..." :  $titulo;  //if else para verificar la logitud de caracteres
                  echo $titulo ?></td>
                <td><?php
                  strlen($categoria)>10 ? $categoria=substr($categoria,0,10)."..." :  $categoria; 
                  echo $categoria?></td>
                <td><?php 
                  strlen($datetime)>12 ? $datetime=substr($datetime,0,12)."..." :  $datetime; 
                  echo $datetime?></td>
                <td><?php
                strlen($autor)>6 ? $autor=substr($autor,0,6)."..." :  $autor;
                echo $autor
                ?></td>
                <td><img src="../assets/img_subidas/anuncios/<?php echo $imagen?>" width="170px;" height="50px"> </td>
                <td>
                <?php
                    $comentariossi = obtener_comentarios_aprobados_porid($id);
                    if($comentariossi > 0){
                      echo "<span class='badge verde'>$comentariossi</span>";
                    }
                    ?>
                    <?php
                    $comentariosno = obtener_comentarios_noaprobados_porid($id);
                    if($comentariosno > 0){
                      echo "<span class='badge rojo'>$comentariosno</span>";
                    }
                    ?>
                </td>
                <td>
                  <div class="d-flex gap-tb">
                    <a href="editar_anuncio.php?id=<?php echo $id ?>"><span class="boton amarillo">Editar</span></a>
                    <a href="eliminar_anuncio.php?id=<?php echo $id ?>"><span class="boton rojo">Borrar</span></a>
                  </div>
                </td>
                <td><a href="anuncio_completo.php?id=<?php echo $id ?>" target="_blank"><span class="boton azul">Vista previa</span></a></td>
              </tr>
            <?php }?>
                  </tbody>
                </table>
              </section>
            </main>
          <!-- segunda tabla -->  
          <main class="table mt-bg">
            <section class="table__header">
              <h1 class="heading-02">Anuncios pendientes de validar</h1>
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
                          <th>Imagen</th>
                          <th>Comentarios</th>
                          <th>Accion</th>
                          <th>Vista Previa</th>
                        </tr>
                    </thead>
                  <tbody>
              <!-- obtenemos los ultimos 5 anuncios -->
              <?php
                  //obtenemos todos los posts de la bbdd
                  $stmt = mostrar_todos_anuncios_novalidado();
                  $contador = 0;
                  while ($fila = $stmt -> fetch()){
                    $id = $fila["id"];
                    $datetime = $fila["Fecha_publi"];
                    $titulo = $fila["Título"];
                    $categoria =obtener_categoria_porid($id);
                    $autor = $fila["Autor"];
                    $imagen = $fila["Imagen"];
                    $descripcion = $fila["Descripción"];
                    $contador++;
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $contador?></td>
                      <td><?php  
                        strlen($titulo)>20 ? $titulo=substr($titulo,0,40)."..." :  $titulo;  //if else para verificar la logitud de caracteres
                        echo $titulo ?></td>
                      <td><?php
                        strlen($categoria)>10 ? $categoria=substr($categoria,0,10)."..." :  $categoria; 
                        echo $categoria?></td>
                      <td><?php 
                        strlen($datetime)>12 ? $datetime=substr($datetime,0,12)."..." :  $datetime; 
                        echo $datetime?></td>
                      <td><?php
                      strlen($autor)>6 ? $autor=substr($autor,0,6)."..." :  $autor;
                      echo $autor
                      ?></td>
                      <td><img src="../assets/img_subidas/anuncios/<?php echo $imagen?>" width="170px;" height="50px"> </td>
                      <td><div class="fluid">
                      <?php
                          $comentariossi = obtener_comentarios_aprobados_porid($id);
                          if($comentariossi > 0){
                            echo "<span class='badge verde'>$comentariossi</span>";
                          }
                          ?>
                          <?php
                          $comentariosno = obtener_comentarios_noaprobados_porid($id);
                          if($comentariosno > 0){
                            echo "<span class='badge rojo'>$comentariosno</span>";
                          }
                          ?>
                          </div>
                      </td>
                      <td><div class="fluid">
                        <a href="validar_anuncio.php?id=<?php echo $id ?>"><span class="boton verde"><i class="fas fa-check"></i> Validar</span></a>
                        <a href="eliminar_anuncio.php?id=<?php echo $id ?>"><span class="boton rojo">Borrar</span></a></div>
                      </td>
                      <td><a href="anuncio_completo.php?id=<?php echo $id ?>" target="_blank"><span class="boton azul">Vista previa</span></a></td>
                    </tr>
                  </tbody>
                  <?php }?>
                  </tbody>
                </table>
              </section>
            </main>
            </section>
    <!-- final de main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
  </body>
</html>
