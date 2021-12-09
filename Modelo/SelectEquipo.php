<?php 

include 'conexion.php';
//mysqli_set_charset( $conn, "utf8" );
mb_internal_encoding('UTF-8');
$centro = $_POST['id_centro'];

$querySelectCascada = mysqli_query($conn, 
    "SELECT area.idarea, area.areanombre, area.centronegocio_idcentronegocio, centronegocio.idcentronegocio, centronegocio.centronegocio FROM area
    INNER JOIN centronegocio
    ON area.centronegocio_idcentronegocio = centronegocio.idcentronegocio
    WHERE area.centronegocio_idcentronegocio = '$centro' order by centronegocio asc ");

    foreach($querySelectCascada as $row)
	{
		$html.= "<option value='".$row['idarea']."'>".utf8_encode($row['areanombre'])."</option>";
	}
	echo $html;

?>