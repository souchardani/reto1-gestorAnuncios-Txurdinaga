<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();

if(isset($_POST["enviar"])){
  $categoria = $_POST["tituloCategoria"];
  $Admin = $_SESSION["usuario_global"];

    $campos = comprobar_campos_categorias($categoria);
    if($campos){
       //insertar la categoria en la bbdd
      insertar_categoria_bbdd($categoria);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../templates/head.php"); ?>
    <title>Categorias</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("../templates/header.php"); ?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div id="dynamicHeader"></div>
    <!-- HEADER END -->

  <!-- MAIN AREA -->
  <section class="container py-2 mb-4">
    <div class="row" >
      <div class="offset-lg-1 col-lg-10" style="min-height: 50vh;">
      <?php 
      echo MensajeError();
      echo MensajeExito();
       ?>
      <form class="" action="categorias.php" method="post">
        <div class="card text-bg-secondary mb-3">
          <div class="card-header" style="background-color: #BA007B;">
            <h1>Añadir Nueva Categoria</h1>
          </div>
          <div class="card-body text-bg-light">
            <div class="form-group mb-5">
              <label class="mb-3" for="title"><span class="FieldInfo">Titulo de la Categoria:</span></label>
              <input class="form-control " type="text" name="tituloCategoria" id="title" placeholder="Escribe el titulo aqui">
            </div>
            <div class="row">
            <div class="col-lg-6 mb-2">
              <a class="btn btn-warning d-lg-block w-100" href="detalles_anuncios.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div class="col-lg-6 mb-2  d-md-block ">
              <button type="submit" name="enviar" class="btn btn-success w-100"><i class="fa-solid fa-check"></i> Publicar</button>
            </div>
          </div>
          </div>
        </div>

      </form>
      <h2>Categorias</h2>
          <table class="table table-stripped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Nº</th> 
                <th>Nombre</th>
                <th>Eliminar</th>
              </tr>
            </thead>
          <?php
          $stmt = obtener_categorias();
          $contador = 0;
          while ($fila = $stmt -> fetch()){          
            $titulo = $fila["Nombre"];
            $contador++;
          ?>
          <tbody>
            <tr>
              <td><?php echo $contador; ?></td>
              <td><?php echo $titulo; ?></td>
              <td><a href="eliminar_categoria.php?id=<?php echo $titulo; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
          </tbody>
          <?php } ?>
          </table>  
    </div>
    </div>
  </section>

  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Categorias');</script>
  </body>
</html>
