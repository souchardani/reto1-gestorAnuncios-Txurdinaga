<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado
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
    <header class="header-section">
      <div class="container">
        aqui van las tarjetas de info
      </div>
    </header>
    <!-- HEADER END -->
    <!-- main area -->
    <div class="container">
          <?php 
          //añadimos mensajes de error en caso de que los haya
            echo MensajeError();
            echo MensajeExito();
          ?>
           <!-- inicio area central -->
           <main class="table">
            <section class="table__header">
                    <h1>Mis Anuncios Creados</h1>
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
                  <td><img src="../assets/img_subidas/anuncios/<?php echo $imagen ?>" alt=""></td>
                  <td><a target="_blank" class="boton tx-amarillo" href="editar_anuncio.php?id=<?php echo  $id ?>">Editar</a></td>
                  <td><a target="_blank" class="boton tx-azul" href="anuncio_completo.php?id=<?php echo  $id ?>">Vista Previa</a></td>
                 
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
