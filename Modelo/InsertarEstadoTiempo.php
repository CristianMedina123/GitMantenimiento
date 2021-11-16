<?php 

include 'conexion.php';

$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estadoTiempo']));

$query = "INSERT INTO estadotiempo (Estado) VALUES ('$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>