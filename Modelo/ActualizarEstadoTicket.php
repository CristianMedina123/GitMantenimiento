<?php

include 'conexion.php';

$id =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$estado =  mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "UPDATE estadoticket SET estadoticket = '$estado' WHERE IdEstadoTicket = '$id'";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>