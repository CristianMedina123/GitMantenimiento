<?php

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT mantenimiento.idmantenimiento, mantenimiento.mantenimiento, mantenimiento.fechamantenimiento, mantenimiento.descripcion, equipo.idequipo, equipo.equipo, equipo.marca, equipo.codigo, usuario.idusuario, usuario.nombre, usuario.apellidopa, usuario.apellidoma,centronegocio.idcentronegocio, centronegocio.centronegocio, centronegocio.estadocn FROM mantenimiento
INNER JOIN equipo
ON mantenimiento.equipo_idequipo = equipo.idequipo
INNER JOIN centronegocio
ON equipo.centronegocio_idcentronegocio = centronegocio.idcentronegocio
INNER JOIN usuario
ON mantenimiento.usuario_idusuario = usuario.idusuario
WHERE idmantenimiento = '$id'");

echo json_encode(mysqli_fetch_assoc($query)); 
mysqli_close($conn);


?>