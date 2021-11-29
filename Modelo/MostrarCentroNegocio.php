<?php 
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT idcentronegocio, centronegocio, estadocn 
FROM centronegocio 
WHERE idcentronegocio = $id");

//var_dump($query); #Esto es sólo para prueba, luego lo quitas.
// echo json_encode($query);
echo json_encode(mysqli_fetch_assoc($query)); 
// echo json_encode($query, JSON_UNESCAPED_UNICODE);


?>