<?php 

include 'conexion.php';

$centro = $_POST['id_centro'];

$querySelectCascada = mysqli_query($conn, 
    "SELECT centronegocio.IdCentroNegocio, centronegocio.CentroNegocio,equipo.IdEquipo ,equipo.Codigo, equipo.Equipo FROM equipo
    INNER JOIN centronegocio
    ON equipo.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio 
    WHERE equipo.CentroNegocio_idCentroNegocio = '$centro' order by centronegocio asc ");

    foreach($querySelectCascada as $row)
	{
		$html.= "<option value='".$row['IdEquipo']."'>".utf8_encode($row['Codigo'])." ".utf8_encode($row['Equipo'])."</option>";
	}
	echo $html;

?>