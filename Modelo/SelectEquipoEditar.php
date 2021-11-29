<?php 

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$centro = $_POST['id_centroEditar'];

$querySelectCascada = mysqli_query($conn, 
    "SELECT area.IdArea, area.AreaNombre, area.CentroNegocio_IdCentroNegocio, centronegocio.IdCentroNegocio, centronegocio.CentroNegocio FROM area
    INNER JOIN centronegocio
    ON area.CentroNegocio_IdCentroNegocio = centronegocio.IdCentroNegocio
    WHERE area.CentroNegocio_IdCentroNegocio = '$centro' order by centronegocio asc ");

    foreach($querySelectCascada as $row)
	{
		$html.= "<option value='".$row['IdArea']."'>".utf8_encode($row['AreaNombre'])."</option>";
	}
	echo $html;

?>