<!-- requerimos al menos una vez la coneccion a la base de datos, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
  //verificamos si se ha pasado un anuncio por la url, si no se redirecciona a anuncios
  comprobar_variable_url('id', "anuncios_inicio.php");
  //obtenemos el id del anuncion para usarlo en toda la pagina
  $idAnuncio = $_GET['id']; 
  //echo $_SESSION["tipoUsuario_global"];
  //validamos que el usuario sea administrador para insertar directamente el comentario
  if(isset($_SESSION["tipoUsuario_global"])) {
    if ($_SESSION["tipoUsuario_global"] == "Administrador") {
      $validado = 1;
    }else {
      $validado = 0;
    }
  }
?>
<!-- codigo para insertar el comentario en la bbdd -->
<?php
  if(isset($_POST["Enviar"])){
    //OBTENEMOS TODOS LOS DATOS DEL COMENTARIO
    $nombre = $_SESSION["usuario_global"];
    //validar_nombre_comentario(); //verificar si el nombre del comentario esta en la bbdd
    $cuerpo = $_POST["cuerpoComentario"];
    $comprobar_campos = verificar_campos_comentario($nombre, $cuerpo, $idAnuncio);
    //si esta correcto, insertar comentario en la bbdd
    if ($comprobar_campos){
      insertar_comentario_bbdd($nombre, $cuerpo, $validado, $idAnuncio);
    }
  }
?>
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
    <div class="container container-anuncio-completo mt-bg">
      <div class="noticia-inicio mt-bg">
          <?php 
          echo MensajeError();
              echo MensajeExito();
          ?>
          <?php
          //mostramos el anuncio pasado por la url
          $stmt = mostrar_anuncio_url($idAnuncio);
          while ($fila = $stmt -> fetch()){
            $id = $fila["id"];
            $datetime = $fila["Fecha_publi"];
            $titulo = $fila["Título"];
            $categoria = obtener_categoria_porid($id);
            $autor = $fila["Autor"];
            $imagen = $fila["Imagen"];
            $descripcion = $fila["Descripción"];
        ?>
            <p class="card-title mt-bg"><?php echo htmlentities($titulo)?></p>
            <p><small class="subtitulos">Categoria: <?php echo "<span class='ctx-azul'>$categoria</span>"?>| Publicado Por: <?php echo "<span class='ctx-azul'>$autor</span>"?> | el <?php echo "<span class='ctx-azul'>$datetime</span>"?></small></p>
          <img class="imgAnunCom" style="max-height: 450px; object-fit: cover;" src="../assets/img_subidas/anuncios/<?php echo $imagen?>" alt=""/>
          <p class="descripcionAnun"><?php echo $descripcion?></p>        
        <br>
        <?php } ?>
        </div>
        <!-- seccion de comentarios -->
        <div class="comentarios-inicio mt-bg">
        <h1 class="comentarioss" >Comentarios:
            <?php
            $comentariossi = obtener_comentarios_aprobados_porid($id);
            echo "<span class='ctx-azul'>$comentariossi</span>";
            ?>
            </h1>
            <br>
        <!-- obtener comentarios existentes -->
        <?php
        $stmt = obtener_comentario_poranuncio($idAnuncio);
        while($fila = $stmt->fetch()){
          $autor = $fila["Autor"];
          $texto = $fila["Texto"];
        ?>
        <!-- fin de obtener comentarios existentes -->
        <div>
          <div class="media bloque-comentario">
            <img class="img-fluid" src="../assets/img/avatar.svg" width="80px" alt="">
            <div class="media-body m-2">
              <h3 class="lead mb-3"><?php echo $autor ?></h3>
              <p class="descAnun"><?php echo $texto ?></p>
          </div>
          </div>
          <?php } ?>
          <?php 
              if (isset($_SESSION["tipoUsuario_global"])){
          ?>
          <!-- formulario -->
          <div class="contenedor-formulario mt-bg">
        <div class="titulo tx-verde-oscuro"><span>Añadir Comentario:</span></div>
        <form action="anuncio_completo.php?id=<?php echo $idAnuncio ?>" method="post">
          <!-- fila titulo -->
          <div class="fila">
            <textarea name="cuerpoComentario" id="" cols="20" rows="5" class="form-control"></textarea>
          </div>
          <!-- fila para boton -->
          <div class="fila-boton">
          <button type="submit" name="Enviar" class="boton tx-verde-oscuro w-100" ><i class="fa-solid fa-check"></i>Publicar</button>
          </div>
        </form>
      </div>
    </section>
            <?php 
            }else {
              echo "<div class='falta-comentarios mt-bg'><p>Para poder poner un comentario tienes que estar registrado</div>";
            } 
            ?>
            </div>
             </div>  
            </div>  
        </form>
        </div>
      </div>
        <!-- fin seccion principal -->
    <!-- HEADER END -->
    <!-- FOOTER -->
    </div>
    </div>
    </div>
    </div>
    <div class="margen">
    <?php include("../templates/footer.php"); ?>
    </div>
  </body>
</html>
