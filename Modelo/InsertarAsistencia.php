<?php

include 'conexion.php';


$fecha = mysqli_real_escape_string($conn, utf8_decode($_POST['fecha'])); //Fecha de la asistencia
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado'])); //ESstao de la asistencia
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$hora = mysqli_real_escape_string($conn, utf8_decode($_POST['hora']));




$query = "INSERT INTO controltiempo (fechatiempo, horatiempo, estadotiempo_idestadotiempo, usuario_idusuario, centronegocio_idcentronegocio) 
VALUES ('$fecha', '$hora' ,'$estado', '$id', '$centro')";
echo mysqli_query($conn,$query);
mysqli_close($conn);

?>