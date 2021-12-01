<?php
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT usuario.idusuario, usuario.usuario, usuario.psw,usuario.fechaingreso,usuario.fechacumple,usuario.nombre, usuario.apellidopa,apellidoma,centronegocio.idcentronegocio, centronegocio.centronegocio, centronegocio.estadocn,area.idarea, area.areanombre, tipousuario.idtipousuario, tipousuario.tipousuario FROM usuario
INNER JOIN centronegocio
ON usuario.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN area
ON usuario.Area_IdArea = area.IdArea
INNER JOIN tipousuario
ON usuario.TipoUsuario_IdTipoUsuario = tipousuario.IdTipoUsuario
WHERE IdUsuario = $id");
echo json_encode(mysqli_fetch_assoc($query)); 

?>