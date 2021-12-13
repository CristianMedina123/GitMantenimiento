<?php

include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$codigo = mysqli_real_escape_string($conn, utf8_decode($_POST['codigo']));
$equipo = mysqli_real_escape_string($conn, utf8_decode($_POST['equipo']));
$marca = mysqli_real_escape_string($conn, utf8_decode($_POST['marca']));
$modelo = mysqli_real_escape_string($conn, utf8_decode($_POST['modelo']));
$descripcion = mysqli_real_escape_string($conn, utf8_decode($_POST['descripcion']));
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$area = mysqli_real_escape_string($conn, utf8_decode($_POST['area']));
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "UPDATE equipo SET 
codigo = '$codigo', 
equipo = '$equipo',
marca = '$marca',
modelo = '$modelo',
descripcion = '$descripcion',
centronegocio_idcentronegocio = $centro,
area_idarea = $area,
tipoestado_idtipoestado = $estado
WHERE idequipo = $id";

echo mysqli_query($conn, $query);
mysqli_close($conn);
?>