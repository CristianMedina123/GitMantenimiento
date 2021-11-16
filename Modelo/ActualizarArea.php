<?php
include 'conexion.php';

$id =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$centro =  mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$area =  mysqli_real_escape_string($conn, utf8_decode($_POST['area']));

$query = "UPDATE area SET areanombre = '$area', centronegocio_idcentronegocio = '$centro' WHERE idarea = '$id'";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>