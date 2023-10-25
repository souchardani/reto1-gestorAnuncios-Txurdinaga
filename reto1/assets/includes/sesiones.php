<?php
session_start();

function MensajeError(){
    if(isset($_SESSION["MensajeError"])){
        $respuesta = "<div class=\"alert rojo\">" . $_SESSION["MensajeError"]. "</div>";
        $_SESSION["MensajeError"] = null;
        return $respuesta;
    }
}

function MensajeExito(){
    if(isset($_SESSION["MensajeExito"])){
        $respuesta = "<div class=\"alert verde\">" . $_SESSION["MensajeExito"]. "</div>";
        $_SESSION["MensajeExito"] = null;
        return $respuesta;
    }
}
?>
