<?php
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$centro =  mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));
$estado =  mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "UPDATE centronegocio SET centronegocio = '$centro', estadocn = '$estado' WHERE idcentronegocio = '$id'";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>