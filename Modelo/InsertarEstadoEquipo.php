<?php

include 'conexion.php';

$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));

$query = "INSERT INTO tipoestado (TipoEstado) VALUES ('$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);
?>