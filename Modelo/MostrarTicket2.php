<?php 

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT idticket, ticket, fechaticket, observacionpendiente,observacionproceso,observacioncompleto, estadoticket_idestadoticket FROM ticket WHERE idticket = $id");
echo json_encode(mysqli_fetch_assoc($query)); 
?>