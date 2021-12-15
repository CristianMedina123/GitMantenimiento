<?php 

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT idcontroltiempo, fechatiempo, horatiempo, usuario_idusuario FROM controltiempo 
WHERE usuario_idusuario = $id AND estadotiempo_idestadotiempo = 1 ORDER BY idcontroltiempo DESC LIMIT 1");
echo json_encode(mysqli_fetch_assoc($query)); 
?>