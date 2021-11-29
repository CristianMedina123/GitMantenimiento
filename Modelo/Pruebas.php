<?php

include 'conexion.php';

$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT usuario.IdUsuario, usuario.Usuario, usuario.Password as contra ,usuario.Nombre, usuario.ApellidoPat,centronegocio.IdCentroNegocio, centronegocio.CentroNegocio, area.IdArea, area.AreaNombre, tipousuario.IdTipoUsuario, tipousuario.TipoUsuario FROM usuario
INNER JOIN centronegocio
ON usuario.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN area
ON usuario.Area_IdArea = area.IdArea
INNER JOIN tipousuario
ON usuario.TipoUsuario_IdTipoUsuario = tipousuario.IdTipoUsuario
WHERE IdUsuario = $id");
echo json_encode(mysqli_fetch_assoc($query));

?>