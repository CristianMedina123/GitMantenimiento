<?php

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
// $id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$usuario = mysqli_real_escape_string($conn, utf8_decode($_POST['user']));
$psw = mysqli_real_escape_string($conn, utf8_decode($_POST['psw']));

$query = mysqli_query($conn, "SELECT idusuario FROM usuario WHERE usuario = '$usuario' AND psw = '$psw'");
echo json_encode(mysqli_fetch_assoc($query));
mysqli_close($conn);

?>