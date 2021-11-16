<?php

include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT usuario.IdUsuario, usuario.Usuario, usuario.Password, usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat, centronegocio.IdCentroNegocio, centronegocio.CentroNegocio,area.IdArea, area.AreaNombre,tipousuario.IdTipoUsuario, tipousuario.TipoUsuario FROM usuario
INNER JOIN centronegocio
ON usuario.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN area
ON usuario.Area_IdArea = area.IdArea
INNER JOIN tipousuario
ON usuario.TipoUsuario_IdTipoUsuario = tipousuario.IdTipoUsuario
WHERE IdUsuario = $id");

echo json_encode(mysqli_fetch_assoc($query));

?>