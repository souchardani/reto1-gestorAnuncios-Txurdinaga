<?php
try {
    $myPDO = "mysql:host=localhost;dbname=gestor_de_anuncios";
    $ConexionDB = new PDO($myPDO, "root", "");
}catch(PDOException $e){
    echo "Error al conectar a la base de datos. Error: $e";
}
?>