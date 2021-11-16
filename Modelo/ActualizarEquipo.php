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
Codigo = '$codigo', 
Equipo = '$equipo',
Marca = '$marca',
Modelo = '$modelo',
Descripcion = '$descripcion',
CentroNegocio_IdCentroNegocio = $centro,
Area_IdArea = $area,
TipoEstado_IdTipoEstado = $estado
WHERE IdEquipo = $id";

echo mysqli_query($conn, $query);
mysqli_close($conn);
?>