<?php
try {
    $myPDO2 = "mysql:host=amarillodb.cttbfrc0bmsk.us-east-1.rds.amazonaws.com;dbname=gestor_anuncios";
    $Conexionbbdd = new PDO($myPDO2, "admin", "admin123");
    $Conexionbbdd->exec("set names utf8");

    //conexion local para cuando aws este apagado
    // $myPDO2 = "mysql:host=localhost;dbname=gestor_anuncios";
    // $Conexionbbdd = new PDO($myPDO2, "root", "");
    // $Conexionbbdd->exec("set names utf8");

}catch(PDOException $e){
    echo "Error al conectar a la base de datos. Error: $e";
}
?>

<!-- 
 -->