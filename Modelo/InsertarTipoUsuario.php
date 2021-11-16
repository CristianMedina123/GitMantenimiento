<?php
include 'conexion.php';

$tipo = mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));

$query = "INSERT INTO tipousuario (TipoUsuario) VALUES ('$tipo')";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>