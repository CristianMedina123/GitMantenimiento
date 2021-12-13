<?php

include 'conexion.php';

$area = mysqli_real_escape_string($conn, utf8_decode($_POST['area']));
$centro = mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));

$query = "INSERT INTO `mantenimientoanli`.`area` (`areanombre`, `centronegocio_idcentronegocio`) VALUES ('$area', '$centro')";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>