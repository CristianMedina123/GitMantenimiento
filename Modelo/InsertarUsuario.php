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


$query = "INSERT INTO usuario (`Usuario`, `Password`, `Nombre`, `ApellidoPat`, `ApellidoMat`, `CentroNegocio_idCentroNegocio`, `Area_IdArea`, `TipoUsuario_IdTipoUsuario`) 
VALUES 
('$usuario', '$psw', '$nombre', '$ape_pat', '$ape_mat', '$centro', '$area', '$tipo')";
echo mysqli_query($conn,$query);
mysqli_close($conn);

?>