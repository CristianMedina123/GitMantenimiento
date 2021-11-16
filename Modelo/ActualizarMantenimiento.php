<?php
include 'conexion.php';

$id =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$mantenimiento =  mysqli_real_escape_string($conn, utf8_decode($_POST['mantenimiento']));
$fecha =  mysqli_real_escape_string($conn, utf8_decode($_POST['fehca']));
$descripcion =  mysqli_real_escape_string($conn, utf8_decode($_POST['descripcion']));
$equipo =  mysqli_real_escape_string($conn, utf8_decode($_POST['equipo']));
// $centro =  mysqli_real_escape_string($conn, utf8_decode($_POST['centro']));Equipo_CentroNegocio_idCentroNegocio = $centro,
$usuario =  mysqli_real_escape_string($conn, utf8_decode($_POST['usuario']));

$query = "UPDATE mantenimiento SET 
Mantenimiento = '$mantenimiento',
FechaMantenimiento = '$fecha',
Descripcion = '$descripcion',
Equipo_idEquipo = $equipo,

Usuario_IdUsuario = $usuario 
WHERE IdMantenimiento = '$id'";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>