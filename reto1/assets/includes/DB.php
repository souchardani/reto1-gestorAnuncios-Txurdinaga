<?php
try {
    $hostDB = "gestor-anuncios-g1.cpvfzkht0bju.us-east-1.rds.amazonaws.com";
    $nombreDB = "gestor_anuncios";
    $usuarioDB = "admin";
    $passwordDB = "12345678";

    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;charset=utf8mb4";
    $Conexionbbdd = new PDO($hostPDO, $usuarioDB, $passwordDB);

    //conexion local para cuando aws este apagado
    // $myPDO2 = "mysql:host=localhost;dbname=gestor_anuncios";
    // $Conexionbbdd = new PDO($myPDO2, "root", "");
    // $Conexionbbdd->exec("set names utf8");

}catch(PDOException $e){
    echo "Error al conectar a la base de datos. Error: $e";
}
?>
