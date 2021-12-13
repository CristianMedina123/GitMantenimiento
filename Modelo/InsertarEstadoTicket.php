<?php
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "INSERT INTO estadoticket (estadoticket) VALUES ('$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);



?>