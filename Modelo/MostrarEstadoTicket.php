<?php 
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));


$query = mysqli_query($conn, "SELECT idestadoticket, estadoticket FROM estadoticket WHERE idestadoticket = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>