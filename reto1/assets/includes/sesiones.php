<?php
session_start();

function MensajeError(){
    if(isset($_SESSION["MensajeError"])){
        $respuesta = "<div class=\"alert rojo\">" . htmlentities($_SESSION["MensajeError"]). "</div>";
        $_SESSION["MensajeError"] = null;
        return $respuesta;
    }
}

function MensajeExito(){
    if(isset($_SESSION["MensajeExito"])){
        $respuesta = "<div class=\"alert verde\">" . htmlentities($_SESSION["MensajeExito"]). "</div>";
        $_SESSION["MensajeExito"] = null;
        return $respuesta;
    }
}
?>
