<?php 

include 'conexion.php';

$centro = $_POST['id_centro'];

$querySelectCascada = mysqli_query($conn, 
    "SELECT centronegocio.IdCentroNegocio, centronegocio.CentroNegocio, usuario.IdUsuario, usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat FROM centronegocio
    INNER JOIN usuario
    ON centronegocio.IdCentroNegocio = usuario.CentroNegocio_idCentroNegocio
    WHERE usuario.CentroNegocio_idCentroNegocio = '$centro' order by usuario ASC");

    foreach($querySelectCascada as $row)
	{
		$html.= "<option value='".$row['IdUsuario']."'>".$row['Nombre']." ".$row['ApellidoPat']." ".$row['ApellidoMat']."</option>";
	}
	echo $html;

?>