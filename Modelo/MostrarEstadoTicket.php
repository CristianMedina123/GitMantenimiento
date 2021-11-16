<?php 


include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));


$query = mysqli_query($conn, "SELECT IdEstadoTicket, EstadoTicket FROM estadoticket WHERE IdEstadoTicket = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>