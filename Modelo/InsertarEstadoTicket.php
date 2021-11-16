<?php
include 'conexion.php';

$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "INSERT INTO estadoticket (EstadoTicket) VALUES ('$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);



?>