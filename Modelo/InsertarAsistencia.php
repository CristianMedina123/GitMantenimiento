<?php

include 'conexion.php';


$fecha = mysqli_real_escape_string($conn, utf8_decode($_POST['fecha'])); //Fecha de la asistencia
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado'])); //ESstao de la asistencia
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));




$query = "INSERT INTO controltiempo (Fecha, EstadoTiempo_IdEstadoTiempo, Usuario_IdUsuario, CentroNegocio_IdCentroNegocio) VALUES ('$fecha', '$estado', '$id', '$centro')";
echo mysqli_query($conn,$query);
mysqli_close($conn);

?>