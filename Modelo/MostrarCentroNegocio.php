<?php 
include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));


$query = mysqli_query($conn, "SELECT IdCentroNegocio,CentroNegocio,Estado FROM CentroNegocio WHERE IdCentroNegocio = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>