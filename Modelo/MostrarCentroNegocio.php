<?php 
include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT centronegocio.IdCentroNegocio, centronegocio.CentroNegocio, centronegocio.Estado as estados FROM mantenimiento.centronegocio WHERE IdCentroNegocio = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>