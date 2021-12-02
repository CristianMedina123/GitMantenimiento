<?php 

include 'conexion.php';
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "INSERT INTO centronegocio (CentroNegocio, EstadoCN) VALUES ('$centro', '$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);
?>