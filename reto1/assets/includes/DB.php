<?php
try {
    $myPDO2 = "mysql:host=amarillodb.cttbfrc0bmsk.us-east-1.rds.amazonaws.com;dbname=gestor_anuncios";
    $Conexionbbdd = new PDO($myPDO2, "admin", "admin123");
    $Conexionbbdd->exec("set names utf8");

}catch(PDOException $e){
    echo "Error al conectar a la base de datos. Error: $e";
}
?>

<!-- 
 -->