<?php

$fecha = $_POST[''];
$estado = $_POST[''];
$usuario = $_POST[''];

$query = "INSERT INTO `mantenimiento`.`controltiempo` (`fecha`, `estadotiempo_idestadotiempo`, `usuario_idusuario`) 
VALUES ('$fecha', '$estado', '$usuario')";

?>