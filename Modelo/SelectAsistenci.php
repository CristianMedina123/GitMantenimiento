<?php 

include 'conexion.php';
//mysqli_set_charset( $conn, "utf8" );
mb_internal_encoding('UTF-8');
$centro = $_POST['id_centro'];

$querySelectCascada = mysqli_query($conn, 
    "SELECT centronegocio.idcentronegocio, centronegocio.centronegocio, usuario.idusuario, usuario.nombre, usuario.apellidopa, usuario.apellidoma FROM centronegocio
    INNER JOIN usuario
    ON centronegocio.idcentronegocio = usuario.centronegocio_idcentronegocio
    WHERE usuario.centronegocio_idcentronegocio = '$centro' order by nombre ASC");

    foreach($querySelectCascada as $row)
	{
		$html.= "<option value='".$row['idusuario']."'>".utf8_encode($row['nombre'])." ".utf8_encode($row['apellidopa'])." ".utf8_encode($row['apellidoma'])."</option>";
	}
	echo $html;

?>