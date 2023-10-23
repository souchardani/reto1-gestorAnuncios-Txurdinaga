<!-- requerimos al menos una vez la coneccion a la base de datos categorias, a funciones y sesiones -->
<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>
<?php
$_SESSION["guardarURL"] = $_SERVER["PHP_SELF"]; //utilizamos esto para guardar el nombre de la pagina actual 
//verificamos que el usuario este logueado como administrador
confirmar_login();
//verificamos que el usuario sea administrador
confirmar_admin();

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
  <section class="container">
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
            <div class="d-flex">
            <div>
              <a class="boton tx-amarillo w-100" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Volver al Panel de Control</a>
            </div>
            <div>
              <button type="submit" name="enviar" class="boton tx-verde-claro w-100"><i class="fa-solid fa-check"></i> Publicar</button>
            </div>
          </div>
          </div>
        </div>
      </form>

         <!-- tabla categorias -->
         <main class="table mt-bg">
        <section class="table__header">
          <h1 class="heading-02">Categorias</h1>
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
                <th>Nombre</th>
                <th>Eliminar</th>
              </tr>
          </thead>
        <tbody>         
          <?php
            $stmt = obtener_categorias();
            $contador = 0;
            while ($fila = $stmt -> fetch()){          
              $titulo = $fila["Nombre"];
              $contador++;
            ?>
              <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $titulo; ?></td>
                <td><a onclick="return confirm('Debes verificar que no hay anuncios creados con esta categoria, de lo contrario, no se podra eliminar')" href="eliminar_categoria.php?id=<?php echo $titulo; ?>" class="boton rojo"><i class="fa-solid fa-trash-can"></i></a></td>
              </tr>
            <?php } ?>
              </tbody>
            </table>
          </section>
        </main>
    </section>
  <!-- END MAIN AREA -->
    <!-- FOOTER -->
    <?php include("../templates/footer.php"); ?>
    <script src="../assets/js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Categorias');</script>
  </body>
</html>
