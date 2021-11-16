<?php

$fecha = $_POST[''];
$estado = $_POST[''];
$usuario = $_POST[''];

$query = "INSERT INTO `mantenimiento`.`controltiempo` (`Fecha`, `EstadoTiempo_IdEstadoTiempo`, `Usuario_IdUsuario`) 
VALUES ('$fecha', '$estado', '$usuario')";

?>