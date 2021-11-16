<?php

include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT mantenimiento.IdMantenimiento, mantenimiento.Mantenimiento, mantenimiento.FechaMantenimiento, mantenimiento.Descripcion, equipo.IdEquipo, equipo.Equipo, equipo.Marca, equipo.Codigo, usuario.IdUsuario, usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat,centronegocio.IdCentroNegocio, centronegocio.CentroNegocio, centronegocio.Estado FROM mantenimiento
INNER JOIN equipo
ON mantenimiento.Equipo_idEquipo = equipo.IdEquipo
INNER JOIN centronegocio
ON equipo.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN usuario
ON mantenimiento.Usuario_IdUsuario = usuario.IdUsuario
WHERE IdMantenimiento = '$id'");

echo json_encode(mysqli_fetch_assoc($query)); 
mysqli_close($conn);


?>