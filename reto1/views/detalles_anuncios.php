<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();
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
            <h1><i class="fa-solid fa-list-ul" style="color: #f3b82a"></i> Todos los anuncios</h1>
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
                Añadir Usuarios
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
        <div class="col-lg-12">
          <table class="table table-striped table-hover">
          <?php 
          //añadimos mensajes de error en caso de que los haya
            echo MensajeError();
            echo MensajeExito();
            ?>
            <thead class="table-dark">
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
                <td>
                  <a href="editar_anuncio.php?id=<?php echo $id ?>"><span class="btn btn-warning">Editar</span></a>
                  <a href="eliminar_anuncio.php?id=<?php echo $id ?>"><span class="btn btn-danger">Borrar</span></a>
                </td>
                <td><a href="anuncio_completo.php?id=<?php echo $id ?>" target="_blank"><span class="btn btn-primary">Vista previa</span></a></td>
              </tr>
            </tbody>
            <?php }?>
          </table>
        </div>
      </div>
    </div>

    <!-- final de main area -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
  </body>
</html>
