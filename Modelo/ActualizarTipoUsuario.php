<?php

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$tipo =  mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));

$query = "UPDATE tipousuario SET tipousuario = '$tipo' WHERE idtipousuario = '$id'";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>