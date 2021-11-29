<?php 
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));


$query = mysqli_query($conn, "SELECT equipo.idequipo, equipo.codigo, equipo.equipo, equipo.marca, 
equipo.modelo, equipo.descripcion, equipo.centronegocio_idcentronegocio, equipo.area_idarea, 
equipo.tipoestado_idtipoestado, centronegocio.idcentronegocio ,centronegocio.centronegocio, 
centronegocio.estadocn, area.idarea, area.areanombre, tipoestado.idtipoestado, tipoestado.tipoestado  
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