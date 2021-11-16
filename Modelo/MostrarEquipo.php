<?php 
include 'conexion.php';

$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));


$query = mysqli_query($conn, "SELECT equipo.IdEquipo, equipo.Codigo, equipo.Equipo, equipo.Marca, 
equipo.Modelo, equipo.Descripcion, equipo.CentroNegocio_IdCentroNegocio, equipo.Area_IdArea, 
equipo.TipoEstado_IdTipoEstado, centronegocio.IdCentroNegocio ,centronegocio.CentroNegocio, 
centronegocio.Estado, area.IdArea, area.AreaNombre, tipoestado.IdTipoEstado, tipoestado.TipoEstado  
FROM equipo
INNER JOIN centronegocio
ON equipo.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN area
ON equipo.Area_IdArea = area.IdArea
INNER JOIN tipoestado
ON equipo.TipoEstado_IdTipoEstado = tipoestado.IdTipoEstado
WHERE IdEquipo = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>