<?php
$myPDO = "mysql:host=localhost;dbname=gestor_de_anuncios";
$ConexionDB = new PDO($myPDO, "root", "");
$sql = "SELECT * FROM categorias WHERE id='1'";
$stmt = $ConexionDB -> query($sql);
$fila = $stmt -> fetch();

echo $fila["titulo"];

$fechaActual = date("Y-m-d H:i:s"); 

echo $fechaActual;

?>