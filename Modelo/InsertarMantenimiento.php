<?php

include 'conexion.php';

$mantenimiento = mysqli_real_escape_string($conn, utf8_decode($_POST['mant']));
$fecha = mysqli_real_escape_string($conn, utf8_decode($_POST['fecha']));
$desc = mysqli_real_escape_string($conn, utf8_decode($_POST['desc']));
$equipo = mysqli_real_escape_string($conn, utf8_decode($_POST['equipo']));
// $centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));Equipo_CentroNegocio_idCentroNegocio
$usuario = mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));

$query = "INSERT INTO mantenimiento (Mantenimiento, FechaMantenimiento, Descripcion, Equipo_idEquipo, Usuario_IdUsuario) VALUES 
('$mantenimiento', '$fecha', '$desc', '$equipo', '$usuario')";
echo mysqli_query($conn,$query);
mysqli_close($conn);
?>