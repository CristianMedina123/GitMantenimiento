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
ON equipo.centronegocio_idcentronegocio = centronegocio.idcentronegocio
INNER JOIN area
ON equipo.area_idarea = area.idarea
INNER JOIN tipoestado
ON equipo.tipoestado_idtipoestado = tipoestado.idtipoestado
WHERE idequipo = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>