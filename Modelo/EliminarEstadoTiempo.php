<?php

include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = "DELETE FROM EstadoTiempo WHERE IdEstadoTiempo = '$id'";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>