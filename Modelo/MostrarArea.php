<?php 
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));


$query = mysqli_query($conn, "SELECT area.idarea, area.areanombre,centronegocio.centronegocio,centronegocio.idcentronegocio FROM area
INNER JOIN centronegocio
ON area.centronegocio_idcentronegocio = centronegocio.idcentronegocio WHERE area.idarea = '$id'");
echo json_encode(mysqli_fetch_assoc($query)); 


?>