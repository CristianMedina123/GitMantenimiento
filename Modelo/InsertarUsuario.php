<?php

include 'conexion.php';


$usuario = mysqli_real_escape_string($conn, utf8_decode($_POST['usuario']));
$psw = mysqli_real_escape_string($conn, utf8_decode($_POST['psw']));
$nombre = mysqli_real_escape_string($conn, utf8_decode($_POST['nombre']));
$ape_pat = mysqli_real_escape_string($conn, utf8_decode($_POST['ape_pat']));
$ape_mat = mysqli_real_escape_string($conn, utf8_decode($_POST['ape_mat']));;
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$area = mysqli_real_escape_string($conn, utf8_decode($_POST['area']));
$tipo = mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));
$ingreso = mysqli_real_escape_string($conn, utf8_decode($_POST['ingreso']));
$cumple = mysqli_real_escape_string($conn, utf8_decode($_POST['cumple']));

$query = "INSERT INTO usuario (`usuario`, `psw`, `nombre`, `apellidopa`, `apellidoma`, `fechaingreso`, `fechacumple`,`area_idarea`, `tipousuario_idtipousuario`, `centronegocio_idcentronegocio`) 
VALUES 
('$usuario', '$psw', '$nombre', '$ape_pat', '$ape_mat', '$ingreso', '$cumple', '$area', '$tipo', '$centro')";
echo mysqli_query($conn,$query);
mysqli_close($conn);

?>