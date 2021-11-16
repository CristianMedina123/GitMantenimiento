<?php

include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$usuario = mysqli_real_escape_string($conn, utf8_decode($_POST['usuario']));
$psw = mysqli_real_escape_string($conn, utf8_decode($_POST['psw']));
$nombre = mysqli_real_escape_string($conn, utf8_decode($_POST['nombre']));
$apepat = mysqli_real_escape_string($conn, utf8_decode($_POST['ape_pat']));
$apemat = mysqli_real_escape_string($conn, utf8_decode($_POST['ape_mat']));
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centros']));
$area = mysqli_real_escape_string($conn, utf8_decode($_POST['area']));
$tipo = mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));

$query = "UPDATE usuario SET 
Usuario = '$usuario', 
Password = '$psw',
Nombre = '$nombre',
ApellidoPat = '$apepat',
ApellidoMat = '$apemat',
CentroNegocio_idCentroNegocio = $centro,
Area_IdArea = $area,
TipoUsuario_IdTipoUsuario = $tipo
WHERE IdUsuario = $id";

echo mysqli_query($conn, $query);
mysqli_close($conn);
?>