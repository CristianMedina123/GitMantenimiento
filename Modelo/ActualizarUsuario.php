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
$ingreso = mysqli_real_escape_string($conn, utf8_decode($_POST['ingreso']));
$cumple = mysqli_real_escape_string($conn, utf8_decode($_POST['cumple']));

$query = "UPDATE usuario SET 
usuario = '$usuario', 
psw = '$psw',
nombre = '$nombre',
apellidopa = '$apepat',
apellidoma = '$apemat',
fechaingreso = '$ingreso',
fechacumple = '$cumple',
centronegocio_idcentronegocio = $centro,
area_idarea = $area,
tipousuario_idtipousuario = $tipo
WHERE idusuario = $id";

echo mysqli_query($conn, $query);
mysqli_close($conn);
?>