<?php 

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$centro = $_POST['id_centro'];

$querySelectCascada = mysqli_query($conn, 
    "SELECT centronegocio.idcentronegocio, centronegocio.centronegocio,equipo.idequipo ,equipo.codigo, equipo.equipo, equipo.marca FROM equipo
    INNER JOIN centronegocio
    ON equipo.centronegocio_idcentronegocio = centronegocio.idcentronegocio 
    WHERE equipo.centronegocio_idcentronegocio = '$centro' order by centronegocio asc ");

    foreach($querySelectCascada as $row)
	{
		$html.= "<option value='".$row['idequipo']."'>".utf8_encode($row['equipo'])." / ".utf8_encode($row['codigo'])." / ".utf8_encode($row['marca'])."</option>";
	}
	echo $html;

?>