<?php

include 'conexion.php';

$codigo = mysqli_real_escape_string($conn, utf8_decode($_POST['codigo']));
$equipo = mysqli_real_escape_string($conn, utf8_decode($_POST['equipo']));
$marca = mysqli_real_escape_string($conn, utf8_decode($_POST['marca']));
$modelo = mysqli_real_escape_string($conn, utf8_decode($_POST['modelo']));
$desc = mysqli_real_escape_string($conn, utf8_decode($_POST['desc']));

$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$area = mysqli_real_escape_string($conn, utf8_decode($_POST['area']));
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "INSERT INTO equipo (Codigo, Equipo, Marca, Modelo, Descripcion, CentroNegocio_idCentroNegocio, Area_IdArea, TipoEstado_IdTipoEstado) 
VALUES 
('$codigo', '$equipo', '$marca', '$modelo', '$desc', '$centro', '$area', '$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);


?>