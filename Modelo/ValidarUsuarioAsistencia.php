<?php

include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$usuario = mysqli_real_escape_string($conn, utf8_decode($_POST['user']));

$query = mysqli_query($conn, "SELECT IdUsuario, Usuario FROM usuario WHERE IdUsuario = '$id' AND Usuario = '$usuario'");

echo json_encode(mysqli_fetch_assoc($query));
mysqli_close($conn);

?>