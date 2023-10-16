<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("vistas_comunes/headtest.php"); ?>
    <title>Base</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include("vistas_comunes/navbaradmin.php"); ?> 
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div id="dynamicHeader"></div>
    <!-- HEADER END -->

    <!-- FOOTER -->
    <?php include("vistas_comunes/footer.php"); ?>
    <!-- FOOTER END -->
    <script src="js/funciones.js"></script>
    <script>window.onload = () => createDynamicHeader('Gestionar Algo');</script>
  </body>
</html>
